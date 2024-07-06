<h1>Triggers in Trongate MX</h1>
<p>Trongate MX uses event triggers to determine when to initiate HTTP requests. While there isn't a specific <code>mx-trigger</code> attribute, the triggering behavior is built into the framework's event handling system. </p>
<h2>Understanding Triggers in Trongate MX</h2>
<p>Trongate MX listens for specific events on elements with attributes like <code>mx-get</code>, <code>mx-post</code>, etc. When these events occur, Trongate MX initiates the corresponding HTTP request. </p>
<h2>Supported Events</h2>
<p>Trongate MX supports the following standard DOM events:</p>
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
</ul>
<h2>Default Behaviors</h2>
<p>If no specific event is specified, Trongate MX uses default behaviors based on the element type:</p>
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
<h2>Special Attributes</h2>
<h3>mx-load</h3>
<p>The <code>mx-load</code> attribute is used for automatic loading of content when the page loads. It doesn't require a separate trigger specification. </p>
<h3>Example: Auto-loading content</h3>
<pre>
  <code>&lt;div id="result" mx-load="http://localhost/api/get_data" mx-select="table" mx-indicator=".spinner"&gt;&lt;/div&gt;</code>
</pre>
<p>In this example, Trongate MX will automatically make a GET request to the specified URL when the page loads and populate the <code>#result</code> div with the response. </p>
<h2>Form Submission</h2>
<p>For form submissions, Trongate MX automatically handles the submit event:</p>
<pre>
  <code>&lt;form mx-post="http://localhost/api/submit_data" mx-target="#message-area" mx-indicator=".spinner"&gt; &lt;!-- form fields here --&gt; &lt;button type="submit"&gt;Submit&lt;/button&gt; &lt;/form&gt;</code>
</pre>
<h2>Notes</h2>
<ul>
  <li>Trongate MX automatically prevents default form submission behavior.</li>
  <li>The framework handles showing and hiding of loader elements specified by <code>mx-indicator</code>. </li>
  <li>For non-form elements, the default trigger is typically a click event.</li>
</ul>
<p>By understanding how Trongate MX handles events and triggers, you can create interactive and responsive web applications with minimal custom JavaScript.</p>