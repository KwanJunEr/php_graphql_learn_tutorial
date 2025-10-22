<h1>Set up Laravel and GraphQL </h1>
<br>
Refer to this document: https://lighthouse-php.com/
<p> Setup as the following according to the lighthouse documentation </p>
<br>
<h2>Step 1</h2>
<p>Option 1</p>
<pre>
 <code>
  composer create-project laravel/laravel graphql-api
  cd graphql-api
 </code>
</pre>
<p>Option 2</p>
<pre>
<code>
 laravel new laravel-graph
</code>
</pre>

<h2>Step 2:Install Lighthouse</h2>
<p>Install Lighthouse via Composer:</p>
<pre>
<code>
 composer require nuwave/lighthouse
</code>
</pre>
<h2> Step3:Publish the Lighthouse Configuration </h2>
<pre>
 <code>
  php artisan vendor:publish --tag=lighthouse-schema
  php artisan vendor:publish --tag=lighthouse-config
 </code>
</pre>

<p>
After that, you’ll have:
<ul>
 <li>
  config/lighthouse.php
 </li>
 <li>
  graphql/schema.graphql
 </li>
</ul>
</p>

<h2>Configure GraphQL Route</h2>
<p>By default, Lighthouse automatically registers /graphql as the endpoint.
You can check or change it in config/lighthouse.php:</p>
<pre>
 <code>
  'route' => [
    'uri' => '/graphql',
],
 </code>
</pre>

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
