@extends('layouts.app')

@section('content')
  @foreach ($posts as $post)
    <div class="card mb-4 shadow-sm">
      <div class="card-body">
        <h4 class="card-title">{{ $post->title }}</h4>
        <p class="text-muted">By {{ $post->author }} • {{ $post->created_at->diffForHumans() }}</p>
        <p>{{ $post->content }}</p>
        <p><strong>Status:</strong> {{ $post->published ? '✅ Published' : '❌ Draft' }}</p>

        <hr>
        <h6>Comments ({{ $post->comments->count() }})</h6>
        @forelse ($post->comments as $comment)
          <div class="border p-2 mb-2 rounded bg-white">
            <strong>{{ $comment->author }}</strong>:
            {{ $comment->content }}
            <small class="text-muted">({{ $comment->created_at->diffForHumans() }})</small>
          </div>
        @empty
          <p>No comments yet.</p>
        @endforelse
      </div>
    </div>
  @endforeach
@endsection
