<h1>Set up Laravel and GraphQL </h1>

<pre>
<code>
 laravel new laravel-graph
</code>
</pre>

<br>
Refer to this document: https://lighthouse-php.com/

<br>
<p> Setup as the following according to the lighthouse documentation </p>

<h1>Extra Stuff </h1>
<pre>
<code>
 php artisan about 
</code>
</pre>

<h1>How Laravel Lighthouse GraphQL Works Behind the Scenes</h1>
<ol>
  <li>
   The query goes to /graphql
  </li>
 <li>
  Lighthouse parses your query
 </li>
 <li>
  Lighthouse sees two fields: ads and posts
 </li>
 <li>
  It checks schema: ads → AdsQuery@all and posts → PostsQuery@all
 </li>
 <li>
  It calls both resolvers:
   - App\GraphQL\Queries\AdsQuery::all()
   - App\GraphQL\Queries\PostsQuery::all()
 </li>
 <li>
  Each resolver fetches data (Eloquent, controller, repository, etc.)
 </li>
 <li>
  Lighthouse merges both results into one JSON response
 </li>
</ol>
