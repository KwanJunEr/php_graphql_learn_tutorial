<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    private function graphqlQuery($query, $variables = [])
    {
        $response = Http::post(url('/graphql'), [
            'query' => $query,
            'variables' => $variables
        ]);

        return $response->json();
    }

    public function index()
    {
        $query = '
            query {
                posts {
                    id
                    title
                    content
                    author
                    published
                    created_at
                }
            }
        ';

        $result = $this->graphqlQuery($query);
        $posts = $result['data']['posts'] ?? [];
        
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $query = '
            query($id: ID!) {
                post(id: $id) {
                    id
                    title
                    content
                    author
                    published
                    created_at
                    comments {
                        id
                        author
                        content
                        created_at
                    }
                }
            }
        ';

        $result = $this->graphqlQuery($query, ['id' => $id]);
        $post = $result['data']['post'] ?? null;
        
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $mutation = '
            mutation($title: String!, $content: String!, $author: String!, $published: Boolean) {
                createPost(title: $title, content: $content, author: $author, published: $published) {
                    id
                    title
                }
            }
        ';

        $this->graphqlQuery($mutation, [
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'published' => $request->has('published')
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $query = '
            query($id: ID!) {
                post(id: $id) {
                    id
                    title
                    content
                    author
                    published
                }
            }
        ';

        $result = $this->graphqlQuery($query, ['id' => $id]);
        $post = $result['data']['post'] ?? null;
        
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $mutation = '
            mutation($id: ID!, $title: String, $content: String, $author: String, $published: Boolean) {
                updatePost(id: $id, title: $title, content: $content, author: $author, published: $published) {
                    id
                    title
                }
            }
        ';

        $this->graphqlQuery($mutation, [
            'id' => $id,
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'published' => $request->has('published')
        ]);

        return redirect()->route('posts.show', $id)->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $mutation = '
            mutation($id: ID!) {
                deletePost(id: $id) {
                    id
                }
            }
        ';

        $this->graphqlQuery($mutation, ['id' => $id]);

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
