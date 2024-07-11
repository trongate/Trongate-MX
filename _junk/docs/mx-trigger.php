<section>
<h1>Triggers in Trongate MX</h1>

<p>Trongate MX uses event triggers to determine when to initiate HTTP requests. The triggering behavior is built into the framework's event handling system, allowing for dynamic and responsive web applications.</p>

<h2>Understanding Triggers in Trongate MX</h2>
<p>Trongate MX listens for specific events on elements with attributes like <code>mx-get</code>, <code>mx-post</code>, etc. When these events occur, Trongate MX initiates the corresponding HTTP request.</p>

<h2>Supported Events</h2>
<p>Trongate MX supports the following standard DOM events:</p>
<ul>
  <li><code>click</code>: Triggered when the element is clicked</li>
  <li><code>dblclick</code>: Triggered when the element is double-clicked</li>
  <li><code>change</code>: Triggered when the value of an input element changes</li>
  <li><code>submit</code>: Triggered when a form is submitted</li>
  <li><code>keyup</code>: Triggered when a key is released</li>
  <li><code>keydown</code>: Triggered when a key is pressed down</li>
  <li><code>focus</code>: Triggered when an element receives focus</li>
  <li><code>blur</code>: Triggered when an element loses focus</li>
  <li><code>load</code>: Triggered only upon initial page load</li>
</ul>

<h2>Default Behaviors</h2>
<p>If no specific event is specified, Trongate MX uses default behaviors based on the element type:</p>
<ul>
  <li>For <code>&lt;form&gt;</code> elements: <code>submit</code></li>
  <li>For <code>&lt;input&gt;</code> elements of type "submit": <code>click</code></li>
  <li>For other <code>&lt;input&gt;</code>, <code>&lt;textarea&gt;</code>, and <code>&lt;select&gt;</code> elements: <code>change</code></li>
  <li>For all other elements: <code>click</code></li>
</ul>

<h2>Regarding Initial Page Loads</h2>

<h3>mx-trigger="load"</h3>
<p>The <code>mx-trigger="load"</code> attribute is a special trigger in Trongate MX that is used to initiate an HTTP request immediately and only upon the initial page load. This is particularly useful for initializing content without user interaction when the page first loads.</p>

<h4>Example: Loading content on initial page load</h4>
<pre><code>&lt;div mx-get="&lt;?= BASE_URL ?>api/get_initial_data" 
     mx-trigger="load" 
     mx-target="#initial-content"&gt;
&lt;/div&gt;</code></pre>

<p>In this example, Trongate MX will automatically make a GET request to the specified URL when the page initially loads and populate the <code>#initial-content</code> element with the response.</p>

<div class="alert alert-info">
  <strong>Important:</strong> The <code>mx-trigger="load"</code> attribute is only invoked upon the initial page load. It will not trigger on subsequent DOM updates, dynamic content insertions, or page refreshes. This behavior is specific to Trongate MX and differs from the standard DOM 'load' event.
</div>

<h2>Form Submission</h2>
<p>For form submissions, Trongate MX automatically handles the submit event:</p>
<pre><code>&lt;form mx-post="&lt;?= BASE_URL ?>api/submit_data" 
      mx-target="#message-area" 
      mx-indicator=".spinner"&gt;
  &lt;!-- form fields here --&gt;
  &lt;button type="submit"&gt;Submit&lt;/button&gt;
&lt;/form&gt;</code></pre>

<h2>Advanced Usage: Multiple Triggers</h2>
<p>Trongate MX allows you to specify multiple triggers for a single element. This can be useful for creating more complex interactions.</p>

<pre><code>&lt;input type="text" 
       mx-get="&lt;?= BASE_URL ?>api/search" 
       mx-trigger="keyup changed delay:500ms, load" 
       mx-target="#search-results"&gt;</code></pre>

<p>In this example, the search will be triggered:</p>
<ul>
  <li>500ms after the user stops typing (debounce)</li>
  <li>When the input value changes</li>
  <li>Immediately when the page initially loads (but not on subsequent updates)</li>
</ul>

<h2>Best Practices</h2>
<ul>
  <li><strong>Use Appropriate Triggers:</strong> Choose triggers that make sense for the user interaction you're designing.</li>
  <li><strong>Leverage Initial Load:</strong> Use <code>mx-trigger="load"</code> for content that should be fetched immediately when the page first loads.</li>
  <li><strong>Consider Performance:</strong> Be cautious with triggers like 'keyup' on text inputs, which can lead to many requests. Use debouncing when appropriate.</li>
  <li><strong>Combine with Other Attributes:</strong> Use triggers in conjunction with other Trongate MX attributes for more sophisticated interactions.</li>
  <li><strong>Provide Visual Feedback:</strong> Use <code>mx-indicator</code> to show loading states, especially for actions that might take some time.</li>
</ul>

<h2>Notes</h2>
<ul>
  <li>Trongate MX automatically prevents default form submission behavior.</li>
  <li>The framework handles showing and hiding of loader elements specified by <code>mx-indicator</code>.</li>
  <li>For non-form elements, the default trigger is typically a click event.</li>
  <li>The 'load' trigger in Trongate MX is specific to initial page loads and behaves differently from the standard DOM 'load' event.</li>
</ul>

<h2>Summary</h2>
<p>Understanding how Trongate MX handles events and triggers is crucial for creating interactive and responsive web applications with minimal custom JavaScript. The <code>mx-trigger="load"</code> attribute provides a unique way to initialize content on the first page load. By leveraging the built-in trigger system and combining it with other Trongate MX attributes, you can create rich, dynamic user experiences efficiently, while being mindful of the specific behavior of the 'load' trigger.</p>

</section>