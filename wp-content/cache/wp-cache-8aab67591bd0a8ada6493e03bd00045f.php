<?php die(); ?><?xml version="1.0" encoding="UTF-8"?><rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	>

<channel>
	<title>Aaron Krauss</title>
	<atom:link href="https://thesocietea.org/feed/" rel="self" type="application/rss+xml" />
	<link>https://thesocietea.org</link>
	<description>Developer</description>
	<lastBuildDate>Fri, 14 Apr 2017 17:08:39 +0000</lastBuildDate>
	<language>en-US</language>
	<sy:updatePeriod>hourly</sy:updatePeriod>
	<sy:updateFrequency>1</sy:updateFrequency>
	<generator>https://wordpress.org/?v=4.7.3</generator>
<site xmlns="com-wordpress:feed-additions:1">46707861</site>	<item>
		<title>Design Patterns: Dependency Injection</title>
		<link>https://thesocietea.org/2017/03/design-patterns-dependency-injection/</link>
		<comments>https://thesocietea.org/2017/03/design-patterns-dependency-injection/#respond</comments>
		<pubDate>Thu, 30 Mar 2017 12:00:46 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[How Things Work]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1459</guid>
		<description><![CDATA[If you&#8217;re a developer, you may have heard of the phrase dependency injection (DI) before as a possible design pattern you can use. It&#8217;s been around for a long time, and many popular frameworks such as Angular.js use it by default. In standard code, it&#8217;s common to declare a dependency in the same lexical scope where you...]]></description>
				<content:encoded><![CDATA[<p>If you&#8217;re a developer, you may have heard of the phrase <a href="https://en.wikipedia.org/wiki/Dependency_injection" target="_blank">dependency injection</a> (DI) before as a possible design pattern you can use. It&#8217;s been around for a long time, and many popular frameworks such as <a href="https://en.wikipedia.org/wiki/Dependency_injection#AngularJS_example" target="_blank">Angular.js</a> use it by default. In standard code, it&#8217;s common to declare a dependency in the same lexical scope where you actually plan use that dependency. Nothing sounds crazy about that, right? DI flips this on its head &#8211; and for good reason too. The core concept of DI is to <a href="https://en.wikipedia.org/wiki/Inversion_of_control" target="_blank">invert the control</a> of managing dependencies so that instead of the <strong>client</strong> (i.e. the scope where the code actually exists) having to manage its own dependencies, you instead delegate this responsibility to the code which actually <em>calls</em> your client, typically passing in dependencies as arguments to that client. This is where the name &#8220;dependency injection&#8221; comes from &#8211; you <em>inject</em> the dependencies into your client code during the execution of that code.</p>
<p>If you&#8217;re familiar with DI &#8211; then you haven&#8217;t learned anything new yet, but if this is your first go at understanding this design pattern, then surely you have some red flags popping up right now. This just seems to convolute how I would write my code, why would I do this? What are the benefits of DI? Is it difficult to implement? We&#8217;ll get to all of this. Keep following along.</p>
<h2>Benefits of DI</h2>
<p>Applications built with DI boast a fair number of benefits &#8211; and while there&#8217;s more than this, here&#8217;s a list of some of my favorites:</p>
<p><strong>Loose coupling.</strong></p>
<p>With DI, your code is by default more loosely coupled which makes it easier to &#8220;plug-and-play&#8221; throughout your application; for example, you don&#8217;t have to worry about using a dependency that was potentially declared in an external scope compared to where you&#8217;re actually using it. All your code needs to worry about is what it actually does &#8211; and not about what exists around it.</p>
<p>Taking loose coupling even further, DI is very functional in nature too in the sense that it helps your functions maintain a <a href="https://en.wikipedia.org/wiki/Pure_function" target="_blank">pure</a> state. Including dependencies from outside of the immediate scope means that the state of your client code could change at any given time &#8211; and while using DI doesn&#8217;t force you to necessarily write pure functions &#8211; it helps guide you on that path more so than other design patterns.</p>
<p><strong>Testing is very simple.</strong></p>
<p>Imagine you want to test a function which makes a request to a third-party JSON API, and you need certain data to return from that service in order for it to execute properly. This is very difficult to test because not only do external HTTP requests take a significant amount of time compared to the rest of your test&#8217;s execution &#8211; it&#8217;s most likely not feasible or reliable for you to be making HTTP requests during testing. What if the third-party service goes down? What if you have a request quota? What if the service takes a few seconds to respond? There&#8217;s a ton of reasons why this might be an issue.</p>
<p>With DI, you would pass in this particular request library as an argument to your client code &#8211; but since you&#8217;re passing it in from your test code, it&#8217;s very simple for you to build a mock of this request library that simulates real behavior; instead of making an HTTP request, it could just immediately respond with test data that you would expect to get back as a response, and then continue on executing the rest of your client code in your test.</p>
<p>Here&#8217;s an example of how this library might be used with DI (and Javascript&#8217;s new <a href="https://ponyfoo.com/articles/understanding-javascript-async-await" target="_blank">async/await</a> keywords):</p><pre class="crayon-plain-tag">function foo(httpLib) {
  var data = await httpLib.get('http://api.com/users/1')
  return data.id
}</pre><p>And here&#8217;s a simple unit test we could write for this function:</p><pre class="crayon-plain-tag">function testFoo() {
  var httpMock = {
    get: async function getStub(){
      return { id: 1 };
    }
  };

  var response = foo(httpMock);
  expect(response).to.be(1) // true
}</pre><p><strong>Single source of declaration</strong>.</p>
<p>You don&#8217;t need to require the same files multiple times in a project &#8211; with DI, you only have to do this once. Requiring a file multiple times could needlessly increase the total size of your application &#8211; but even though most programming languages handle this so that you still only pull in the same file once, it&#8217;s still cleaner and easier to debug when you code it in just one spot.</p>
<h2>Implementing DI</h2>
<p>You can implement DI in a number of different ways, but there are <a href="https://en.wikipedia.org/wiki/Dependency_injection#Three_types_of_dependency_injection" target="_blank">3 simple patterns</a> of doing so if you&#8217;re using a class-based object-oriented language: the constructor, setter, and interface patterns. All of them revolve around the concept of setting each dependency as an instance variable on an object so that you can access them just about anywhere.</p>
<p>Here&#8217;s a simple example of code <strong>without</strong> DI:</p><pre class="crayon-plain-tag">public SomeClass() {
  this.myObject = factory.getObject();
}</pre><p>Here, factory is a dependency defined in the external lexical scope of this file. This is nice and simple &#8211; but what if you want to build a unit test, and factory.getObject is a very hard function to handle during your test? This is where DI really shines, and here&#8217;s a simple way you can transform this example to use it:</p><pre class="crayon-plain-tag">public SomeClass (Factory factory) {
  this.factory = factory;

  // Now we can call this.factory.getObject() anywhere in the class!
}</pre><p>Here, we pass in a dependency and set it equal to an instance variable &#8211; and now we can use this dependency anywhere we see fit with this property. We&#8217;ve transformed the SomeClass constructor into a pure function which solely depends on the arguments passed in when it&#8217;s called. That, my friend, is loose coupling.</p>
<h3>Using an IoC Container</h3>
<p>DI is a wonderful concept and is rather easy to implement on a small scale, but it can quickly get messy if you start needing to inject dependencies all over the place in various files. This is where using an IoC (inversion of control) container &#8211; also known as a DI container &#8211; comes in to play. The purpose of an IoC container is to handle settting up all the necessary dependencies so that you don&#8217;t have to duplicate convoluted instantiation code across your project; the IoC container is the only place you would write that.</p>
<p>Imagine code that looks like this:</p><pre class="crayon-plain-tag">FooService foo = new FooService(new BarService(), 
   new BazService(), new FooBarService(), 
   new BazBarService(new Config()), 
   new Logger(new FooLogger(new Config())));</pre><p>There&#8217;s nothing logically wrong here &#8211; we&#8217;re following proper DI principles &#8211; but it&#8217;s still very messy. The real danger here is that if we wanted to ever instantiate an object of class FooService again, then we would need to duplicate all of this code, and that seems like a code smell.</p>
