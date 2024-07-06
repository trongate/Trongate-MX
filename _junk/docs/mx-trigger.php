<h1>Triggers</h1>
<p>The <code>mx-trigger</code> attribute in Trongate MX allows you to specify which event should trigger an HTTP request for an element. This attribute provides fine-grained control over when and how your elements interact with the server. </p>
<h2>Understanding mx-trigger</h2>
<p>When you add an <code>mx-trigger</code> attribute to an element, you're telling Trongate MX to listen for a specific event on that element. When that event occurs, Trongate MX will initiate the HTTP request specified by attributes like <code>mx-get</code>, <code>mx-post</code>, etc. </p>
<h2>Valid Triggers</h2>
<p>Trongate MX supports the following standard DOM events as valid triggers:</p>
<ul>
  <li>
    <code>click</code>: Triggered when the element is clicked
  </li>
  <li>
    <code>dblclick</code>: Triggered when the element is double-clicked
  </li>
  <li>
    <code>change</code>: Triggered when the value of an input element changes
  </li>
  <li>
    <code>submit</code>: Triggered when a form is submitted
  </li>
  <li>
    <code>keyup</code>: Triggered when a key is released
  </li>
  <li>
    <code>keydown</code>: Triggered when a key is pressed down
  </li>
  <li>
    <code>focus</code>: Triggered when an element receives focus
  </li>
  <li>
    <code>blur</code>: Triggered when an element loses focus
  </li>
  <li>
    <code>load</code>: Triggered when the page finishes loading
  </li>
</ul>
<h2>Default Triggers</h2>
<p>If no <code>mx-trigger</code> is specified, Trongate MX will use default triggers based on the element type: </p>
<ul>
  <li>For <code>&lt;form&gt;</code> elements: <code>submit</code>
  </li>
  <li>For <code>&lt;input&gt;</code> elements of type "submit": <code>click</code>
  </li>
  <li>For other <code>&lt;input&gt;</code>, <code>&lt;textarea&gt;</code>, and <code>&lt;select&gt;</code> elements: <code>change</code>
  </li>
  <li>For all other elements: <code>click</code>
  </li>
</ul>
<h2>Examples</h2>
<h3>Example 1: Populating a div on page load</h3>
<p>To have a <code>#result</code> div automatically populate upon the initial page load, you can use the <code>load</code> trigger. Here's an example: </p>
<pre>
	<code>&lt;div mx-get="&lt;?= BASE_URL ?&gt;api/get_initial_data" mx-trigger="load" mx-target="#result"&gt;&lt;/div&gt; &lt;div id="result"&gt;&lt;/div&gt;</code>
</pre>
<p>In this example, as soon as the page loads, Trongate MX will make a GET request to the specified URL and populate the <code>#result</code> div with the response. </p>
<h3>Example 2: Fetching data on button click</h3>
<p>Here's an example of using a custom trigger on a button:</p>
<pre>
	<code>&lt;button mx-get="&lt;?= BASE_URL ?&gt;api/get_data" mx-trigger="click" mx-target="#result"&gt; Fetch Data &lt;/button&gt; &lt;div id="result"&gt;&lt;/div&gt;</code>
</pre>
<p>In this case, the GET request will only be triggered when the button is clicked, and the response will be inserted into the <code>#result</code> div. </p>
<h2>Advanced Usage</h2>
<p>You can combine <code>mx-trigger</code> with other Trongate MX attributes for more complex behaviors. For example: </p>
<pre>
	<code>&lt;input type="text" mx-get="&lt;?= BASE_URL ?&gt;api/search" mx-trigger="keyup changed delay:500ms" mx-target="#search-results"&gt; &lt;div id="search-results"&gt;&lt;/div&gt;</code>
</pre>
<p>This input will trigger a search request 500 milliseconds after the user stops typing, but only if the value has changed.</p>
<h2>Notes</h2>
<ul>
  <li>The <code>mx-trigger</code> attribute is optional. If not specified, Trongate MX will use the default trigger for the element type. </li>
  <li>You can specify multiple triggers by separating them with spaces.</li>
  <li>The <code>load</code> trigger is special and will cause the request to be sent immediately when the page loads. </li>
  <li>When using <code>mx-trigger</code> with form elements, be mindful of the default form submission behavior and use <code>event.preventDefault()</code> if necessary. </li>
</ul>
<p>By mastering the <code>mx-trigger</code> attribute, you can create highly interactive and responsive web applications with minimal JavaScript code. </p>