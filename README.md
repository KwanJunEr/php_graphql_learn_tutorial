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


<h1>How to Add in GraphQL into modules</h1>
<p>Doument Link: https://docs.google.com/document/d/1eks0pFBePMDVdYc3KUz96izT_8e4CVs3l_Q-EIDuL1M/edit?usp=sharing </p>

<h1>Adding Names to GraphQL Playground to Test Different Functions</h1>
<pre>
 <code>
  mutation create_tier{
 firstTier: createTier(input: {
    name: "Nice Tier",
    description: "High-level membership",
    tier_status: true,
    conditions: [
      { setting_tier_condition_id: 1, wallet_type_id: 1 },
      { setting_tier_condition_id: 2, wallet_type_id: 2 }
    ],
    downgrade_condition: {
      setting_tier_downgrade_condition_id: 4,
      value: "2"
    }
  }) {
    id
    name
    description
  }

  secondTier: createTier(input: {
    name: "Tier Without Downgrade",
    description: "High-level membership Lifetime",
    tier_status: true,
    conditions: [
      { setting_tier_condition_id: 1, wallet_type_id: 1},
      { setting_tier_condition_id: 2, wallet_type_id: 2}
    ]
  }) {
    id
    name
    description
  }
}

mutation login{
  Login(input:{
    email:"admin@webbygroup.com.my"
    password:"password"
  }){
    data{
      token
    }
  }
}

mutation updateTier{
  updateTier(
    id: 2
    input: {name: "Awesome Tier", 
      description: "Tier That is Awesome", 
      tier_status: true, 
      conditions: [
        {setting_tier_condition_id: 2, wallet_type_id: 1},
      	{setting_tier_condition_id: 1, wallet_type_id: 2}	
      ],
      downgrade_condition:{
         setting_tier_downgrade_condition_id: 4,
      	 value: "2"
      }
      sub_tiers:[
          {
      tier_id: 2,  # change this to your actual Tier ID
      name: "Sub Tier A",
      description: "Entry-level under Nice Tier",
      level: 1,
      conditions: [
        { tier_condition_id: 5, setting_tier_condition_id: 1, value: 50.0 },
        { tier_condition_id: 4, setting_tier_condition_id: 2, value: 100.0 }
      ]
    },
    {
      tier_id: 2,
      name: "Sub Tier B",
      description: "Next level under Nice Tier",
      level: 2,
      conditions: [
        { tier_condition_id: 5, setting_tier_condition_id: 1, value: 150.0 },
        { tier_condition_id: 4, setting_tier_condition_id: 2, value: 300.0 }
      ]
    }
      ]
    
    
    
    }
  ) {
    id
    name
    description
    tier_status
    conditions {
      id
      wallet_type_id
      setting {
        id
        name
      }
    }
    downgradeCondition {
      id
      value
      setting {
        id
        name
      }
    }
    subTiers {
      id
      name
      level
      conditions {
        id
        value
        setting {
          id
          name
        }
      }
    }
  }
}

 </code>
</pre>