<p>Now imagine we&#8217;re using an IoC container. Our code could potentially look like this:</p><pre class="crayon-plain-tag">FooService foo = IoC.Resolve&lt;IFooService&gt;();</pre><p>Here, we haven&#8217;t lost any of our logic &#8211; we&#8217;ve just delegated the instantiation of a FooService object to our IoC container, which handles creating this object just like our code before did; our benefit now is just that if we need to duplicate this behavior across our project, we just delegate that responsibility to our IoC container instead of our client code. Our IoC container becomes the single source for handling all of our dependencies &#8211; and that&#8217;s pretty nice.</p>
<h2>Detriments of DI</h2>
<p>While we&#8217;ve shown the benefits so far, DI isn&#8217;t without its faults. Here&#8217;s a couple valid reasons that might make DI less appealing depending on your situation.</p>
<p><strong>More difficult to trace.</strong></p>
<p>When you&#8217;re debugging code that&#8217;s using DI, if the error stems from a dependency, then you may need to follow your stack trace a little bit further to see where the error actually occurs. Because dependencies no longer exist in the same file and/or class as where your logic is happening, you need to know exactly what called the code in question to understand where the problem may lie.</p>
<p>On top of this, learning these types of traversal concepts may be more difficult for developers who are just joining a project for the first time.</p>
<p><strong>More upfront development.</strong></p>
<p>In almost all cases, building a project with the DI pattern will take more upfront development time than a traditional project. Most of this has to do with understanding how your project&#8217;s architecture should work, what constitutes a dependency, and potentially building an IoC container.</p>
<p>In the long run, however, DI could save you a lot of development time and headaches as you begin to add on more components to your project and also need to test those components.</p>
<h2>Final Thoughts</h2>
<p>DI is a nice design pattern and it&#8217;s helped me tremendously in the applications where I&#8217;ve used it. For the most part, my favorite use case for DI is how simple it is to test every component of your project. If there&#8217;s a third-party dependency that makes it difficult to test the rest of my logic, then I can easily mock that dependency and stub out any functionality it has.</p>
<p>But &#8211; it&#8217;s more complex than non-DI code, and that may be a turn off for many developers out there. Whether you decide to implement DI into some of your projects is always your decision &#8211; but if you want my opinion, give it a shot sometime. If it works out &#8211; great, you&#8217;ve found a nice design pattern you can really start using; if not, then at least you still hopefully learned something in the process!</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2017/03/design-patterns-dependency-injection/feed/</wfw:commentRss>
		<slash:comments>0</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1459</post-id>	</item>
		<item>
		<title>Building a JSON API with Rails &#8211; Part 6: The JSON API Spec, Pagination, and Versioning</title>
		<link>https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/</link>
		<comments>https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/#comments</comments>
		<pubDate>Thu, 09 Feb 2017 12:00:28 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[Ruby]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1580</guid>
		<description><![CDATA[Throughout this series so far, we&#8217;ve built a really solid JSON API that handles serialization and authentication &#8211; two core concepts that any serious API will need. With everything we&#8217;ve learned, you could easily build a stable API that accomplishes everything you need for phase 1 of your project &#8211; but if you&#8217;re building an API that&#8217;s...]]></description>
				<content:encoded><![CDATA[<p>Throughout this series so far, we&#8217;ve built a really solid JSON API that handles serialization and authentication &#8211; two core concepts that any serious API will need. With everything we&#8217;ve learned, you could easily build a stable API that accomplishes everything you need for phase 1 of your project &#8211; but if you&#8217;re building an API that&#8217;s gonna be consumed by a large number of platforms and/or by a complex front-end, then you&#8217;ll probably run into some road blocks before too long. You might have questions like &#8220;what&#8217;s the best strategy to serialize data?,&#8221; or &#8220;how about pagination or versioning &#8211; should I be concerned that I haven&#8217;t implemented any of that yet?&#8221; Those are all good questions that we&#8217;re going to address in this post &#8211; so keep following along!</p>
<h2>The JSON API Spec</h2>
<p><a href="https://github.com/rails-api/active_model_serializers" target="_blank">Active Model Serializers</a> &#8211; my go-to Rails serialization gem of choice &#8211; makes it so simple to control what data your API returns in the body (check out my post on <a href="https://thesocietea.org/2015/03/building-a-json-api-with-rails-part-2-serialization/" target="_blank">Rails API serialization</a> to learn more about this topic). By default, however, there&#8217;s very little structure as to how your data is returned &#8211; and that&#8217;s on purpose; AMS isn&#8217;t meant to be opinionated &#8211; it just grants you, the developer, the power to manipulate what your Rails API is returning. This sounds pretty awesome, but when you start needing to serialize several resources, you might start wanting to follow a common JSON response format to give your API a little more structure as well as making documentation easier.</p>
<p>You can always create your own API response structure that fits your project&#8217;s needs &#8211; but then you&#8217;d have to go through and document why things are the way they are so that other developers can use the API and/or develop on it. This isn&#8217;t terrible &#8211; but it&#8217;s a pain that can easily be avoided because this need has already been addressed via the <a href="http://jsonapi.org/" target="_blank">JSON API Spec</a>.</p>
<p>The JSON API spec is a best-practice specification for building JSON APIs, and as of right now, it&#8217;s definitely the most commonly-used and most-documented format for how you should return data from your API. It was started in 2013 by <a href="http://yehudakatz.com/" target="_blank">Yehuda Katz</a> (former core Rails team member) as he was continuing to help build <a href="http://emberjs.com/" target="_blank">Ember.js</a>, and it officially hit a stable 1.0 release in May of 2015.</p>
<p>If you take a look at the actual spec, you&#8217;ll notice that it&#8217;s pretty in-depth and might look difficult to implement just right. Luckily, AMS has got our back by making it stupid-simple to abide by the JSON API spec. AMS determines JSON structure based on an <a href="https://github.com/rails-api/active_model_serializers/blob/master/docs/general/adapters.md" target="_blank">adapter</a>, and by default, it uses what&#8217;s called the &#8220;attributes adapter.&#8221; This is the simplest adapter and puts your raw data as high up in the JSON hierarchy as it can, without thinking about any sort of structure other than what you have set in the serializer file. For a simple API, this works; but for a complex API, we should use the JSON API spec.</p>
<p>To get AMS to use the JSON API spec, we literally have to add one line of code, and then we&#8217;ll automatically be blessed with some super sweet auto-formatting. You just need to create an initializer, add the following line, and restart your server:</p><pre class="crayon-plain-tag">ActiveModelSerializers.config.adapter = :json_api</pre><p>Let&#8217;s do a quick show-and-tell, in case you want to see it in action before you try it. Assuming we have the following serializer for a <strong>post</strong>:</p><pre class="crayon-plain-tag">class PostSerializer &lt; ActiveModel::Serializer
  attributes :id, :title, :body

  belongs_to :user
  has_many :comments
end</pre><p>Then our response will go from this:</p><pre class="crayon-plain-tag">{
  "id": 1,
  "title": "Ruby - for when Python just can't cut it.",
  "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
  "user": {
    "id": 1,
    "first_name": "Johnny",
    "last_name": "User",
    "email": "user@example.com"
  },
  "comments": [
    {
      "id": 1,
      "body": "Ruby is pretty rootin' tootin' neat."
    }
  ]
}</pre><p>to this!</p><pre class="crayon-plain-tag">{
  "data": {
    "id": "1",
    "type": "posts",
    "attributes": {
      "title": "Ruby - for when Python just can't cut it.",
      "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
    },
    "relationships": {
      "user": {
        "data": {
          "id": "1",
          "type": "users"
        }
      },
      "comments": {
        "data": [
          {
            "id": "1",
            "type": "comments"
          }
        ]
      }
    }
  }
}</pre><p>The JSON API spec also sets a precedent for how paginated resource queries should be structured in the url &#8211; which we&#8217;re getting to next!</p>
<h2>Pagination</h2>
<p>Pagination prevents a JSON response from returning every single record in a resource&#8217;s response all at once, and instead allows the client to request a filtered response that it can continue querying on as it needs more data. Pagination is one of those things where every project seems to do it differently; there&#8217;s very little standard across the board &#8211; but there is in fact a best practice way to do it in a JSON API. A paginated resource on the server should always at a minimum tell the client the total number of records that exist, the number of records returned in the current request, and the current page number of data returned. Better paginated resources will also create and return the paginated links that the client can use (i.e. first page, last page, previous page, next page), but they tend to do that in the response body &#8211; and that&#8217;s not good. The reason this is frowned upon is because while dumping pagination links in the response body may be easy, it really has nothing to do with the actual JSON payload that the client is requesting. Is it valuable information? Certainly &#8211; but it&#8217;s not raw data. It&#8217;s meta-data &#8211; and <a href="https://tools.ietf.org/html/rfc5988" target="_blank">RFC 5988</a> created a perfect place to put such paginated links: the HTTP <a href="https://www.w3.org/wiki/LinkHeader" target="_blank">Link</a> header.</p>
<p>Here&#8217;s an example of a link header:</p><pre class="crayon-plain-tag">Link:
&lt;http://localhost:3000/posts?page=1&gt;; rel="first",
&lt;http://localhost:3000/posts?page=1&gt;; rel="prev",
&lt;http://localhost:3000/posts?page=4&gt;; rel="last",
&lt;http://localhost:3000/posts?page=3&gt;; rel="next"</pre><p>That might seem like a large HTTP header &#8211; but it&#8217;s blatantly obvious what&#8217;s going on, and we&#8217;re keeping our response body clean in the process. Now, just like with the JSON API spec, you might be asking if you have to manually add these links in when returning any paginated response &#8211; and the answer is no! There are gems out there that do this automatically for you while following best practices! Let&#8217;s get into the code.</p>
<p>To start with, we&#8217;ll need to use one of the two most popular pagination libraries in Rails: <a href="https://github.com/mislav/will_paginate" target="_blank">will_paginate</a> or <a href="https://github.com/kaminari/kaminari" target="_blank">kaminari</a>. It literally doesn&#8217;t matter which we pick, and here&#8217;s why: both libraries take care of pagination &#8211; but they&#8217;re really geared towards paginating the older styles of Rails apps that also return server-side rendered HTML views, instead of JSON. On top of that, neither of them follow the best practice of returning paginated links in the Link header. So, are we out of luck? No! There&#8217;s a wonderful gem that sits on top of either of these gems called <a href="https://github.com/davidcelis/api-pagination" target="_blank">api-pagination</a> that takes care of what we need. Api-pagination doesn&#8217;t try to reinvent the wheel and create another implementation of pagination; instead, it uses either will_paginate or kaminari to do the actual logic behind pagination, and then it just automatically sets the Link header (as well as making the code changes that you as the developer have to make much, much simpler).</p>
<p>We&#8217;ll use will_paginate with api-pagination in this example. For starters, add this to your Gemfile:</p><pre class="crayon-plain-tag">gem 'will_paginate'
gem 'api-pagination'</pre><p>Next, install them and restart your server:</p><pre class="crayon-plain-tag">bundle install
rails s</pre><p>Let&#8217;s update our Post controller to add in pagination. Just like with the JSON API spec above, we only have to make a single line change. Update the post_controller&#8217;s <strong>index</strong> action from this:</p><pre class="crayon-plain-tag">def index
  @posts = Post.all

  render json: @posts
end</pre><p>to this:</p><pre class="crayon-plain-tag">def index
  @posts = Post.all

  paginate json: @posts
end</pre><p>Do you see what we did? We just removed the <strong>render</strong> function call and instead added the <strong>paginate</strong> function call that api-pagination gives us. That&#8217;s literally it! Now if you query the following route, then you&#8217;ll receive a paginated response:</p><pre class="crayon-plain-tag">http://localhost:3000/posts?per_page=1&amp;page=2</pre><p></p><pre class="crayon-plain-tag">{
  "data": [
    {
      "id": "2",
      "type": "posts",
      "attributes": {
        "title": "Who would win between a Ruby Warrior or a Ruby Rogue?",
        "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
      },
      "relationships": {
        "user": {
          "data": {
            "id": "1",
            "type": "users"
          }
        },
        "comments": {
          "data": [
            {
              "id": "2",
              "type": "comments"
            }
          ]
        }
      }
    }
  ],
  "links": {
    "self": "http://localhost:3000/posts?page%5Bnumber%5D=2&amp;page%5Bsize%5D=1&amp;per_page=1",
    "first": "http://localhost:3000/posts?page%5Bnumber%5D=1&amp;page%5Bsize%5D=1&amp;per_page=1",
    "prev": "http://localhost:3000/posts?page%5Bnumber%5D=1&amp;page%5Bsize%5D=1&amp;per_page=1",
    "next": "http://localhost:3000/posts?page%5Bnumber%5D=3&amp;page%5Bsize%5D=1&amp;per_page=1",
    "last": "http://localhost:3000/posts?page%5Bnumber%5D=4&amp;page%5Bsize%5D=1&amp;per_page=1"
  }
}</pre><p></p><pre class="crayon-plain-tag">Link:
&lt;http://localhost:3000/posts?page=1&gt;; rel="first",
&lt;http://localhost:3000/posts?page=1&gt;; rel="prev",
&lt;http://localhost:3000/posts?page=4&gt;; rel="last",
&lt;http://localhost:3000/posts?page=3&gt;; rel="next"</pre><p></p>
<h3>Bonus</h3>
<p>You&#8217;ll notice that after all my babbling about putting paginated links in the HTTP header instead of the response body, they still managed to find themselves in the response body! This is a neat feature of AMS if you&#8217;re using the JSON API adapter; it will recognize if you&#8217;re using either will_paginate or kaminari, and will automatically build the right pagination links and set them in the response body. While it&#8217;s not a best practice to do this &#8211; I&#8217;m not too worried about removing them because we&#8217;re still setting the HTTP Link header. We&#8217;re sort of in this transition period where many APIs are still placing paginated links in the response body &#8211; and if the AMS gem wants to place them in there with requiring no effort from the developer, then be my guest. It may help ease the burden of having new clients transition to parsing the Link header.</p>
<p>Now, here&#8217;s a little caveat. The JSON API spec has a preferred way of querying paginated resources, and it uses the <strong>page</strong> query object to do so, like in this example:</p><pre class="crayon-plain-tag">http://localhost:3000/posts?page[size]=1&amp;page[number]=2</pre><p>This query is identical to our query above; we just swapped out <strong>per_page</strong> for <strong>page[size]</strong>, and <strong>page</strong> for <strong>page[number]</strong>. By default, the links that AMS creates follow this new pattern, but api-pagination by default doesn&#8217;t know how to parse that. Don&#8217;t worry though, it&#8217;s as easy as just adding a simple initializer to allow api-pagination to handle both methods of querying for paginated resources:</p><pre class="crayon-plain-tag">ApiPagination.configure do |config|

  config.page_param do |params|
    if params[:page].is_a? ActionController::Parameters
      params[:page][:number]
    else
      params[:page]
    end
  end

  config.per_page_param do |params|
    if params[:page].is_a? ActionController::Parameters
      params[:page][:size]
    else
      params[:per_page]
    end
  end

end</pre><p>And wallah &#8211; add this initializer, restart your server, and now your API can handle paginated query params passed in as either <strong>page/</strong><strong>per_page</strong>, and <strong>page[number]</strong>/<strong>page[size</strong><strong>]</strong>!</p>
<h2>Versioning</h2>
<p>The last best practice topic we&#8217;ll be covering here is how to properly version your API. The concept of versioning an API becomes important when you need to make non-backwards-compatible changes; ideally, an API will be used by various client applications &#8211; and it&#8217;s unfeasible to update them all at the same time, which is why your API neds to be able to support multiple versions simultaneously. Because you don&#8217;t really need a solid versioning system early-on in the development phase, this is often an overlooked topic &#8211; but I really implore you to start thinking about it early because it becomes increasingly more difficult to implement down the road. Spend the mental effort now on a plan to version your API, and save yourself a good deal of technical debt down the road.</p>
<p>Now that I&#8217;ve got my soap box out of the way, let&#8217;s get down to the best practices of implementing a versioning system. If you Google around, you&#8217;ll find that there are two predominant methodologies to how you can go about it:</p>
<ul>
<li>Version in your URLs (e.g. <strong>/v1/posts</strong>)</li>
<li>Version via the HTTP <a href="https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html" target="_blank">Accept</a> header</li>
</ul>
<p>Versioning through your URLs is the easier of the two to understand, and it&#8217;s got a big benefit: it&#8217;s much easier to test. I can send you a link to a <strong>v1</strong> path as well as a <strong>v2</strong> path &#8211; and you can check them both out instantaneously. The drawback however &#8211; which is why this way isn&#8217;t a best practice &#8211; is because the path in your URL should be completely representative of the resource you&#8217;re requesting (think <strong>/posts</strong>, <strong>/users/1</strong>, etc.), and which version of the API you&#8217;re using doesn&#8217;t really fit into that. It&#8217;s important &#8211; sure &#8211; but there&#8217;s a better place to put that information: the HTTP Accept header.</p>
<p>The Accept header specifies which <a href="https://en.wikipedia.org/wiki/Media_type" target="_blank">media types</a> (aka MIME types) are acceptable for the response; this is a perfect use-case for specifying which version of the API you want to hit, because responses from that version are the only ones that you&#8217;ll accept!</p>
<p>For our demo, we&#8217;re going to specify the version in a custom media type that looks like this:</p><pre class="crayon-plain-tag">application/vnd.example.v1</pre><p>Here, you can easily see how we set the version to <strong>v1</strong> (If you&#8217;d like to know how we got this format of media type, check out how MIME <a href="https://en.wikipedia.org/wiki/Media_type#Vendor_tree" target="_blank">vendor trees</a> work). If we want to query <strong>v2</strong>, then we&#8217;ll just swap out the last part of that media type.</p>
<p>Let&#8217;s get to some implementation. We won&#8217;t need any new gems, but there are a couple of things we do need to do first:</p>
<ul>
<li>Move all of the files in our <strong>app/controllers</strong> directory into a <strong>v1</strong> directory. So the full path of our controllers would then be <strong>app/controllers/v1</strong>.</li>
<li>Move all of the code in our controllers into a <strong>V1</strong> module. That looks like this:</li>
</ul>
<p></p><pre class="crayon-plain-tag">module V1
  class PostsController &lt; ApplicationController
  .
  .
  .
  end
end</pre><p></p>
<ul>
<li>Wrap all of our routes in a <strong>scope</strong> function call, and utilize an instantiated object from a new <strong>ApiConstraints</strong> class that we&#8217;ll add in (this will filter our routes based on the Accept header).</li>
</ul>
<p></p><pre class="crayon-plain-tag">require 'api_constraints'

Rails.application.routes.draw do
  scope module: :v1, constraints: ApiConstraints.new(version: 1, default: true) do
    resources :comments
    resources :posts
    resources :users
  end
end</pre><p>We still need to add in the code for our ApiConstraints class, but you can kind of see what&#8217;s going on here. We&#8217;re specifying that this set of routes will specifically handle any <strong>v1</strong> calls &#8211; as well as being the default routes, in case a version isn&#8217;t specified.</p>
<p>The <strong>constraints</strong> option in the scope function is powerful and it works in a very specific way: it accepts any sort of object that can respond to a method called <strong>matches?</strong>, which it uses to determine if the constraint passes and allows access to those routes. Now for the last step; let&#8217;s add the logic for ApiConstraints. To do this, we&#8217;re going to add a file in the <strong>/lib</strong> directory called api_constraints.rb:</p><pre class="crayon-plain-tag"># By Ryan Bates - http://railscasts.com/episodes/350-rest-api-versioning

class ApiConstraints
  def initialize(options)
    @version = options[:version]
    @default = options[:default]
  end

  def matches?(req)
    @default || req.headers['Accept'].include?("application/vnd.example.v#{@version}")
  end
end</pre><p>You an see here that all this class does is handle the <strong>matches?</strong> method. In a nutshell, it parses the Accept header to see if the version matches the one you passed in &#8211; or it will just return true if the default option was set.</p>
<p>If you liked this neat little constraint &#8211; then I&#8217;m glad, but I take zero credit for this logic. Ryan Bates did a really great <a href="http://railscasts.com/episodes/350-rest-api-versioning" target="_blank">RailsCast</a> over versioning an API a few years ago, and this is by-the-books his recommendation about how to parse the Accept header.</p>
<p>You&#8217;re now all set up with the best practice of specifying an API version via the Accept header! When you need to add a new version, you&#8217;ll create new controllers inside of a version directory, as well as add new routes that are wrapped in a versioned constraint. You don&#8217;t need to version models.</p>
<h2>Final Thoughts</h2>
<p>We covered a lot, but I hope it wasn&#8217;t too exhausting. If there&#8217;s one common goal towards building a best-practice JSON API, it&#8217;s to use HTTP as it&#8217;s meant to be used. It&#8217;s easy to dump everything in your response body in an unorganized manner &#8211; but we can do better than that. Just do your best to follow RESTful practices, and if you have any questions about what you&#8217;re doing, then don&#8217;t be afraid to look it up; the Internet will quickly guide you down the right path.</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2017/02/building-a-json-api-with-rails-part-6-the-json-api-spec-pagination-and-versioning/feed/</wfw:commentRss>
		<slash:comments>9</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1580</post-id>	</item>
		<item>
		<title>Programming Concepts: Garbage Collection</title>
		<link>https://thesocietea.org/2017/01/programming-concepts-garbage-collection/</link>
		<comments>https://thesocietea.org/2017/01/programming-concepts-garbage-collection/#comments</comments>
		<pubDate>Thu, 26 Jan 2017 12:00:25 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[Programming Concepts]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1419</guid>
		<description><![CDATA[Continuing on in this series, today we&#8217;re going to talk about garbage collection (GC) &#8211; what it is, how it works, and what some of the algorithms behind it are. Let me just say now that there are people way smarter than me who can give you nitty-gritty details about how specific languages implement GC,...]]></description>
				<content:encoded><![CDATA[<p>Continuing on in this series, today we&#8217;re going to talk about garbage collection (GC) &#8211; what it is, how it works, and what some of the algorithms behind it are. Let me just say now that there are people way smarter than me who can give you nitty-gritty details about how specific languages implement GC, what libraries alter it from the norm, etc. What I&#8217;m trying to accomplish here is to give you a bird&#8217;s eye view of this whole facet of development in the hopes that you learn something you didn&#8217;t know before &#8211; and if it genuinely interests you, then I hope you continue Googling to find those posts which dig a mile deep into specific GC implementations. Here, we&#8217;ll stick to about a few feet deep &#8211; so let&#8217;s start digging.</p>
<h2>What is Garbage Collection?</h2>
<p>At its core, GC is a process of automated memory management so that you as a developer have one less thing to worry about. When you allocate memory &#8211; like by creating a variable &#8211; that memory is allocated to either the stack or the heap (check out my post on <a href="https://thesocietea.org/2014/10/programming-concepts-the-stack-and-the-heap/">the stack vs. the heap</a> if you want to learn more about these two). You allocate to the stack when you&#8217;re defining things in a local scope where you know exactly the memory block size you need, such as primitive data types, arrays of a set size, etc. The stack is a self-managing memory store that you don&#8217;t have to worry about &#8211; it&#8217;s super fast at allocating and clearing memory all by itself. For other memory allocations, such as objects, buffers, strings, or global variables, you allocate to the heap.</p>
<p>Compared to the stack, the heap is not self-managing. Memory allocated to the heap will sit there throughout the duration of the program and can change state at any point in time as you manually allocate/deallocate to it. The garbage collector is a tool that removes the burden of manually managing the heap. Most modern languages such as Java, the .NET framework, Python, Ruby, Go, etc. are all garbage collected languages; C and C++, however, are not &#8211; and in languages such as these, manual memory management by the developer is an extremely important concern.</p>
<h2><strong>Why Do We Need It?</strong></h2>
<p>GC helps save the developer from several memory-related issues &#8211; the foremost being <a href="https://en.wikipedia.org/wiki/Memory_leak" target="_blank">memory leaks</a>. As you allocate more and more memory to the heap, if the program doesn&#8217;t consistently release this memory as it becomes unneeded, memory size will begin to add up &#8211; resulting in a <a href="https://en.wikipedia.org/wiki/Heap_overflow" target="_blank">heap overflow</a>. Even if heap memory is diligently managed by the developer &#8211; all it takes is one variable to be consistently left undeleted to result in a memory leak, which is bad.</p>
<p>Even if there are no memory leaks, what happens if you are attempting to reference a memory location which has already been deleted or reallocated? This is called a <a href="https://en.wikipedia.org/wiki/Dangling_pointer" target="_blank">dangling pointer</a>; the best case scenario here is that you would get back gibberish, and hopefully throw or cause a validation error soon after when that variable is used &#8211; but there&#8217;s nothing stopping that memory location from being overwritten with new data which could respond with seemingly valid (but logically incorrect) data. You&#8217;d have no idea what would be going on, and it&#8217;s these types of errors &#8211; memory errors &#8211; that are often times the most difficult to debug.</p>
<p>That&#8217;s why we need GC. It helps with all of this. It&#8217;s not perfect &#8211; it does use up extra resources on your machine to work and it&#8217;s normally not as efficient as proper manual memory management &#8211; but the problems it saves you from make it more than worth it.</p>
<h2>How and When does the Garbage Collector Run?</h2>
<p>This depends entirely on the algorithm used for GC. There isn&#8217;t one hard and fast way to do it, and just like compilers and interpreters, GC mechanisms get better over time. Sometimes the garbage collector will run at pre-determined time intervals, and sometimes it waits for certain conditions to arise before it will run. The garbage collector will just about always run on a separate thread in tandem with your program &#8211; and depending on the language&#8217;s implementation of GC, it can either stall your program (i.e. stop-the-world GC) to sweep out all the garbage at once, run incrementally to remove small batches, or run concurrently with your program.</p>
<p>It&#8217;s difficult to get deeper than this without getting into specific languages&#8217; implementations of GC, so let&#8217;s move onto the common GC algorithms.</p>
<h2>Garbage Collection Algorithms</h2>
<p>There&#8217;s a bunch of different GC algorithms out there &#8211; but here are some of the most common ones you&#8217;ll come across. It&#8217;s interesting to note how many of these common algorithms build on one another.</p>
<h3><span style="text-decoration: underline;">Reference Counting</span></h3>
<p><a href="https://en.wikipedia.org/wiki/Reference_counting" target="_blank">Reference counting</a> is perhaps the most basic form of GC, and the easiest to implement on your own. The way it works is that anytime you reference a memory location on the heap, a counter for that particular memory location increments by 1. Every time a reference to that location is deleted, the counter decrements by 1. When that counter gets to 0, then that particular memory location is garbage collected.</p>
<p>One of the big benefits of GC by reference counting is that it can immediately tell if there is garbage (when a counter hits 0). However, there are some major problems with reference counting; circular references just flat out can&#8217;t be garbage collected &#8211; meaning that if object A has a reference to object B, and object B has a reference back to object A, then neither of these objects can ever be garbage collected according to reference counting. On top of this, reference counting is very inefficient because of the constant writes to the counters for each memory location.</p>
<p>Because of these problems, other algorithms (or at least refined versions of reference counting) are more commonly used in modern GC.</p>
<h3><span style="text-decoration: underline;">Mark-Sweep</span></h3>
<p>Mark-sweep &#8211; as well as just about all modern GC algorithms other than reference counting &#8211; is a form of a <a href="https://en.wikipedia.org/wiki/Tracing_garbage_collection" target="_blank">tracing</a> GC algorithm, which involves <em>tracing</em> which objects are reachable from one or multiple &#8220;roots&#8221; in order to find unreachable (and thus unused) memory locations. Unlike reference counting, this form of GC is not constantly checking and it can theoretically run at any point in time.</p>
<p>The most basic form of mark-sweep is the <a href="https://en.wikipedia.org/wiki/Tracing_garbage_collection#Na.C3.AFve_mark-and-sweep" target="_blank">naïve mark-sweep</a>; it works by using a special bit on each allocated memory block that&#8217;s specifically for GC, and running through all memory currently allocated on the heap twice: the first time to <strong>mark</strong> locations of dead memory via that special bit, and the second time to <strong>sweep</strong> (i.e. deallocate) those memory locations.</p>
<p>Mark-sweep is more efficient than reference counting because it doesn&#8217;t need to keep track of counters; it also solves the issue of not being able to remove circularly referenced memory locations. However, naïve mark-sweep is a prime example of stop-the-world GC because the entire program must be suspended while it&#8217;s running (non-naïve tracing algorithms can run incrementally or concurrently). Because tracing GC can happen at any point in time, you don&#8217;t ever have a good idea of when one of these stalls will happen. Heap memory is also iterated over twice &#8211; which slows down your program even more. On top of that, in mark-sweep there&#8217;s no handling of fragmented memory; to give you a visual representation of this, imagine drawing a full grid representing all of your heap memory &#8211; mark-sweep GC would make that grid look like a very bad game of Tetris. This fragmentation almost always leads to less efficient allocation of memory on the heap. So &#8211; we continue to optimize our algorithms.</p>
<h3><span style="text-decoration: underline;">Mark-Compact</span></h3>
<p><a href="https://en.wikipedia.org/wiki/Mark-compact_algorithm" target="_blank">Mark-compact</a> algorithms take the logic from mark-sweep and add on at least one more iteration over the marked memory region in an effort to <em>compact</em> them &#8211; thus defragmenting them. This address the fragmentation caused by mark-sweep, which leads to significantly more efficient future allocations via the use of a &#8220;bump&#8221; allocator (similar to how a stack works), but adds on extra time and processing while GC is running because of the extra iteration(s).</p>
<h3><span style="text-decoration: underline;">Copying</span></h3>
<p>Copying (also known as <a href="https://en.wikipedia.org/wiki/Cheney%27s_algorithm" target="_blank">Cheney&#8217;s Algorithm</a>) is slightly similar to mark-compact, but instead of iterating potentially multiple times over a single memory region, you instead just copy the &#8220;surviving&#8221; memory blocks of the region into an entirely new empty region after the mark phase &#8211; which thus compacts them by default. After the copying is completed, the old memory region is deallocated, and all existing references to surviving memory will point to the new memory region. This relieves the GC of a lot of processing, and brings down the specs to something even quicker than a mark-sweep process since the sweep phase is eliminated.</p>
<p>While you&#8217;ve increased speed though, you now have an extra requirement of needing an entirely available region of memory that is at least as large as the size of all surviving memory blocks. Additionally, if most of your initial memory region includes surviving memory, then you&#8217;ll be copying a lot of data &#8211; which is inefficient. This is where GC <em>tuning</em> becomes important.</p>
<h3><span style="text-decoration: underline;">Generational</span></h3>
<p><a href="https://en.wikipedia.org/wiki/Garbage_collection_(computer_science)#Generational" target="_blank">Generational GC</a> takes concepts from copying algorithms, but instead of copying all surviving members to a new memory region, it instead splits up memory into <em>generational </em>regions based on how old the memory is. The rationale behind generational GC is that normally, young memory is garbage collected much more frequently than older memory &#8211; so therefore the younger memory region is scanned to check for unreferenced memory much more frequently than older memory regions. If done properly, this saves both time and CPU processing because the goal is to scan only the necessary memory.</p>
<p>Older memory regions are certainly still scanned &#8211; but not as often as younger memory regions. If a block of memory in a younger memory region continues to survive, then it can be promoted to an older memory region and will be scanned less often.</p>
<h2>Final Thoughts</h2>
<p>GC isn&#8217;t the easiest topic to fully understand, and it&#8217;s something that you really don&#8217;t even need to understand when developing with modern languages &#8211; but just because you don&#8217;t <em>need</em> to know it doesn&#8217;t give you a good excuse for not learning about it. While it doesn&#8217;t affect much of the code you write, it&#8217;s an integral part of every language implementation, and the algorithm behind an implementation&#8217;s garbage collector is often times a large reason why people tend to like or dislike certain implementations. If you stuck with me this far, then I&#8217;m glad &#8211; and I hope you learned something. If this interested you, I encourage you to continue looking into GC &#8211; and <a href="https://spin.atomicobject.com/2014/09/03/visualizing-garbage-collection-algorithms/" target="_blank">here&#8217;s a fun resource</a> you can start off with that shows you some animated GIFs of how different GC algorithms visually work.</p>
<p>Interestingly, while researching this topic, the vast majority of posts I came across talk about how GC works specifically to the main implementation of Java. GC certainly isn&#8217;t exclusive to Java, but I imagine the reason for this is because Java is often times heavily compared to C++ which isn&#8217;t garbage collected. Hopefully over time, more posts will become popular over how GC works in other languages &#8211; but for now, we&#8217;ll take what we can get!</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2017/01/programming-concepts-garbage-collection/feed/</wfw:commentRss>
		<slash:comments>2</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1419</post-id>	</item>
		<item>
		<title>What Meta Tags Your Site Should be Using</title>
		<link>https://thesocietea.org/2016/12/what-meta-tags-your-site-should-be-using/</link>
		<comments>https://thesocietea.org/2016/12/what-meta-tags-your-site-should-be-using/#comments</comments>
		<pubDate>Mon, 19 Dec 2016 12:00:45 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[Front End]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1519</guid>
		<description><![CDATA[Whenever you&#8217;re building a new site, you probably pay more attention to the HTML that&#8217;s in the &#60;body&#62; tag (i.e. the actual content) than what&#8217;s in the &#60;head&#62; tag &#8211; and that&#8217;s a good thing! If your page doesn&#8217;t have rich, valuable content &#8211; then it probably shouldn&#8217;t be there, but that doesn&#8217;t mean that...]]></description>
				<content:encoded><![CDATA[<p>Whenever you&#8217;re building a new site, you probably pay more attention to the HTML that&#8217;s in the &lt;body&gt; tag (i.e. the actual content) than what&#8217;s in the &lt;head&gt; tag &#8211; and that&#8217;s a good thing! If your page doesn&#8217;t have rich, valuable content &#8211; then it probably shouldn&#8217;t be there, but that doesn&#8217;t mean that you should put everything else on the backburner. There are tons of valuable tags you should be placing within the &lt;head&gt; tag that can really make your site more valuable, accessible, and help showcase it on social media platforms before people even click on links to your site. In this post, we&#8217;re going to go through which tags you should absolutely be placing in the &lt;head&gt; tag of your site if you want to get the maximum exposure and shareability possible. All of these are &lt;meta&gt; tags &#8211; with the exception of one &#8211; and the majority of them are related to how links to your site will render when shared on various social media platforms. I&#8217;m gonna group these into a few different categories:</p>
<ul>
<li>General</li>
<li>Open Graph (i.e. Facebook)</li>
<li>Twitter</li>
</ul>
<p>Ready? Let&#8217;s get to it!</p>
<h2>tl;dr</h2>
<p>Before we get into the explanations of all the meta tags, if you just want a quick example of what core meta tags I recommend every page should have (and the one&#8217;s we&#8217;ll be discussing), then here it is:</p><pre class="crayon-plain-tag">&lt;head&gt;
&lt;!-- General --&gt;
&lt;meta charset="utf-8"&gt;
&lt;title&gt;What Meta Tags Your Site Should be Using | Aaron Krauss&lt;/title&gt;
&lt;meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimal-ui"&gt;
&lt;meta name="description" content="Whenever you’re building a new site, you probably pay..."&gt;

&lt;!-- Open Graph --&gt;
&lt;meta property="og:title" content="What Meta Tags Your Site Should be Using | Aaron Krauss"&gt;
&lt;meta property="og:description" content="Whenever you’re building a new site, you probably pay..."&gt;
&lt;meta property="og:image" content="https://thesocietea.org/wp-content/uploads/2016/12/what-meta-tags.jpg"&gt;
&lt;meta property="og:url" content="https://thesocietea.org/2016/12/what-meta-tags-your-site-should-be-using/"&gt;
&lt;meta property="og:type" content="website"&gt;

&lt;!-- Twitter --&gt;
&lt;meta name="twitter:card" content="summary_large_image"&gt;
&lt;meta name="twitter:site" content="@thecodeboss"&gt;
&lt;meta name="twitter:creator" content="@thecodeboss"&gt;
&lt;/head&gt;</pre><p>These meta tags are taken directly from this webpage. Now that we have that out of the way, I hope you&#8217;ll continue reading to see what these tags actually do and why they&#8217;re important!</p>
<h2>General</h2>
<p>These are gonna be the tags that every site should have, regardless of how you plan to use it.</p>
<h3>Title</h3>
<p>This one&#8217;s pretty easy to understand and it&#8217;s absolutely the most important tag you should place within your &lt;head&gt; tag. It&#8217;s also the only tag we&#8217;ll be talking about that&#8217;s not explicitly a &lt;meta&gt; tag &#8211; this one gets a tag all to itself. You probably already knew this, but the &lt;title&gt; tag sets the title of the page. This will be the title that you see in your browser tab, your bookmark menu, Google results, and practically anywhere that your site is shared. It&#8217;s a must to set this.</p><pre class="crayon-plain-tag">&lt;!-- You'll see this exact tag on this very page! --&gt;
&lt;title&gt;What Meta Tags Your Site Should be Using | Aaron Krauss&lt;/title&gt;</pre><p></p>
<h3>Viewport</h3>
<p>Next to the title, the viewport meta tag is extremely important to have in your site because without it, your site won&#8217;t render properly on smaller screen sizes such as mobile phones and tablets. The viewport meta tag gives the browser instructions on how to control the page&#8217;s dimensions and scaling. On smaller devices by default, browsers will try to scale down the entire web page width to fit on your screen just like it would on a desktop monitor; you&#8217;ve probably seen this if you&#8217;ve viewed websites that haven&#8217;t been built recently, and you have to zoom in to actually read the content. With modern <a href="https://en.wikipedia.org/wiki/Responsive_web_design" target="_blank">responsive</a> websites, we don&#8217;t want that default behavior. We have the power to build websites that break down properly for smaller screen sizes, and in order to render these sites properly, we need the viewport tag.</p>
<p>Here&#8217;s an example of a basic viewport meta tag:</p><pre class="crayon-plain-tag">&lt;meta name="viewport" content="width=device-width, initial-scale=1"&gt;</pre><p>This tag sets the width of the page to the device-width (i.e. your viewport width), and the initial scale attribute sets the zoom level to 1, so that you&#8217;re not viewing a zoomed-in or zoomed-out version of the page.</p>
<h3><strong>Character Set</strong></h3>
<p>This meta tag sets the character set of your website. Browsers need to know which character set your site uses in order to render your content properly.  <a href="https://en.wikipedia.org/wiki/UTF-8" target="_blank">UTF-8</a> is the default character set for all HTML5 sites &#8211; but you still should be explicit about setting it because in HTML4, the default is <a href="https://en.wikipedia.org/wiki/ISO/IEC_8859-1" target="_blank">ISO-8859-1</a>. If you&#8217;re using HTML5 (which you should be), then this tag looks like this:</p><pre class="crayon-plain-tag">&lt;!-- In HTML5 --&gt;
&lt;meta charset="utf-8"&gt;</pre><p>But if you&#8217;re stuck using earlier versions of HTML, then you&#8217;d use the <strong>http-equiv</strong> property to set the character set:</p><pre class="crayon-plain-tag">&lt;!-- Defining the charset in HTML4 --&gt; 
&lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8"&gt;</pre><p></p>
<h3>Description</h3>
<p>The meta description tag sets a 255-character-max block of text that accurately describes the page you&#8217;re on. This tag has been the standard for services like Google, Facebook, Slack, and many others to pull in your page&#8217;s description for others to see, which makes it very important.</p><pre class="crayon-plain-tag">&lt;meta name="description" content="This is the description for a neat page"&gt;</pre><p>The limit that any service will pull from your meta description is typically 255 characters, so make sure you stay concise with it!</p>
<h2>Open Graph</h2>
<p>You probably read &#8220;Open Graph&#8221; above in the intro and may have thought, &#8220;what the heck is that?&#8221; <a href="http://ogp.me/" target="_blank">Open Graph</a> is a protocol that Facebook created that allows any web page links to become rich objects in a social graph. Whenever you paste a link in Facebook (along with many other services) and it automatically creates a clickable block with a title, description, and/or image from that site &#8211; it&#8217;s using these Open Graph meta tags to do that. Before I knew what was going on here, it always seemed like magic to me when this happened &#8211; but it&#8217;s all just from simple meta tags! The Open Graph protocol is abbreviated to <strong>og</strong> when used in HTML.</p>
<p>I&#8217;m gonna display a chunk of Open Graph meta tags here, and then we&#8217;ll talk about them.</p><pre class="crayon-plain-tag">&lt;meta property="og:title" content="The Rock" /&gt;
&lt;meta property="og:type" content="video.movie" /&gt;
&lt;meta property="og:url" content="http://www.imdb.com/title/tt0117500/" /&gt;
&lt;meta property="og:image" content="http://ia.media-imdb.com/images/rock.jpg" /&gt;
&lt;meta property="og:description" 
  content="Sean Connery and Nicolas Cage star as a chemist and an ex-con." /&gt;</pre><p>You&#8217;ll notice that some of these tags seem redundant compared to the other tags we&#8217;ve added so far &#8211; and truth be told, I agree. But the Facebook <a href="https://developers.facebook.com/tools/debug/" target="_blank">Open Graph debugger</a> throws warnings if you don&#8217;t have an og:title or og:description, so it&#8217;s best to include them for maximum accessibility.</p>
<h3>og:title</h3>
<p>This purpose of this meta tag is similar to the &lt;title&gt; tag that we discussed above, but strictly used when <em>sharing</em> a link to your web page. It wont be used for browser tabs, bookmarks, or Google search results like the actual &lt;title&gt; tag.</p>
<h3>og:type</h3>
<p>This describes what type of content you&#8217;re linking to. More often than not, this will be set to <strong>website</strong>, but as you see in the example, it doesn&#8217;t have to be. Check out the <a href="http://ogp.me/" target="_blank">Open Graph docs</a> for the various values that this meta tag can be set to.</p>
<h3>og:url</h3>
<p>This is the canonical URL that the Open Graph object will reference when shared, and it should 99% of the time be set to the URL of the page you&#8217;re linking. The only other value this should really be set to would be something like a home page, in case the current page (e.g. a 404 page, unauthorized page, etc.) really isn&#8217;t something you want shared.</p>
<h3>og:image</h3>
<figure id="attachment_1523" style="width: 286px" class="wp-caption alignright"><img class="wp-image-1523 size-medium" src="https://i0.wp.com/thesocietea.org/wp-content/uploads/2016/10/og-example-286x300.jpg?resize=286%2C300&#038;ssl=1" alt="Open Graph Object Example" srcset="https://i0.wp.com/thesocietea.org/wp-content/uploads/2016/10/og-example.jpg?resize=286%2C300&amp;ssl=1 286w, https://i0.wp.com/thesocietea.org/wp-content/uploads/2016/10/og-example.jpg?w=400&amp;ssl=1 400w" sizes="(max-width: 286px) 100vw, 286px" data-recalc-dims="1" /><figcaption class="wp-caption-text">Open Graph Object Example</figcaption></figure>
<p>This is probably the one that you&#8217;ve come across most often as a user, and the one that Open Graph really pioneered: an image meta tag. This tag links to an image file, and if it exists, it will display that image when shared on many social media platforms. While Open Graph was originally built by Facebook, several other services such as Slack, LinkedIn, Google+, etc. all use this to pull in an image when you share a web page.</p>
<p>Typically only JPEGs and PNGs are supported, but it&#8217;s really up to the platform you&#8217;re sharing it on. If they want to render gifs or svgs, then they can do that. When choosing an image size, there are a couple of recommendations.</p>
<p>1 &#8211; The image should be reasonably sized. Facebook and other services typically limit it to 8mB, but you really should never have an image that big on the web. My personal goal is to keep all images under 500kB.</p>
<p>2 &#8211; This is Facebook specifically, but they recommend an aspect ratio of 1.91 to 1, and further recommend images to be 600 x 315 or 1200 x 630 pixels. You can choose an image with any aspect ratio, but abiding by these guidelines will make sure that parts of your images don&#8217;t get cropped out.</p>
<h3>og:description</h3>
<p>Just like og:title is a doppelgänger to the title tag, og:description is similar to your meta description tag.</p>
<p>That covers the basic Open Graph meta tags, but as I mentioned earlier, there are more than just these if you want to get nitty-gritty with your site&#8217;s content. Let&#8217;s move on to our final category.</p>
<h2>Twitter</h2>
<p>Twitter has it&#8217;s own protocol suite for meta tags, and they involve rendering a &#8220;card&#8221; to your tweets which look just like Open Graph objects. In fact &#8211; Twitter will actually use Open Graph meta tags that you already have to help render your cards, which is nice so that you don&#8217;t have to duplicate any meta tag content. Here&#8217;s a base example of what meta tags you should use for Twitter:</p><pre class="crayon-plain-tag">&lt;meta name="twitter:card" content="summary" /&gt;
&lt;meta name="twitter:site" content="@nytimesbits" /&gt;
&lt;meta name="twitter:creator" content="@nickbilton" /&gt;</pre><p>There are more meta tags that Twitter supports such as image, title, description, etc., but the tags shown here are the important ones that are unique to Twitter. You can add those other meta tags &#8211; but as mentioned earlier, if they aren&#8217;t present, Twitter will go ahead and use the data provided by your Open Graph tags &#8211; which is what I prefer.</p>
<h3>twitter:card</h3>
<figure id="attachment_1528" style="width: 249px" class="wp-caption alignright"><img class="wp-image-1528 size-medium" src="https://i2.wp.com/thesocietea.org/wp-content/uploads/2016/10/twitter-card-example-249x300.jpg?resize=249%2C300&#038;ssl=1" alt="Twitter Summary Large Image Card Example" srcset="https://i1.wp.com/thesocietea.org/wp-content/uploads/2016/10/twitter-card-example.jpg?resize=249%2C300&amp;ssl=1 249w, https://i1.wp.com/thesocietea.org/wp-content/uploads/2016/10/twitter-card-example.jpg?w=400&amp;ssl=1 400w" sizes="(max-width: 249px) 100vw, 249px" data-recalc-dims="1" /><figcaption class="wp-caption-text">Summary Large Image Example</figcaption></figure>
<p>This is the most important twitter meta tag, and it&#8217;s required if you want to render a card at all. The various values can be one of “summary”, “summary_large_image”, “app”, or “player” &#8211; all of which you can read about <a href="https://dev.twitter.com/cards/types" target="_blank">here</a>. The default value should be &#8220;summary&#8221;, unless you want to showcase a featured image, in which case you would use &#8220;summary_large_image.&#8221;</p>
<h3>twitter:site</h3>
<p>This meta tag describes the twitter username for the website used in the card footer, and is required if you want to track attributions to this username through <a href="https://dev.twitter.com/cards/analytics" target="_blank">Twitter Card Analytics</a>.</p>
<h3>twitter:creator</h3>
<p>This meta tag describes the twitter username for the content creator/author.</p>
<p>That wraps it up for the must-have Twitter meta tags. As mentioned, there are plenty more, and if you&#8217;re interested you can read up on them <a href="https://dev.twitter.com/cards/markup" target="_blank">here</a>.</p>
<h2>Final Thoughts</h2>
<p>Did we cover every meta tag out there? Absolutely not &#8211; but we covered a lot of them that are pretty important. Some of the ones we missed out on include <a href="http://applinks.org/documentation/" target="_blank">a whole suite</a> of meta tags dedicated to deeplinking, where you can do things like tell an operating system (such as iOS, Android, or Windows Phone) to open up an app when you land on the webpage instead of rendering the webpage itself. You&#8217;ve probably seen this type of action happen when you click on a Twitter, Instagram, or Amazon link. We didn&#8217;t cover the author meta tag either, or different things you can do with the http-equiv attribute, or the <em>keywords</em> meta tag &#8211; and that last one&#8217;s for good reason; the keywords meta tag has become pretty unimportant, and if any SEO &#8220;gurus&#8221; try to tell you that it is important &#8211; then run. Run away, because that&#8217;s a bold-faced lie.</p>
<p>Now that you know the purpose of some of the various meta tags and how to use them, you can go update some of your projects to make them more shareable! I hope you enjoyed this post and learned a little bit more about how to power up the HTML in your web pages.</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2016/12/what-meta-tags-your-site-should-be-using/feed/</wfw:commentRss>
		<slash:comments>4</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1519</post-id>	</item>
		<item>
		<title>Core Functional Programming Concepts</title>
		<link>https://thesocietea.org/2016/12/core-functional-programming-concepts/</link>
		<comments>https://thesocietea.org/2016/12/core-functional-programming-concepts/#comments</comments>
		<pubDate>Thu, 01 Dec 2016 12:00:02 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[Programming Concepts]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1343</guid>
		<description><![CDATA[If you&#8217;re a developer like me, then you probably grew up learning about Object-Oriented Programming and how that whole paradigm works. You may have messed with Java or C++ &#8211; or been lucky enough to use neat languages like Ruby, Python, or C# as your first true language &#8211; so chances are that you&#8217;re at least...]]></description>
				<content:encoded><![CDATA[<p>If you&#8217;re a developer like me, then you probably grew up learning about Object-Oriented Programming and how that whole paradigm works. You may have messed with Java or C++ &#8211; or been lucky enough to use neat languages like Ruby, Python, or C# as your first true language &#8211; so chances are that you&#8217;re at least mildly comfortable with terms such as <em>classes</em>, <em>objects</em>, <em>instance variables</em>, <em>static methods</em>, etc. What you&#8217;re probably not as comfortable with are the core concepts behind this weird paradigm called functional programming &#8211; which is pretty drastically different from not only just object-oriented programming, but also procedural, prototypal, and a slough of other common paradigms out there.</p>
<p>Functional programming is becoming a pretty hot topic &#8211; and for very good reason. This paradigm is hardly new too; <a href="https://www.haskell.org/" target="_blank">Haskell</a> is potentially the most corely-functional language out there and has existed since 1990. Other languages such as Erlang, Scala, Clojure also fall into the functional category &#8211; and they all have a solid following. One of the major benefits of functional programming is the ability to write programs that run concurrently and that do it properly (check out my <a href="https://thesocietea.org/2015/10/programming-concepts-concurrency/">post on concurrency</a> if you need a refresher on what that means) &#8211; meaning that common concerns such as deadlock, starvation, and thread-safety really aren&#8217;t an issue. Concurrency in procedural-based languages is a nightmare because state can change at any given moment. Objects have state that can change, practically any function can change any variable as long as they&#8217;re in lexical scope (or dynamic scope, for the few languages that use it) &#8211; it&#8217;s very powerful, but very bad at keeping tabs on state.</p>
<p>Functional programming touts many benefits &#8211; but the ability to take advantage of all of a CPU&#8217;s cores via concurrent behavior is what makes it really shine compared to the other popular programming languages today &#8211; so I want to go over some of the core concepts that power this language paradigm.</p>
<hr />
<p><strong>Foreword</strong><strong>:</strong> All of these concepts are language-agnostic (in fact, many functional languages don&#8217;t even fully abide by them), but if you had to associate them with any one language, it would most likely fit best with Haskell, since Haskell most strictly abides by core functional concepts. The following 5 concepts are strictly theory-driven and help define the functional paradigm in the purest sense.</p>
<h2>1. Functions are Pure</h2>
<p>This is easily the foremost rule of functional programming. All functions are <em>pure</em> in the sense that they abide by two restrictions:</p>
<ol>
<li>A function called multiple times with the same arguments will always return the same value. Always.</li>
<li>No <a href="https://en.wikipedia.org/wiki/Side_effect_(computer_science)" target="_blank">side effects</a> occur throughout the function&#8217;s execution.</li>
</ol>
<p>The first rule is relatively simple to understand &#8211; if I call the function <strong>sum(2, 3)</strong> &#8211; then it should always return the same value every time. Areas where this breaks down in more procedural-coding is when you rely on state that the function doesn&#8217;t control, such as global variables or any sort of randomized activity. As soon as you throw in a <strong>rand()</strong> function call, or access a variable not defined in the function &#8211; then the function loses its purity, and that can&#8217;t happen in functional programming.</p>
<p>The second rule &#8211; no side effects &#8211; is a little bit more broad in nature. A side effect is basically a state change in something other than the function that&#8217;s currently executing. Modifying a variable defined outside the function, printing out to the console, raising an exception, and reading data from a file are all examples of side effects which prevent a function from being pure. At first, this might seem like a big constraint for functional programming &#8211; but think about it. If you know for sure that a function won&#8217;t modify any sort of state outside the function itself, then you have full confidence that you can call this function in any scenario. This opens so many doors for concurrent programming and multi-threaded applications.</p>
<h2>2. Functions are First-Class and can be Higher-Order</h2>
<p>This concept isn&#8217;t exclusive to functional programming (it&#8217;s used pretty heavily in Javascript, PHP, and among other languages too) &#8211; but it is a requirement of being functional. In fact &#8211; there&#8217;s a whole Wikipedia article over the concept of <a href="https://en.wikipedia.org/wiki/First-class_function" target="_blank">first-class functions</a>. For a function to be first-class, you just have to be able to set it to a variable. That&#8217;s it. This allows you to handle the function as if it were a normal data type (such as an integer or string), and still be able to execute the function at some other point in runtime.</p>
<p>Higher-order functions build off of this concept of &#8220;functions as first-class citizens&#8221; and are defined as functions that either accept another function as an argument, or that return a function themselves. Common examples of higher-order functions are <a href="https://en.wikipedia.org/wiki/Map_(higher-order_function)" target="_blank">map</a> functions which typically iterate over a list, modify the data based on a passed-in function, and return a new list, and <a href="https://en.wikipedia.org/wiki/Filter_(higher-order_function)" target="_blank">filter</a> functions, which accept a function specifying how elements of a list should be selected, and return a new list with the selections.</p>
<h2>3. Variables are Immutable</h2>
<p>This one&#8217;s pretty simple. In functional programming, you can&#8217;t modify a variable after it&#8217;s been initialized. You just can&#8217;t. You can create new variables just fine &#8211; but you can&#8217;t modify existing variables, and this really helps to maintain state throughout the runtime of a program. Once you create a variable and set its value, you can have full confidence knowing that the value of that variable will never change.</p>
<h2>4. Functions have Referential Transparency</h2>
<p>Referential transparency is a tricky definition to pinpoint, and if you ask 5 different developers, then you&#8217;re bound to get 5 different responses. The most accurate definition for referential transparency that I have come across (and that I agree with) is that if you can replace the value of a function call with its return value everywhere that it&#8217;s called <em>and</em> the state of the program stays the same, then the function is referentially transparent. This might seem obvious &#8211; but let me give you an example.</p>
<p>Let&#8217;s say we have a function in Java that just adds 3 and 5 together:</p><pre class="crayon-plain-tag">public int addNumbers(){
  return 3 + 5;
}

addNumbers() // 8
8            // 8</pre><p>It&#8217;s pretty obvious that anywhere I call the <strong>addNumbers()</strong> function, I can easily replace that whole function call with the return value of 8 &#8211; so this function is referentially transparent. Here&#8217;s an example of one that&#8217;s not:</p><pre class="crayon-plain-tag">public void printText(){
  System.out.println("Hello World");
}

printText()   // Returns nothing, but prints "Hello World"</pre><p>This is a void function, so it doesn&#8217;t return anything when called &#8211; so for the function to be referentially transparent, we should be able to replace the function call with nothing as well &#8211; but that obviously doesn&#8217;t work. The function changes the state of the console by printing out to it &#8211; so it&#8217;s not referentially transparent.</p>
<p>This is a tricky topic to get, but once you do, it&#8217;s a pretty powerful way to understand how functions really work.</p>
<h2>5. Functional Programming is Based on Lambda Calculus</h2>
<p>Functional programming is heavily rooted in a mathematical system called <a href="https://en.wikipedia.org/wiki/Lambda_calculus" target="_blank">lambda calculus</a>. I&#8217;m not a mathematician, and I certainly don&#8217;t pretend to be, so I won&#8217;t go into the nitty-gritty details about this field of math &#8211; but I do want to review the two core concepts of lambda calculus that really shaped the structure of how functional programming works:</p>
<ol>
<li>In lambda calculus, all functions can be written anonymously without a name &#8211; because the only portion of a function header that affects its execution is the list of arguments. In case you ever wondered, this is where <em>lambda</em> (or anonymous) functions get their name in modern-day programming &#8211; because of lambda calculus. <em>*Brain explosion*</em>.</li>
<li>When invoked, all functions will go through a process called <a href="https://en.wikipedia.org/wiki/Currying" target="_blank">currying</a>. What this means is that when a function with multiple arguments is called, it will execute the function once but it will only set one variable in the parameter list. At the end, a new function is returned with 1 less argument &#8211; the one that was just applied &#8211; and this new function is immediately invoked. This happens recursively until the function has been fully applied, and then a final result is returned. Because functions are pure in functional programming &#8211; this works. Otherwise, if state changes were a concern, currying could produce unsafe results.</li>
</ol>
<p>As I mentioned earlier, there&#8217;s much more to lambda calculus than just this &#8211; but I wanted to review where some of the core concepts in functional programming came from. At the very least, you can bring up the phrase <em>lambda calculus</em> when talking about functional programming, and everyone else will think you&#8217;re really smart.</p>
<h2>Final Thoughts</h2>
<p>Functional programming involves a significantly different train of thought than what you&#8217;re probably used to &#8211; but it&#8217;s really powerful, and I personally think this topic is going to come up again and again with CPUs these days offering more cores to handle processes instead of just using one or two beefed up cores per unit. While I mentioned Haskell as being one of the more pure functional languages out there &#8211; there are a handful of other popular languages too that are classified as functional: <a href="https://www.erlang.org/" target="_blank">Erlang</a>, <a href="https://clojure.org/" target="_blank">Clojure</a>, <a href="http://www.scala-lang.org/" target="_blank">Scala</a>, and <a href="http://elixir-lang.org/" target="_blank">Elixir</a> are just a few of them, and I highly encourage you to check one (or more) of them out. Thanks for sticking with me this long, and I hope you learned something!</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2016/12/core-functional-programming-concepts/feed/</wfw:commentRss>
		<slash:comments>5</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1343</post-id>	</item>
		<item>
		<title>How Daemons, the Init Process, and Process Forking Work</title>
		<link>https://thesocietea.org/2016/11/how-daemons-the-init-process-and-process-forking-work/</link>
		<comments>https://thesocietea.org/2016/11/how-daemons-the-init-process-and-process-forking-work/#comments</comments>
		<pubDate>Thu, 03 Nov 2016 12:00:04 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[How Things Work]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1165</guid>
		<description><![CDATA[If you&#8217;ve ever worked with Unix-based systems, then you&#8217;re bound to have heard the term daemon (pronounced dee-mon) before. My goal here is to explain exactly what they are and how they work, especially since the name makes them seem more convoluted than they actually are. At its surface, a daemon is nothing difficult to understand &#8211;...]]></description>
				<content:encoded><![CDATA[<p>If you&#8217;ve ever worked with Unix-based systems, then you&#8217;re bound to have heard the term <em>daemon</em> (pronounced dee-mon) before. My goal here is to explain exactly what they are and how they work, especially since the name makes them seem more convoluted than they actually are.</p>
<p>At its surface, a <a href="https://en.wikipedia.org/wiki/Daemon_(computing)" target="_blank">daemon</a> is nothing difficult to understand &#8211; it&#8217;s just a background process that&#8217;s not attached to the terminal in which it was spawned. But how do they get created, how are they related to other processes, and how do they actually work? That&#8217;s what we&#8217;re gonna get into today, but before we start really talking about daemons, we need to learn about how the init process and process forking both work.</p>
<h2>How the Init Process Works</h2>
<p>To start off, we need to talk about the <a href="https://en.wikipedia.org/wiki/Init" target="_blank">init process</a> &#8211; also known as the <em>PID 1</em> (because it always has the process ID of 1). The init process is the very first process that is created when you start up a Unix-based machine, which means that all other processes can somehow trace ancestry back to this process.</p>
<p>The init process is normally started when the Kernel calls a certain filename &#8211; often found in <strong>/etc/rc</strong> or <strong>/etc/inittab </strong>&#8211; but this location can change based on OS. Normally this process sets the path, checks the file system, initializes serial ports, sets the clock, and more. Finally, the last thing the init process handles is starting up all the other background processes necessary for your operating system to run properly &#8211; and it runs them as daemons. Typically, all of these daemon scripts exist in <strong>/etc/init.d</strong>/; it&#8217;s conventional to end all of the daemon executables with the letter <em>d</em> (such as httpd, sshd, mysqld, etc.) &#8211; so you might think that this directory is named as such because of that, but it&#8217;s actually just a common unix convention to name directories that have multiple configuration files with a <strong>.d</strong> suffix. Great, so the init script starts the daemons, but we still haven&#8217;t answered how it does that. The init process starts the daemons by <em>forking</em> its own process to create new processes, which leads us to talking about how process forking works.</p>
<h2>How Process Forking Works</h2>
<p>Traditionally in Unix, the only way to create a process is to create a copy of the existing process and to go from there. This practice &#8211; known as <a href="https://en.wikipedia.org/wiki/Fork_(system_call)" target="_blank">process forking</a> &#8211; involves duplicating the existing process to create a child process and making an <a href="https://en.wikipedia.org/wiki/Exec_(computing)" target="_blank">exec</a> system call to start another program. We get the phrase &#8220;process forking&#8221; because <a href="http://linux.die.net/man/2/fork" target="_blank">fork</a> is an actual C method in the Unix standard library which handles creating new processes in this manner. The process that calls the fork command will be considered the parent process of the newly created child process. The child process is nearly identical to the parent process, with a few differences such as different process IDs and parent process IDs, no shared memory locks, no shared async I/O, and more.</p>
<p>In today&#8217;s Unix and Linux distributions, there are other manners in which you can create a process instead of using fork (such as <a href="http://pubs.opengroup.org/onlinepubs/009696899/functions/posix_spawn.html" target="_blank">posix_spawn</a>), but this is still how the vast majority of processes are created.</p>
<p>Now that you know a little bit about the traditional use of the term &#8220;fork&#8221; in computer science, it probably makes more sense why on GitHub you clone somebody else&#8217;s repo by <em>forking</em> it. But I digress &#8211; back to daemons!</p>
<h2>Finally, How Daemons Work</h2>
<figure id="attachment_1192" style="width: 247px" class="wp-caption alignright"><img class="size-full wp-image-1192" src="https://i1.wp.com/thesocietea.org/wp-content/uploads/2016/02/maxwells-demon.png?resize=247%2C88&#038;ssl=1" alt="Schematic over Maxwell's Demon" data-recalc-dims="1" /><figcaption class="wp-caption-text">Schematic over Maxwell&#8217;s Demon</figcaption></figure>
<p>Before we get into how daemons work, I want to mention where the name comes from. The term <em>daemon</em> was created from <a href="https://en.wikipedia.org/wiki/Project_MAC" target="_blank">MIT&#8217;s Project MAC</a>, who in turn got the name from <a href="https://en.wikipedia.org/wiki/Maxwell%27s_demon" target="_blank">Maxwell&#8217;s Demon</a> &#8211; an imaginary being from a thought experiment that constantly works in the background, sorting molecules (see image). The exact spelling of <em>daemon</em> comes from the Greek <a href="https://en.wikipedia.org/wiki/Daemon_(classical_mythology)" target="_blank">daemon</a>, which is a supernatural being that operates in the background of everyday life and is neither good nor evil in nature (instead of always evil, as we normally view demons). So as weird as it may sound, the term <em>daemon</em> (referring to a Unix background process) is actually based on the concept of a supernatural demon as we think of it today.</p>
<p>Daemons are background process that run separately from the controlling terminal and just about always have the init process as a parent process ID (though they&#8217;re not required to); they typically handle things such as network requests, hardware activity, and other <em>wait &amp; watch</em> type tasks. They differ from simple background processes that are spawned in the terminal because these background process are typically bound to that terminal session, and when that terminal session ends it will send the SIGHUP message to all background processes &#8211; which normally terminates them. Because daemons are normally children of the init process, it&#8217;s more difficult to terminate them.</p>
<p>Daemons are spawned one of two ways: either the init process forks and creates them directly &#8211; like we mentioned above in the <em>init process</em> segment &#8211; or some other process will fork itself to create a child process, and then the parent process immediately exits. The first condition seems pretty straightforward &#8211; the init process forks to create a daemon &#8211; but how does that second condition work, and how does the init process end up becoming the parent of these daemons?</p>
<p>When you fork a process to create a child process, and then immediately kill that parent process, the child process becomes an <a href="https://en.wikipedia.org/wiki/Orphan_process" target="_blank">orphaned process</a> &#8211; a running process with no parent (not to be confused with a <a href="https://en.wikipedia.org/wiki/Zombie_process" target="_blank">zombie process</a>, such as a child process that has been terminated but is waiting on the parent process to read its exit status). By default, if a child process gets orphaned, the init process will automatically adopt the process and become its parent. This is a key concept to understand, because this is normally how daemons that you start after boot up relate to the init process. And that&#8217;s about all that makes daemons unique from normal background processes &#8211; see, not too bad!</p>
<h2>Final Thoughts</h2>
<p>All in all, daemons are a pretty simple concept to understand &#8211; but in order to fully grok them, we needed to go into what the init process is and how process forking works. Now go impress your friends, and tell them to start pronouncing it correctly too! <em>D</em><em>ee-mon</em> instead of <em>day-mon</em>.</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2016/11/how-daemons-the-init-process-and-process-forking-work/feed/</wfw:commentRss>
		<slash:comments>4</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1165</post-id>	</item>
		<item>
		<title>Optimizing Your Web Page for Speed</title>
		<link>https://thesocietea.org/2016/10/optimizing-your-web-page-for-speed/</link>
		<comments>https://thesocietea.org/2016/10/optimizing-your-web-page-for-speed/#respond</comments>
		<pubDate>Thu, 06 Oct 2016 12:00:47 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[Front End]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1304</guid>
		<description><![CDATA[We&#8217;ve all had it happen &#8211; that web page that you navigate to, and you can&#8217;t hardly interact with the page for a full 10 seconds because images are still loading, or you can&#8217;t scroll down because Javascript is still executing, etc. These are what we call unoptimized web sites, and they&#8217;re a scourge among the internet. The...]]></description>
				<content:encoded><![CDATA[<p>We&#8217;ve all had it happen &#8211; that web page that you navigate to, and you can&#8217;t hardly interact with the page for a full 10 seconds because images are still loading, or you can&#8217;t scroll down because Javascript is still executing, etc. These are what we call <em>unoptimized</em> web sites, and they&#8217;re a scourge among the internet. The good news is that it&#8217;s relatively simple to optimize your web page and allow it to load practically instantaneously &#8211; or at the very least, not hamper the interaction for your users while you&#8217;re waiting for larger files to fully download. Keep following along &#8211; I&#8217;m about to show you how to do it.</p>
<hr />
<p><strong>Note:</strong> This post covers shrinking your web page&#8217;s overall payload so that it loads quicker, and nothing related to Search Engine Optimization. If you&#8217;re looking for <a href="https://en.wikipedia.org/wiki/Search_engine_optimization" target="_blank">SEO</a> &#8211; the internet has a plethora of other posts about this topic.</p>
<h2>Optimizing Images</h2>
<p>Shrinking the payload of your images is the biggest way that you can help to optimize your web site. Let&#8217;s say that you snap a photo with your mobile phone and you want to put it online. That image from your phone easily sits at about 4MB initially &#8211; and there&#8217;s no way you can put that on your website (especially if it just needs to be a thumbnail!). You might be thinking &#8220;but that&#8217;s what I do with Facebook and Instagram!&#8221; &#8211; but they have image optimization built into their services that fires when you upload the image, because they don&#8217;t want to house those large images either.</p>
<figure id="attachment_1172" style="width: 351px" class="wp-caption alignright"><img class="wp-image-1172" src="https://i1.wp.com/thesocietea.org/wp-content/uploads/2016/02/th-tulsaf35-1.jpg?resize=351%2C228&#038;ssl=1" alt="th-tulsaf35-1" srcset="https://i1.wp.com/thesocietea.org/wp-content/uploads/2016/02/th-tulsaf35-1.jpg?w=400&amp;ssl=1 400w, https://i1.wp.com/thesocietea.org/wp-content/uploads/2016/02/th-tulsaf35-1.jpg?resize=300%2C195&amp;ssl=1 300w" sizes="(max-width: 351px) 100vw, 351px" data-recalc-dims="1" /><figcaption class="wp-caption-text">This image was a 2 MB screenshot at first &#8211; now it&#8217;s just 20 KB!</figcaption></figure>
<p>Another thing you might be thinking is that you don&#8217;t want to degrade the quality of your images by shrinking their size &#8211; and truth be told, that&#8217;s just not a real concern. It&#8217;s true that when you shrink your image sizes, you <em>will</em> lower the quality of your images, but if you&#8217;re uploading a 3000 x 4000 pixel image to your website and your site naturally shrinks it down to 300 x 400 pixels anyway &#8211; then you&#8217;re losing quality already without saving yourself any of that payload size.</p>
<p>To optimize your images, there are 3 things you can do:</p>
<ul>
<li>Crop your image to a size that you actually plan to show it at on your site</li>
<li>Re-save the image at about 60 &#8211; 70% quality (you won&#8217;t notice the difference) using a tool like Photoshop or Gimp</li>
<li>Use a non-lossy image optimization tool such as <a href="https://imageoptim.com/" target="_blank">ImageOptim</a></li>
</ul>
<p>By following these 3 procedures, you can easily bring a <strong>4MB</strong> image down to under <strong>150KB</strong> &#8211; or even far less if the image is smaller on your site!</p>
<h2>Minimize &amp; Concatenate your CSS &amp; JS</h2>
<p>If you&#8217;re unfamiliar with these concepts, <em>minimizing</em> means running your CSS and JS through a tool which goes through your code and moves it all to just one line, removes extra white space, shortens variable names, and a slew of other optimization techniques to shrink your file size. Minimizing your files can easily cut their payload in half &#8211; and it doesn&#8217;t affect how your users interact with your site at all.</p>
<p>You only want to minimize your production files &#8211; because developing minimized files is near impossible. To help with this, I encourage you to look into a build automation tool such as <a href="http://gulpjs.com/" target="_blank">Gulp</a> or <a href="http://gruntjs.com/" target="_blank">Grunt</a> to make your life easier. For JS, you can use <a href="https://www.npmjs.com/package/gulp-uglify" target="_blank">gulp-uglify</a>, and for CSS there&#8217;s <a href="https://www.npmjs.com/package/gulp-minify-css" target="_blank">gulp-minify-css</a> (similar libraries available for Grunt and other build automation systems). Going further for CSS, there&#8217;s also <a href="https://www.npmjs.com/package/gulp-uncss" target="_blank">gulp-uncss</a> which will strip out any CSS you have from your production files that&#8217;s not actually used in your web site. It doesn&#8217;t get much better than that!</p>
<p>On top of minification, you should concatenate your CSS and JS files so that your users&#8217; browsers only need to download the minimum number of files for your site. Using Sass makes CSS concatenation nice and simple because you can include all your other Sass files into one main file via the <a href="http://sass-lang.com/guide#topic-5" target="_blank">@import</a> command, but native JS concatenation is a little more difficult. The new ES6 spec supports Javascript modules so that you can include all of your JS files into a main file, just like we talked about with Sass, but <a href="http://www.ecma-international.org/ecma-262/6.0/" target="_blank">ES6</a> doesn&#8217;t have near enough browser support yet. You can make this better with <a href="https://babeljs.io/" target="_blank">Babel</a>, or if you want to stick with pure ES5, you can use <a href="http://browserify.org/" target="_blank">Browserify</a> which allows you to write CommonJS-style modules.</p>
<p>Still &#8211; none of this accounts for external libraries you include such as jQuery or Lodash, which are normally just loaded into the global scope of a web page. To get the most code-supportive practice of concatenating JS files (and CSS files, if you&#8217;re not using Sass), you should use a build automation plugin such as <a href="https://github.com/contra/gulp-concat" target="_blank">gulp-concat</a> where you specify exactly which files you want to concatenate, and it just appends the code one after another into a new file.</p>
<p>Easy peasy.</p>
<h2>Limit Web Fonts</h2>
<p>Just like images, CSS, and JS, fonts are also a resource that count towards your page&#8217;s overall size &#8211; and if you overload your site on fonts, then you might have a problem. Services like <a href="https://www.google.com/fonts" target="_blank">Google Fonts</a> and <a href="https://typekit.com/" target="_blank">Adobe Typekit</a> have become pretty traditional ways of adding fonts to your website &#8211; and each of them allows you to select certain versions of fonts to use, such as bold, italic, semibold, bolditalic, light, etc. Each version of a font has to be downloaded by the browser, and the vast majority of times you don&#8217;t need every version of a font. I strongly, <em>strongly</em> encourage you to select exactly which font forms you need instead of selecting them all. Being choosey with your fonts could mean the difference between adding 50KB and 500KB of extra weight to your page from fonts.</p>
<h2>Use Caching</h2>
<p>Last but not least, make sure you establish a cache policy for your website. This can be handled a number of different ways depending on whether you use nginx or apache, and if you&#8217;re serving up a dynamic site, then there&#8217;s a good chance your CMS or language framework supports forms of both client-side and server-side caching (such as <a href="https://wordpress.org/plugins/wp-super-cache/" target="_blank">WP Super Cache</a> for WordPress).</p>
<p>This topic can get pretty extensive, and if you want to dig deeper into how caching actually works and how to start establishing a stable cache policy, I encourage you to check out my post over <a href="https://thesocietea.org/2016/05/how-browser-caching-works/">How Browser Caching Works</a>.</p>
<h2>Final Thoughts</h2>
<p>Building an optimized web page these days is incredibly important &#8211; especially with mobile phone browsing becoming much more prevalent; after all, you can imagine how annoying it must be for your users to sit and watch while your web page loads &#8211; especially if you know you can make it better. There are some users (especially in non-first-world countries) which have a very low monthly data cap too, and if your web site alone takes up 10% of that whole data cap &#8211; then that&#8217;s just a big no-no.</p>
<p>If it&#8217;s your first time really thinking about page optimization, then don&#8217;t rush things. Go through this post slowly and build a development process for yourself that you can use for all future projects you work on. After you build one or two sites following these practices, it becomes second nature to optimize everything on your site as you build it &#8211; and you may even find ways to optimize your site that we didn&#8217;t discuss here (such as uploading videos on YouTube and embedding them on your site, instead of playing them directly through your website).</p>
<p>Thanks for reading, and I hope this post helped to open the doors for you on how you can start optimizing your web pages!</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2016/10/optimizing-your-web-page-for-speed/feed/</wfw:commentRss>
		<slash:comments>0</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1304</post-id>	</item>
		<item>
		<title>ARIA Roles and Attributes: How to Actually Use Them</title>
		<link>https://thesocietea.org/2016/09/aria-roles-and-attributes-how-to-actually-use-them/</link>
		<comments>https://thesocietea.org/2016/09/aria-roles-and-attributes-how-to-actually-use-them/#comments</comments>
		<pubDate>Thu, 08 Sep 2016 12:00:12 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[Front End]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1218</guid>
		<description><![CDATA[If you&#8217;re a web developer, then there&#8217;s a chance that you&#8217;ve heard of ARIA roles and attributes before. WAI-ARIA &#8211; a protocol suite for building Accessible Rich Internet Applications (hence the name) &#8211; lays down some rules to help developers build websites that are accessible for all users. A lot of the times when we think of accessibility,...]]></description>
				<content:encoded><![CDATA[<p>If you&#8217;re a web developer, then there&#8217;s a chance that you&#8217;ve heard of ARIA roles and attributes before. <a href="https://www.w3.org/WAI/intro/aria" target="_blank">WAI-ARIA</a> &#8211; a protocol suite for building <span style="text-decoration: underline;"><strong>A</strong></span>ccessible <span style="text-decoration: underline;"><strong>R</strong></span>ich <span style="text-decoration: underline;"><strong>I</strong></span>nternet <span style="text-decoration: underline;"><strong>A</strong></span>pplications (hence the name) &#8211; lays down some rules to help developers build websites that are accessible for all users. A lot of the times when we think of accessibility, we only think of blind users &#8211; but there are a lot of other types of disabilities that people may have such as color blindness, motor impairment, lack of limbs, auditory issues, cognitive issues, &#8220;crisis&#8221; moments, etc. Using some of the core ARIA concepts can not only help you build websites that enhance the experience for users with disabilities, but it will also help you architect your HTML better and make it more semantic &#8211; and doing things like that will help you to become a better developer.</p>
<p>ARIA by no means makes up the entirety of accessibility concerns for web development, and if you&#8217;d like to learn how else you can build your website for accessibility, I suggest you hop on over to my post about <a href="https://thesocietea.org/2014/07/developing-for-accessibility/">Developing for Accessibility</a>. In this post, we&#8217;ll specifically be sticking with ARIA roles and attributes, and how you can <em>actually</em> use them.</p>
<p>What I mean by &#8220;actually use them&#8221; is that I&#8217;m going to show you how to take your first simple steps implementing ARIA concepts into your HTML. If you google around for ARIA, you&#8217;ll likely find two kinds of resources:</p>
<ol>
<li>On one end of the spectrum, you&#8217;ll find the overwhelming <a href="https://www.w3.org/TR/wai-aria/" target="_blank">documentation</a> over <em>every single</em> ARIA role and attribute (and there&#8217;s a ton) to the point where your eyes glaze over just scrolling down the page</li>
<li>Or, you&#8217;ll find some small posts and/or videos about accessibility that basically say &#8220;I&#8217;m not going to go over ARIA too much, but here are some of the roles you can put in your HTML to help with accessibility.&#8221;</li>
</ol>
<p>Both of these options suck &#8211; because they&#8217;re not effective at teaching you. I want to provide a middle ground between these two categories. I&#8217;m going to show you how exactly you can use ARIA roles and attributes in your HTML today with real examples &#8211; but I&#8217;m not going to throw a book of documentation at you. We won&#8217;t go over everything &#8211; in fact, we&#8217;ll probably scrape less than 30% of the full WAI-ARIA spec &#8211; but we&#8217;re gonna cover an important amount that will make sense enough for you to actually use and remember it.</p>
<p>Ready? Let&#8217;s get to it.</p>
<h2>How ARIA Roles and Attributes Work</h2>
<p>Before we get to some examples, I want to explain what ARIA roles and attributes are and how they work. ARIA helps to define attributes that you apply to HTML elements just like an <strong>href</strong> or <strong>class</strong> attribute. As a user with little or no disabilities browsing the web, you won&#8217;t ever notice ARIA roles or attributes because they don&#8217;t affect the visual design of a site &#8211; they&#8217;re strictly used by screen readers and other assistive technologies.</p>
<p>Browsers build accessibility trees for each website that you visit so assistive technologies can navigate them easier. ARIA roles and attributes help to fill in the gaps of information about what certain elements or groups of elements are for, and how an element is supposed to be used.</p>
<p>Here&#8217;s an example of an unordered list aided with ARIA roles and attributes:</p><pre class="crayon-plain-tag">&lt;ul role="menu" aria-expanded="false"&gt;
    &lt;li role="menuitem"&gt;&lt;/li&gt;
    &lt;li role="menuitem"&gt;&lt;/li&gt;
    &lt;li role="menuitem"&gt;&lt;/li&gt;
&lt;/ul&gt;</pre><p>Just by looking at it, this type of semantic HTML probably makes sense to you. Without the help of ARIA, this would just look like a list of items &#8211; but now you can tell that this is supposed to be a menu <em>and</em> with the aria-expanded state set to false, you know that this menu isn&#8217;t showing the individual menu items yet.</p>
<h2>Rules of ARIA Use</h2>
<p>There are a few core rules to keep in mind when using ARIA:</p>
<ol>
<li>If you can semantically build your website using native elements (like &lt;nav&gt;, &lt;header&gt;, &lt;aside&gt;, &lt;button&gt;, etc.), then you should always do that instead of relying on ARIA roles or attributes. Use ARIA roles or attributes when the HTML isn&#8217;t obviously stating the purpose of an element or group of elements.</li>
<li>Don&#8217;t take away or change the native semantic meaning of an element with ARIA roles or attributes.</li>
<li>All interactive controls such as a button, sliding control, or drag-and-drop widget must be usable by the keyboard.</li>
<li>There are 2 ways to hide information from the accessibility tree, which should be used very sparingly for situations where content is unimportant or meant to be hidden. You can do this either with <a href="https://www.w3.org/TR/wai-aria/roles#presentation" target="_blank">role=&#8221;presentation&#8221;</a> or <a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-hidden" target="_blank">aria-hidden=&#8221;true&#8221;</a>. You should never use these on an element that is visible and can be focused with the keyboard, such as an input field or a link. Defining a presentation role is more strict than an aria-hidden=&#8221;true&#8221; state &#8211; and we&#8217;ll see an example of this down below.</li>
<li>Lastly, all interactive elements such as form fields should have a name associated with them. Something like a &lt;label&gt; is perfect, and with ARIA, you can even specify that a certain element is <em>labelled by</em> or <em>described by</em> another element.</li>
</ol>
<p>Great &#8211; we&#8217;ve now gotten all of the introductory ARIA stuff out of the way &#8211; let&#8217;s get to some examples of how you can use ARIA roles and attributes in your HTML today.</p>
<h2>Using ARIA Roles and Attributes</h2>
<p>ARIA breaks down into 3 categories: roles, properties, and states. Roles define the purpose of an element, properties help better describe what an element can do, and states are like properties that are <em>designed to change</em> &#8211; normally with the help of Javascript. An element can only have one ARIA role at a time, but can have as many properties and states as necessary.</p>
<p>Let&#8217;s start off simple.</p>
<h3>Define your main header, content, and footer</h3>
<p>Each page normally has an identifiable header, main content, and footer &#8211; and there are specific ARIA roles designed to help express these elements.</p><pre class="crayon-plain-tag">&lt;header role="banner"&gt;
&lt;/header&gt;

&lt;main role="main"&gt;
&lt;/main&gt;

&lt;footer role="contentinfo"&gt;
&lt;/footer&gt;</pre><p>The <a href="https://www.w3.org/TR/wai-aria/roles#banner" target="_blank">banner</a>, <a href="https://www.w3.org/TR/wai-aria/roles#main" target="_blank">main</a>, and <a href="https://www.w3.org/TR/wai-aria/roles#contentinfo" target="_blank">contentinfo</a> roles are meant to be used only one time per page, and they help screen readers figure out how a page is laid out on a high-level.</p>
<p>See, using ARIA roles is easy! Let&#8217;s get a little deeper.</p>
<h3>Label and Describe Elements</h3>
<p>If an element seems rather vague, but could either be given a title or described by another element, then you can define that relationship using ARIA. There are 3 different ARIA properties that can help with this:</p>
<ul>
<li><a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-label" target="_blank">aria-label</a></li>
<li><a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-labelledby" target="_blank">aria-labelledby</a></li>
<li><a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-describedby" target="_blank">aria-describedby</a></li>
</ul>
<p><strong>Aria-label</strong> is a property that defines a short title for an element; <strong>aria-labelledby</strong> references the ID of another element, which is a short title for the element; and <strong>aria-describedby</strong> is just like aria-labelledby &#8211; but is meant for longer descriptions instead of short titles. Here&#8217;s an example of this using a buttons&#8217; tooltip:</p><pre class="crayon-plain-tag">&lt;button aria-describedby="revertTooltip"&gt;Revert&lt;/button&gt;
&lt;div role="tooltip" id="revertTooltip"&gt;Reverting will undo any changes that
have been made since the last save.&lt;/div&gt;</pre><p>For shorter labels of important elements, such as a lightbox that contains a larger version of the image you clicked on, you can use the aria-label property:</p><pre class="crayon-plain-tag">&lt;div class="lightbox" aria-label="Image Lightbox"&gt;
  &lt;img src="foo.jpg" alt="Foo" /&gt;
&lt;/div&gt;</pre><p>Now it&#8217;s important to remember that we don&#8217;t need to label <em>everything</em>, especially if there&#8217;s already a predefined way of labelling an element such as a &lt;figcaption&gt;, <strong>title</strong> attribute, or an image&#8217;s <strong>alt</strong> attribute. We only need to label something if the HTML doesn&#8217;t clearly indicate the purpose of an important element.</p>
<h3>Navigation</h3>
<p>This topic&#8217;s going to be a bit extensive, but that&#8217;s because navigation is one of the areas of a site that you really want to get right since people need it to, well, navigate around. Normally this involves &lt;nav&gt;, &lt;ul&gt;, &lt;li&gt;, and &lt;a&gt; elements. Let me give you an example of a solid nav bar set up with ARIA roles and attributes, and then we&#8217;ll talk about it:</p><pre class="crayon-plain-tag">&lt;nav role="navigation"&gt;
  &lt;ul role="menubar"&gt;
    &lt;li role="menuitem"&gt;&lt;a href="#"&gt;Link 1&lt;/a&gt;&lt;/li&gt;
    &lt;li role="menuitem"&gt;&lt;a href="#"&gt;Link 2&lt;/a&gt;&lt;/li&gt;
    &lt;li role="menuitem" aria-haspopup="true"&gt;
      &lt;a href="#"&gt;Link 3&lt;/a&gt;
      &lt;ul role="menu" aria-hidden="true"&gt;
        &lt;li role="menuitem"&gt;&lt;a href="#"&gt;Sub Link 1&lt;/a&gt;&lt;/li&gt;
        &lt;li role="menuitem"&gt;&lt;a href="#"&gt;Sub Link 2&lt;/a&gt;&lt;/li&gt;
      &lt;/ul&gt;
    &lt;/li&gt;
  &lt;/ul&gt;
&lt;/nav&gt;</pre><p>Lots of roles and attributes, right? Like I said, navigation is one of the most important parts of a website, and that&#8217;s why making sure the accessibility tree can build it properly is so important too. In this example, we defined the navigation with a <a href="https://www.w3.org/TR/wai-aria/roles#navigation" target="_blank">navigation</a> role, and its child unordered list as being a <a href="https://www.w3.org/TR/wai-aria/roles#menubar" target="_blank">menubar</a>. This means that the navigation is visually presented as a horizontal menu bar as opposed to a vertical menu (which instead would use a <a href="https://www.w3.org/TR/wai-aria/roles#menu" target="_blank">menu</a> role). Beneath that, we have our list of <a href="https://www.w3.org/TR/wai-aria/roles#menuitem" target="_blank">menuitems</a>. When we get to a menuitem that has a sub-menu that pops up, then we give it an ARIA property of <a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-haspopup" target="_blank">aria-haspopup=&#8221;true&#8221;</a>. We give the sub-menu a role of <strong>menu</strong> because this is a vertical submenu, as well as an ARIA <em>state</em> of <strong>aria-hidden=&#8221;true&#8221;</strong>. The reason this is a state is because the sub-menu is initially hidden from view, but when you hover over the parent menuitem, the sub-menu would appear, and then hide again when you aren&#8217;t interacting with it. With Javascript, you could change the state to be <strong>aria-hidden=&#8221;false&#8221;</strong> while the sub-menu is visible, and then back to true again when it&#8217;s not.</p>
<p>ARIA rule #3 above stated to be hesitant to use aria-hidden=&#8221;true&#8221; &#8211; but this is a perfect example of how to use it properly. The <em>aria-hidden</em> property deals with whether an element is supposed to be visible to a user at a certain time, while the <em>presentation</em> role straight up removes the element from the accessibility tree &#8211; which we certainly don&#8217;t want to do for navigation.</p>
<p>This same type of structure works for <em>lists</em> that aren&#8217;t necessarily menus &#8211; but instead of <strong>menu</strong> and <strong>menuitem</strong> roles, you would use <a href="https://www.w3.org/TR/wai-aria/roles#list" target="_blank">list</a> and <a href="https://www.w3.org/TR/wai-aria/roles#listitem" target="_blank">listitem</a> roles. Everything else such as properties and states remains exactly the same.</p>
<p>I know there are a lot of ARIA roles and attributes here &#8211; but you can reasonably assume that just about every nav &#8211; regardless of exact HTML structure &#8211; will follow an ARIA architecture similar to this example.</p>
<h3>Tab Lists</h3>
<p>Another common way you can use ARIA labels and descriptions is when you build a tab widget on your page, where you click tabs to reveal different content. On top of ARIA labels though, we have some other neat tab-specific ARIA roles and properties I want to show you. Specifically, they are:</p>
<ul>
<li><a href="https://www.w3.org/TR/wai-aria/roles#tab" target="_blank">tab</a> &#8211; a clickable tab which reveals content</li>
<li><a href="https://www.w3.org/TR/wai-aria/roles#tablist" target="_blank">tablist</a> &#8211; the container which groups the clickable tabs</li>
<li><a href="https://www.w3.org/TR/wai-aria/roles#tabpanel" target="_blank">tabpanel</a> &#8211; the actual content of the tab</li>
<li><a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-controls" target="_blank">aria-controls</a> &#8211; a property that&#8217;s not tab-specific, but helps indicate that an element <em>controls</em> another element</li>
</ul>
<p></p><pre class="crayon-plain-tag">&lt;div role="tablist" class="tab-links"&gt;
  &lt;a id="tab-1" role="tab" aria-controls="panel-1" href="#"&gt;Tab 1&lt;/a&gt;
  &lt;a id="tab-2" role="tab" aria-controls="panel-2" href="#"&gt;Tab 2&lt;/a&gt;
  &lt;a id="tab-3" role="tab" aria-controls="panel-3" href="#"&gt;Tab 3&lt;/a&gt;
  &lt;a id="tab-4" role="tab" aria-controls="panel-4" href="#"&gt;Tab 4&lt;/a&gt;
&lt;/div&gt;
&lt;div class="tab-contents"&gt;
  &lt;div id="panel-1" role="tabpanel" aria-labelledby="tab-1" aria-hidden="false"&gt;Tab 1 Content&lt;/div&gt;
  &lt;div id="panel-2" role="tabpanel" aria-labelledby="tab-2" aria-hidden="true"&gt;Tab 2 Content&lt;/div&gt;
  &lt;div id="panel-3" role="tabpanel" aria-labelledby="tab-3" aria-hidden="true"&gt;Tab 3 Content&lt;/div&gt;
  &lt;div id="panel-4" role="tabpanel" aria-labelledby="tab-4" aria-hidden="true"&gt;Tab 4 Content&lt;/div&gt;
&lt;/div&gt;</pre><p>Tab lists are one of those things which really requires a lot of visual acuity to understand how they work, and without semantic HTML elements specific to tab architecture, it&#8217;s difficult to make tabs accessible by default. That&#8217;s why it&#8217;s so important to build them accessibly with ARIA roles and attributes. Here in this example, we&#8217;re doing a lot of different things:</p>
<ul>
<li>Setting ARIA roles for the tablist, tabs, and tabpanels</li>
<li>Stating which tab <em>controls</em> which tabpanel</li>
<li>Stating which tab <em>labels</em> each tabpanel</li>
<li>Handling the aria-hidden state to indicate which tabpanel is visible at any given time</li>
</ul>
<p>This, my friend, is proper and accessible HTML architecture.</p>
<h3>Forms</h3>
<p>Last, and perhaps most importantly, it&#8217;s absolutely essential that you make the interactive portions of a website as accessible as possible &#8211; and usually that ends up being your forms. There are a lot of various ARIA roles and attributes that can be applied to forms, so I just want to highlight some of the ones that are important to include:</p>
<ul>
<li><a href="https://www.w3.org/TR/wai-aria/roles#form" target="_blank">form</a> &#8211; pretty simple, just the landmark role for a &lt;form&gt;</li>
<li><a href="https://www.w3.org/TR/wai-aria/roles#search" target="_blank">search</a> &#8211; the role for a form with the primary function of searching data</li>
<li><a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-required" target="_blank">aria-required</a> &#8211; property indicating whether a field is required</li>
<li><a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-invalid" target="_blank">aria-invalid</a> &#8211; property indicating that the value of an input field is invalid (wait until <strong>after</strong> form submission to add this)</li>
</ul>
<p>On top of ARIA roles, there are a couple important things to consider when building accessible forms.</p>
<ol>
<li>It&#8217;s incredibly important that each form field has a valid &lt;label&gt; associated with it which either wraps the form field or references it with the <strong>for</strong> attribute. If this isn&#8217;t possible, then you can use the ARIA labelling methods discussed above. You <strong>cannot</strong> substitute the placeholder attribute for a label because it&#8217;s not meant to be handled as a label; a placeholder is meant to simply be an example of what you&#8217;re supposed to enter in that field.</li>
<li>Forms are often times tabbed-through via the keyboard, so it&#8217;s important that the tab order makes sense. Normally this isn&#8217;t a concern, but if you position or hide certain input fields via CSS/Javascript, then the tab order might become unintuitive. When this happens, you can set the <em>tabindex</em> attribute of an element to make sure that the tab order is how you expect it to be.</li>
</ol>
<p>Here&#8217;s an example form with proper markup:</p><pre class="crayon-plain-tag">&lt;p id="formLabel"&gt;Information Form&lt;/p&gt;
&lt;form role="form" aria-labelledby="formLabel"&gt;

  &lt;label for="name"&gt;Name&lt;/label&gt;
  &lt;input id="name" type="text" placeholder="John Doe" value="" /&gt;

  &lt;label for="email"&gt;Email*&lt;/label&gt;
  &lt;input id="email" type="email" placeholder="foo@bar.com" value="" aria-required="true" /&gt;
  
  &lt;span id="genderLabel"&gt;Gender&lt;/span&gt;
  &lt;div role="radiogroup" aria-labelledby="genderLabel"&gt;
    &lt;input type="radio" name="gender" value="male"&gt; Male&lt;br&gt;
    &lt;input type="radio" name="gender" value="female"&gt; Female&lt;br&gt;
    &lt;input type="radio" name="gender" value="other"&gt; Other
  &lt;/div&gt;

  &lt;label for="comment"&gt;Comment*&lt;/label&gt;
  &lt;textarea id="comment" aria-multiline="true" aria-required="true"&gt;&lt;/textarea&gt;

  &lt;input type="submit" value="Submit /&gt;

&lt;/form&gt;</pre><p>I threw in a couple extra ARIA roles and attributes such as <a href="https://www.w3.org/TR/wai-aria/roles#radiogroup" target="_blank">radiogroup</a> and <a href="https://www.w3.org/TR/wai-aria/states_and_properties#aria-multiline" target="_blank">aria-multiline</a> &#8211; but that&#8217;s just to show how specific you can get with them. Notice how we didn&#8217;t add a <a href="https://www.w3.org/TR/wai-aria/roles#radio" target="_blank">radio</a> role to the radio buttons (which is a valid ARIA role) &#8211; that&#8217;s because a radio input field itself semantically expresses how that element is supposed to work, and we don&#8217;t need to express that again with ARIA. However, because the wrapper of those fields is just a &lt;div&gt;, we still went ahead and gave it a radiogroup role.</p>
<p>Mostly, I just wanted to show the importance of labelling your input fields and how you can flag certain fields as required via ARIA attributes. If any field were invalid during the submission, then we would add an <strong>aria-invalid=&#8221;true&#8221;</strong> state onto each invalid field, and remove that state when the field becomes valid again.</p>
<h2>Final Thoughts</h2>
<p>We went over a lot of examples, and there&#8217;s still many more ARIA roles and attributes that we didn&#8217;t talk about &#8211; so feel free to check out the <a href="https://www.w3.org/TR/wai-aria/" target="_blank">ARIA docs</a> if you want to learn more.</p>
<p>To me, I love building accessible websites because it really feels like the right thing to do, but I like it for another reason too: I&#8217;m huge into code architecture and organization, and using ARIA roles and attributes helps me to architect my HTML much more semantically &#8211; and I love that. I hate using un-semantic elements such as &lt;div&gt;, &lt;span&gt;, and sometimes even &lt;ul&gt; &#8211; but if I can add an ARIA role such as <em>contentinfo</em>, <em>menu</em>, <em>treeitem,</em> <em>status</em>, and more, then I&#8217;m infinitely more happy because I&#8217;ve appropriately defined via HTML what this element is supposed to be. Taking things even further with ARIA attributes such as <em>aria-expanded</em>, <em>aria-hidden</em>, and <em>aria-invalid</em> make it even more semantic and meaningful.</p>
<p>If you don&#8217;t already, then I encourage you to start applying some of the ARIA principles into your web sites today &#8211; and as I mentioned in the intro, if you&#8217;d like to learn other ways that you can build your site accessibly, then you can check out my post over <a href="https://thesocietea.org/2014/07/developing-for-accessibility/">Developing for Accessibility</a>. I hope I&#8217;ve proven that it&#8217;s not too difficult to get started &#8211; and if you want more information, then the docs can answer any question you may have about them.</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2016/09/aria-roles-and-attributes-how-to-actually-use-them/feed/</wfw:commentRss>
		<slash:comments>4</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1218</post-id>	</item>
		<item>
		<title>How Public Key and Symmetric Key Encryption Work</title>
		<link>https://thesocietea.org/2016/08/how-public-key-and-symmetric-key-encryption-work/</link>
		<comments>https://thesocietea.org/2016/08/how-public-key-and-symmetric-key-encryption-work/#comments</comments>
		<pubDate>Thu, 11 Aug 2016 12:00:19 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[How Things Work]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1052</guid>
		<description><![CDATA[Public-key encryption and symmetric-key encryption are two of the most fundamental cryptographic systems out there and they&#8217;re also the driving force behind the Transport Layer Security (TLS) protocol. TLS is an evolution of Secure Sockets Layer, or SSL, and it defines how applications communicate privately over a computer network (the most famous network being &#8211; yup, you guessed it &#8211;...]]></description>
				<content:encoded><![CDATA[<p>Public-key encryption and symmetric-key encryption are two of the most fundamental cryptographic systems out there and they&#8217;re also the driving force behind the <a href="https://en.wikipedia.org/wiki/Transport_Layer_Security" target="_blank">Transport Layer Security</a> (TLS) protocol. TLS is an evolution of Secure Sockets Layer, or SSL, and it defines how applications communicate privately over a computer network (the most famous network being &#8211; yup, you guessed it &#8211; the Internet). By interacting with a server that employs TLS, you can be guaranteed that the information you are sending over from your browser client to that server is fully encrypted in such a way that only the server can decrypt it. What this means is that if some evil hacker really wants to, they&#8217;ll be able to see <em>that</em> you&#8217;re communicating with the server &#8211; but there&#8217;s no way for them to actually see what you&#8217;re sending over or what the server is sending back to you.</p>
<p>What I want do dig into is how this encryption works. How do I know that my communication with the server can only be decrypted by that server, and vice versa? We&#8217;re not going to get into the <a href="https://msdn.microsoft.com/en-us/library/windows/desktop/aa380513(v=vs.85).aspx" target="_blank">TLS handshake</a> here, as there are <em>tons</em> of other resources that describe that in full detail, but I want to get into these two fundamental encryption algorithms.</p>
<h2>Basic Encryption</h2>
<p>While encryption got its start in modern warfare (the <a href="https://en.wikipedia.org/wiki/Enigma_machine" target="_blank">enigma machine</a> is a really cool example of this), more recently if you hear people talking about it, they&#8217;re probably talking about cyber-security. Before we get deeper into symmetric-key and public-key encryption, I need to make sure we&#8217;re all on the same page as far as understanding what encryption in general is. <a href="https://en.wikipedia.org/wiki/Encryption" target="_blank">Encryption</a> is the process of encoding a message in a manner that only authorized parties can read it, and not anyone else on the way such as attackers. How you encrypt your message is determined by which <a href="https://en.wikipedia.org/wiki/Cipher_suite" target="_blank">cipher</a> you use, such as AES or RSA. A cipher is the algorithm which converts your message into <a href="https://en.wikipedia.org/wiki/Ciphertext" target="_blank">ciphertext</a>, which looks like a bunch of jumbled up text to humans. This ciphertext eventually gets decrypted back into the original message once it has reached the authorized recipient. In order to encrypt or decrypt a message, you need a <em>key</em> &#8211; which is just a string of characters. How this key is generated and used is determined by the cipher that&#8217;s agreed upon by both parties. Browsers have multiple cipher suites that they support, and when making a request to a server, they will provide the server a list of these suites so that the server can select one that it also supports.</p>
<p>Encryption differs from a cryptographic <a href="https://en.wikipedia.org/wiki/Cryptographic_hash_function" target="_blank">hash function</a>, in the sense that an encrypted message is intended to be encoded <em>and</em> eventually decoded to reveal the initial message, while a hashed message is practically impossible to decode. Hash functions convert a message into a fixed length of text &#8211; usually somewhere between 128-256 bits &#8211; and they&#8217;re extremely useful, especially with password management. A common and secure way for applications to store your password is as hashed versions of the password. That way the application can validate your password when you log in by hashing it and verifying it with the hash it has stored, and the service never has to store your original password (this is a big safeguard if that service is ever attacked). Hashing algorithms are also used when creating message digests, message authentication codes (MACs), and digital signatures &#8211; all of which pertain to TLS.</p>
<p>Here&#8217;s an example of a hash function from the <a href="https://en.wikipedia.org/wiki/Secure_Hash_Algorithm" target="_blank">SHA</a> family, designed by the very lovely United States NSA:</p><pre class="crayon-plain-tag">&gt; openssl sha1 test.txt # Contains "Hello World!"

SHA1(test.txt)= a0b65939670bc2c010f4d5d6a0b3e4e4590fb92b</pre><p>Because hash functions are only one way (meaning they can&#8217;t be decrypted), there&#8217;s no way we can get &#8220;Hello World!&#8221; out from that message. However, if our message were instead <em>encrypted</em> and we had the key, then we could decrypt the encoded message. Now that we understand the basics of encryption &#8211; and how it differs from hash functions &#8211; let&#8217;s get deeper into symmetric-key and public-key encryption.</p>
<h2>Symmetric Key Encryption</h2>
<p>Let&#8217;s start off with symmetric-key encryption because it&#8217;s the easier of the two to understand. Symmetric-key encryption only involves one key, and you just use that one key to both encrypt and decrypt a message. That&#8217;s where the name <strong>symmetric</strong> comes from &#8211; because it&#8217;s used for both.</p>
<p>To encrypt a message using symmetric-key encryption, you must first select a cipher. The <a href="https://en.wikipedia.org/wiki/Advanced_Encryption_Standard" target="_blank">AES</a> cipher suite is one of the most commonly used symmetric-key ciphers since it&#8217;s secure and freely available. From there, you create a key &#8211; and that&#8217;s all you need to get started. Here&#8217;s an example in ruby using the <a href="http://ruby-doc.org/stdlib-2.0.0/libdoc/openssl/rdoc/OpenSSL.html" target="_blank">OpenSSL</a> module (part of the core Ruby library) and the 256 bit AES cipher.</p><pre class="crayon-plain-tag">require 'openssl'
cipher = OpenSSL::Cipher.new('aes-256-cbc')
cipher.encrypt # Set the mode to encrypt
cipher.update "Hello World!"
puts cipher.final
# prints encrypted string</pre><p>We now have an encrypted message &#8211; but we didn&#8217;t store the key or the encrypted string, so this example isn&#8217;t of any use for us. Let&#8217;s update this code to save the key and the encrypted string so that we can actually decrypt this message:</p><pre class="crayon-plain-tag">require 'openssl'
cipher = OpenSSL::Cipher.new('aes-256-cbc')
cipher.encrypt # We are encrypting
key = cipher.random_key
cipher.update "Hello World!"
encrypted_string = cipher.final

# -- Assuming a new machine

cipher2 = OpenSSL::Cipher.new('aes-256-cbc')
cipher2.decrypt # We are decrypting
cipher2.key = key
cipher2.update encrypted_string
puts cipher2.final
# prints 'Hello World!'</pre><p>And there we have it &#8211; solid, secure symmetric encryption. During the TLS handshake, the client creates a symmetric key and gives it to the server, and all further communication occurs through symmetric encryption. There&#8217;s one <em>big</em> issue though &#8211; how do we securely transport the key to the server? We can&#8217;t send it plain text, so we have to encrypt it somehow in a way that only the server can decrypt. We can&#8217;t do this with symmetric-key encryption because there&#8217;s no shared key between the server and the client yet; to accomplish this, we need to use public-key encryption.</p>
<h2>Public Key Encryption</h2>
<p>Public-key encryption is also known as <strong>asymmetric encryption</strong> because instead of just one key, you have two keys: a public key and a private key. Both of these keys belong to you, and you keep your private key private (so that no one can see it) and your public key open (so that everyone can see it). These two keys are mathematically related based on what cipher you use (the most common is the <a href="https://en.wikipedia.org/wiki/RSA_(cryptosystem)" target="_blank">RSA</a> cipher suite) in such a way that the private key is the only key that can decrypt what the public key encrypts, and the public key is the only key that can decrypt what the private key encrypts.</p>
<p>It works like this: Say you and I are communicating securely, and we both have our own public and private keys. You want to send me a message, and you can see my public key (but not my private key). We agree on a cipher, and you encrypt a message using <strong>my public key</strong>. You then send me that message. If that message gets intercepted by an attacker, then it&#8217;s no big deal because only my private key can decrypt it &#8211; which the attacker doesn&#8217;t have access to. Once I receive your message, I can decrypt it using <strong>my private key</strong>. If I want to respond to you, then I follow the same process except that I use <strong>your public key</strong> to encrypt the message, and you will then use <strong>your private key</strong> to decrypt it. This works flawlessly as long as you&#8217;re using a secure cipher and you keep your private key absolutely private.</p>
<p>To demonstrate public key encryption, we&#8217;re going to use a utility called <a href="https://www.gnupg.org/" target="_blank">GPG</a> &#8211; which is the open source version of <a href="https://en.wikipedia.org/wiki/Pretty_Good_Privacy" target="_blank">PGP</a> (Pretty Good Privacy). Let&#8217;s generate a private and public key pair first:</p><pre class="crayon-plain-tag">gpg --gen-key</pre><p>This will generate your private key. You&#8217;ll have to answer a lot of questions such as your name, email address, and passphrase for your key, but we&#8217;re going to use the defaults for everything else (e.g. RSA cipher, 2048 bits, no expiration date).</p>
<p>Now to generate our public key:</p><pre class="crayon-plain-tag">gpg --armor --output pubkey.txt --export 'Your Name'</pre><p>This will create the file <strong>pubkey.txt</strong> in your working directory. Now you can send this public key to everyone, and they can add it to their list of keys that they support &#8211; like so:</p><pre class="crayon-plain-tag">gpg --import pubkey.txt</pre><p>Now whenever someone wants to encrypt something and send it to you, they automatically have your public-key listed and just need to call it via your email address that you used earlier. Let&#8217;s say that you want to send me a file called <strong>test.txt</strong>, and you have my public key which is set up under the email address alkrauss48@gmail.com. That would look like this:</p><pre class="crayon-plain-tag">gpg --encrypt --recipient 'alkrauss48@gmail.com' test.txt</pre><p>This will create a file called <strong>test.txt.gpg</strong> that is encrypted with my public key according to the 2048 bit RSA cipher (assuming that&#8217;s the cipher my keys are based on). You can now send me this file, and I can decrypt it like this:</p><pre class="crayon-plain-tag">gpg --output test-decrypted.txt --decrypt test.txt.gpg</pre><p>Because that file was specifically encrypted with my public key, I can use my private key to decrypt it and dump it into a file called <strong>test-decrypted.txt</strong>. And that&#8217;s it! It doesn&#8217;t matter if an attacker got access to that file mid-transport because only the private key can decrypt it &#8211; and I&#8217;m the only person who has that.</p>
<h2>Putting Them Together</h2>
<p>The TLS handshake incorporates both symmetric and public-key encryption &#8211; and you might wonder why. Here&#8217;s the deal: when you make a request to a website that has a certificate, it will always have a public and a private key pair. But your browser <em>doesn&#8217;t</em> have a key pair, so strictly using public-key encryption is out of the question because only the browser would be able to encrypt things to the server &#8211; and not vice versa. Because of this, we have to rely on symmetric key encryption &#8211; but there&#8217;s still the problem that we alluded to above, which is how do you get the symmetric key to both parties in a secure manner? The solution: we use both types of encryption. Here&#8217;s a brief overview of the encryption procedures in TLS:</p>
<ul>
<li>The client sends a &#8220;Client Hello&#8221; message to the server, with a list of which cipher suites the client supports.</li>
<li>The server responds with a &#8220;Server Hello&#8221; message as well as its certificate containing the public key, and it also selects a cipher suite that the client and server will use from then on.</li>
<li>Based on the cipher suite, the client creates a symmetric key, encrypts it with the server&#8217;s public key, and sends it back to the server.</li>
<li>The server decrypts the message with its private key, and now both the client and the server have the shared symmetric key.</li>
<li>All communication between the client and the server will now use this shared secret key with symmetric encryption.</li>
</ul>
<p>This is by no means a list of everything that happens during the TLS handshake &#8211; it&#8217;s only meant to describe how the encryption protocols are set up between the client and the server. If you want more detail about how TLS works, I encourage you to google it; there are tons of resources out there written by people way smarter than me.</p>
<h2>Conclusion</h2>
<p>You might not ever have to use encryption in your day-to-day job, but it&#8217;s a topic that I find really interesting and important if you&#8217;re in the tech industry. Most of the websites we deal with are quickly switching to using certificates, which means all of your traffic with those websites is encrypted &#8211; and now you know a little bit about how that works! You could also be cool <del>nerd</del> kid and create a key pair, trade public keys with a buddy, and asymmetrically encrypt all of your files between one another with the GPG tool. You&#8217;re definitely a winner in my book if you do that!</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2016/08/how-public-key-and-symmetric-key-encryption-work/feed/</wfw:commentRss>
		<slash:comments>2</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1052</post-id>	</item>
		<item>
		<title>My Interviews with Amazon</title>
		<link>https://thesocietea.org/2016/07/my-interviews-with-amazon/</link>
		<comments>https://thesocietea.org/2016/07/my-interviews-with-amazon/#comments</comments>
		<pubDate>Mon, 11 Jul 2016 08:00:45 +0000</pubDate>
		<dc:creator><![CDATA[thecodeboss]]></dc:creator>
				<category><![CDATA[Random]]></category>

		<guid isPermaLink="false">https://thesocietea.org/?p=1401</guid>
		<description><![CDATA[Last Fall in 2015, I interviewed with Amazon Web Services for a senior web developer position and was eventually offered a job with one of the AWS teams. Interviewing with a massive tech firm like Amazon was a significantly different experience than with any other company I&#8217;ve interviewed with, and I want to talk about how it all went...]]></description>
				<content:encoded><![CDATA[<p>Last Fall in 2015, I interviewed with Amazon Web Services for a senior web developer position and was eventually offered a job with one of the AWS teams. Interviewing with a massive tech firm like Amazon was a significantly different experience than with any other company I&#8217;ve interviewed with, and I want to talk about how it all went down. How the interviews were structured, what all was discussed, what questions were asked &#8211; all the way down to getting flown out to onsite interviews and eventually getting the offer. As I was going through the interview process, I read posts on several forums by people who went through the same thing &#8211; and they were helpful, but they never got very deep. Not much of it applied to me, and it would have really helped me to feel more comfortable throughout the process if I could have found a true documented experience by someone who had gone through this before. This is my chance to make that happen for you, the future developer interviewing at a global tech firm. Spoiler alert &#8211; I did not accept the position, even after the entire interview process. We&#8217;ll get to why I made that decision, but first let&#8217;s start from the top.</p>
<h2>Interview Structure</h2>
<p>You can break my particular interview process up into a few segments &#8211; and that&#8217;s how I&#8217;m going to talk about them:</p>
<ul>
<li>Phase 1 &#8211; Getting Recruited</li>
<li>Phase 2 &#8211; First Phone Interview</li>
<li>Phase 3 &#8211; Second Phone Interview</li>
<li>Phase 4 &#8211; Onsite Interviews in Seattle, WA</li>
<li>Phase 5 &#8211; The Offer</li>
</ul>
<p>As far as my research went, this is more or less the same process that most developers went through who interviewed with Amazon, Microsoft, Google, etc. However, I read a few stories of developers having 3 phone interviews instead of 2, so your mileage may vary. I&#8217;ve bored you with enough of this meta-information &#8211; let&#8217;s get to the meat of the process.</p>
<h2>Phase 1 &#8211; Getting Recruited</h2>
<p>As a developer, I get hit up a lot by tech recruiters either through email or LinkedIn, and honestly I tend to ignore most of them or &#8211; if the recruiter sent a half-way decent message &#8211; respond politely, declining their request. However, one day in August of 2015, I received a message by a recruiter &#8211; but not a normal 3rd-party tech recruiter like I normally see. This was a recruiter working at Amazon Web Services, specifically searching for a Senior Web Developer with one of the AWS teams. From the very beginning, I took it very lightly. I responded saying that working for Amazon would be awesome, but for me and Layla to move up to Seattle would require a 170-200k salary. I assumed this recruiter would take a look at that number, scoff, and politely end our conversation &#8211; but she affirmed that they could work with that, and asked if I wanted to set up a phone interview.</p>
<p>I was pretty shocked &#8211; but I told her I&#8217;d bite. I&#8217;ll play along for now. After all, how many times do you get to interview with one of the most influential companies in the world?</p>
<p>Over the next week, I emailed with this recruiter and her hiring manager to complete some basic paperwork and to schedule a date and time for my first phone interview with AWS.</p>
<h2>Phase 2 &#8211; First Phone Interview</h2>
<p>My first phone interview was scheduled at an exact time (2pm) with the manager of the service that I was interviewing for &#8211; so basically my intended future boss. I remember I spent the whole day looking up common interview questions for programming, and watching a <a href="https://www.youtube.com/playlist?list=PL2_aWCzGMAwI3W_JlcBbtYTwiQSsOTa6P" target="_blank">lengthy video series</a> over data structures so that I knew the time and space complexity differences over iterating between arrays, hashes, binary trees, etc. A few minutes after 2pm on a Friday, I received a call from the manager &#8211; we&#8217;ll call him Bob (not his real name). All in all, the phone interview lasted about 1 hour and 10 minutes &#8211; and it really wasn&#8217;t technical at all. No coding, no super-deep programming questions. Initially, the phone call seemed a little bit &#8220;bureaucratic&#8221; in the sense that I had to verify that I was expecting this call and made sure I had allotted a full hour to speak &#8211; but it quickly became very relaxed.</p>
<p>Bob started off with just asking about my general skill-set, and told me a little bit about what the position entailed. After about 20 minutes, we segued into other questions. He asked me if I could explain a single-page app, what MVC was, and he asked me a time when I disagreed with my manager. I hate those types of situational questions &#8211; but it wasn&#8217;t too bad. We spent about 20 minutes talking about that one question. After that, we just made some small talk about weather, what Bob does, the fact that it was Friday and he was taking it easy, etc. The last 20 minutes were really chill, just 2 people talking. Neither of us were bothered by the fact that the interview had gone about 10 minutes late.</p>
<p>Before we got off the phone, I asked for Bob&#8217;s email address (with the intention of sending a thank you email later in the day). I was told that I would hear back within the next week about whether I made it to the next interview. This part was pretty crazy to me, because it wasn&#8217;t even a full hour before I heard back from the Amazon hiring manager saying that I had passed the interview and they wanted to schedule another phone interview with someone else to assess my coding abilities. This next interview was scheduled for the following Thursday, this time at 3pm.</p>
<h2>Phase 3 &#8211; Second Phone Interview</h2>
<p>Unlike the first phone interview where I had no idea what it was going to be like, I knew ahead of time that this interview was going to involve me coding for an hour. I was given a link for a service called CollabEdit where I would code inside of a text area and the interviewer &#8211; let&#8217;s call him Jim &#8211; would be able to see in real-time what I was coding.</p>
<p>Jim called promptly at 3pm, and told me a little bit about himself. He was also a manager, but in no way related to Bob or Bob&#8217;s team. Jim was someone who I would never work with, and was strictly there to assess my coding skills. He told me he had 4-5 questions for us to get through, but if we only got through a few, then that would be fine. The emphasis was on him assessing me, and not necessarily completing the questions.</p>
<p>For about 45 minutes, I coded with him on the phone. I had a bluetooth headset and mic while I was coding, which I highly recommend anyone else do. I couldn&#8217;t have done this with my phone held up to my ear by my shoulder. We spent the entire 45 minutes on <strong>one question</strong>. Just one. And it was about client-side javascript. The single question was about how would I find all HTML elements on a page by class. Within the first line, I started with a simple jQuery selector &#8211; which he said worked. But then he slowly started giving me constraints. How would you do this without jQuery? How would you do this with multiple classes? Can you use a wildcard selector? etc. We spent the whole time on that one question; it was actually pretty fun &#8211; we both got really into it. My biggest tip here for anyone in this same position is to talk about what you&#8217;re thinking. Jim&#8217;s just a man on the phone who can see what I&#8217;m coding &#8211; but he doesn&#8217;t know what&#8217;s going on inside my head, so I need to help him with that as much as I can.</p>
<p>Towards the end of the hour, Jim stopped the coding session and asked if I had any questions for him. We then talked for a minute, and he told me something similar to what Bob said &#8211; that I would hear back within the next week, but this time, instead of another code interview, the next step would be an onsite interview. He did tell me that he&#8217;d had good interviews and bad interviews in the past, and he felt good about this one. This interview was on a Thursday, and I heard back the following Tuesday evening that I had passed onto the next (final) round of interviews.</p>
<p>I was going to Seattle.</p>
<h2>Phase 4 &#8211; Onsite Interviews in Seattle</h2>
<p>I got the email that I had made it to the next stage of interviews, and was asked what dates would be best for me to fly to Seattle for the interviews. This email exchange took place on September 9, and the dates matched up for me to interview in Seattle on October 12. Once the date was set, I was given the information of an Amazon travel agent (run by another company) to call and schedule airline times and whether I was staying 1 or 2 nights. My interview was on a Monday, and I was offered to fly up on Saturday and stay two nights &#8211; but I opted to fly up on that Sunday, and then fly right back to OKC directly after my interviews on the Monday. Just a 1 night stay. This is all paid for by Amazon, by the way. I didn&#8217;t have to give a credit card number at any point in time.</p>
<p>Once October 11th came, I flew to Seattle and stayed at Hotel Ändra in downtown Seattle. To get around, Amazon told me I could take a cab, Uber, public transportation &#8211; anything, and they would reimburse me up to $100/day for food and travel combined. I took the Light Rail directly from the airport to downtown Seattle for $3. Talk about a deal. For dinner, I just got room service. Eating dinner out alone is just &#8230; lonely.</p>
<p>My interviews were scheduled to start at 9:45 am on Monday, and were to finish at 2pm. I woke up early, got breakfast by the sea, and explored Pike Place while it was opening up for the day. Definitely a neat experience. From there, I just walked to the interview building.</p>
<p>Amazon encouraged me to dress casually, but I still dressed business-casual (button up, dress pants, no tie). Throughout the day there were 5 back-to-back interviews, each one-on-one. All coding was done on a white board. No electronics involved at all (except for the interviewer taking notes). Here&#8217;s the breakdown of my interviews:</p>
<ul>
<li>Initial interview with a team member I&#8217;d be working with. 50% discussion, 50% coding.</li>
<li>2nd interview with a developer on another team. 20% discusion, 80% coding. This coding session involved more &#8220;traditional&#8221; coding interview questions. The main question was about how to build a circularly linked list, and how would I add a method to delete a node and have the linked list still be circular. I started answering this in C, but after my knowledge failed me, I just moved to ruby, which was significantly easier for me. The interviewer was cool with it, even though he didn&#8217;t know ruby.</li>
<li>3rd interview with a developer on another team &#8211; strictly to assess my personal skills. These were the &#8220;fun&#8221; situational questions (mixed in with some personal experience questions). 100% discussion, no coding.</li>
<li>4th interview with Bob &#8211; the manager of the team. This was over lunch which he paid for. It was mostly casual talking, but he asked me some technical questions as we were eating.</li>
<li>5th interview with a developer on another team. 20% discussion, 80% coding. This was a very front-end oriented interview. All code involved web development topics, HTML, CSS, and Javascript. One question was how an interaction with a JSON API is different from standard HTML, leading up to how single page apps work &#8211; so I basically drew a simple diagram of the request process for a single page app. The main coding question was how would you build a slider (like the ones you see on every page). I stumbled on this at first &#8211; as it seemed like a crazy interview question, but I took it one step at a time, i.e. a slider is just a wrapper element with child elements. The CSS should just position them absolutely next to one another. Clicking arrows should just issue JS to shift positions of those divs.</li>
</ul>
<p>After my final interview, I had just over 2 hours until my plane took off (I wanted to get back home as early as possible). I booked it to the Light Rail station, spent another $3 to get to the airport, hustled through security and made it minutes before my boarding time.</p>
<p>If you go through an interview process like this, here&#8217;s a big note: <strong>don&#8217;t bring checked luggage</strong>. You&#8217;re staying for a very short time, try to keep everything carry-on. Checked luggage will just be a pain to deal with.</p>
<h2>Phase 5 &#8211; The Offer</h2>
<p>Back in OKC, it was either the next day or the day after that I got a call from Amazon&#8217;s HR department. I was told that Bob liked me and they had an offer for me. I won&#8217;t get too specific, but it was in the low 6 figures (plus a bonus) &#8211; definitely not the 170-200k the initial recruiter told me they could do. Restricted stock units (RSUs) were a part of their overall benefits, and made up about 2k of salary for the first year. They made up a little more after the second year, and would have maximized by year 4. In total, it probably would add up to 40k of stock after 4 years &#8211; which isn&#8217;t a petty amount. Regardless of salary, I was honestly pretty shocked that I had gotten an offer, and told the HR person that I would get back to them within a week after I discussed this with my family.</p>
<p>This is probably terrible to say, but everything was a game to me up until this point. I never in a million years thought I could get picked up by Amazon &#8211; but here it was, the opportunity. We spent that whole weekend deciding what we wanted to do &#8211; but in the end, we made the decision not to take the offer.</p>
<p>Relocation cost wasn&#8217;t an issue &#8211; Amazon pays for all of that, and goes above and beyond to make sure you assimilate to Seattle well. The other benefits that Amazon offered were pretty stellar too, but there were two big reasons holding us back:</p>
<p><strong>Cost of living.</strong> Here in OKC, we have super cheap cost of living. In Seattle, we would be paying twice our current house payment for a mid-level downtown one-bedroom apartment, and 2.5 &#8211; 3 times our house payment for a two-bedroom. Houses were pretty much out of the question &#8211; anything comparable to what we had here that was near downtown Seattle was anywhere from 600k &#8211; over 1 million dollars. Sure &#8211; the offer I got from Amazon was twice what I made here in OKC at the time, but that was still just too much for us.</p>
<p><strong>Family.</strong> This was the big deal. We never really thought about leaving family &#8211; until we were forced to. We just couldn&#8217;t do it. We have parents, friends, siblings, and nieces all within a few miles that we see just about every week, and we just didn&#8217;t want to give that up.</p>
<p>It was difficult, and I did wonder for a few days or so if we had made the right choice &#8211; but I&#8217;m positive we made the right decision to deny the offer. I explained the whole situation to the HR person I was working with, and he was very kind about it and congratulated me on getting the offer nonetheless. For me, this was truly the opportunity of a lifetime, and I&#8217;m so thankful that Amazon was awesome enough to let me have it.</p>
<h2>Final Thoughts</h2>
<p>I&#8217;m sure some of you out there would kill me for not taking the opportunity to work at Amazon &#8211; but I promise you, we made the right choice for us. We belong here for now, and going through this process showed me that big time. Plus, with the OKC developer community really growing within the last couple of years, I&#8217;m not sure I ever want to leave now. We&#8217;re rooted, and I&#8217;m happy about that.</p>
<p>Thanks for all of this, Amazon.</p>
]]></content:encoded>
			<wfw:commentRss>https://thesocietea.org/2016/07/my-interviews-with-amazon/feed/</wfw:commentRss>
		<slash:comments>67</slash:comments>
	<post-id xmlns="com-wordpress:feed-additions:1">1401</post-id>	</item>
	</channel>
</rss>

<!-- Dynamic page generated in 0.834 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-04-17 17:51:01 -->
