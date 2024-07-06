<h1>Automatic Content Loading on Page Load</h1>
<p>The <code>mx-load</code> attribute in Trongate MX allows you to automatically load content when an element is first added to the DOM. This feature is particularly useful for initializing elements with dynamic content without requiring user interaction. </p>
<h2>Purpose and Functionality</h2>
<p>The <code>mx-load</code> attribute triggers an HTTP request as soon as the element is loaded into the DOM. This is in contrast to other HTTP method attributes like <code>mx-get</code> or <code>mx-post</code>, which typically require a user action to trigger the request. </p>
<h2>Usage</h2>
<p>To use <code>mx-load</code>, simply add it to an HTML element with the URL you want to request as the value: </p>
<pre>
	<code>&lt;div mx-load="&lt;?= BASE_URL ?&gt;api/get_initial_data"&gt;&lt;/div&gt;</code>
</pre>
<p>This div will automatically make a request to the specified URL when the page loads.</p>
<h2>How It Works</h2>
<p>The <code>mx-load</code> attribute is processed by the <code>handleMxTrigger</code> function, which recognizes it as a special case: </p>
<pre>
	<code>function handleMxTrigger(element) { const methodAttributes = ['mx-get', 'mx-post', 'mx-put', 'mx-delete', 'mx-patch', 'mx-load']; // ... if (triggerEvent === 'load') { handleLoadEvents(element, attribute); } // ... }</code>
</pre>
<p>When a 'load' event is detected, it's handled by the <code>handleLoadEvents</code> function: </p>
<pre>
	<code>function handleLoadEvents(element, attribute) { // Immediately invoke the HTTP request for 'load' events invokeHttpRequest(element, 'load', attribute); }</code>
</pre>
<p>This function immediately invokes an HTTP request, without waiting for any user interaction.</p>
<h2>Initialization</h2>
<p>The <code>mx-load</code> attribute is initialized along with other Trongate MX attributes when the DOM is fully loaded: </p>
<pre>
	<code>document.addEventListener('DOMContentLoaded', function() { // ... document.querySelectorAll('[mx-get], [mx-post], [mx-put], [mx-delete], [mx-patch], [mx-load]').forEach(element => { handleMxTrigger(element); }); });</code>
</pre>
<h2>Combining with Other Attributes</h2>
<p>You can combine <code>mx-load</code> with other Trongate MX attributes for more complex behavior: </p>
<pre>
	<code>&lt;div mx-load="&lt;?= BASE_URL ?&gt;api/get_initial_data" mx-target="#result" mx-indicator="#loading"&gt; &lt;/div&gt; &lt;div id="result"&gt;&lt;/div&gt; &lt;div id="loading" class="spinner mx-indicator"&gt;&lt;/div&gt;</code>
</pre>
<p>In this example, the content will be loaded automatically, inserted into the #result div, and display a loading indicator during the request.</p>
<h2>Best Practices</h2>
<ul>
  <li>Use <code>mx-load</code> for content that needs to be fetched immediately when the page loads. </li>
  <li>Be mindful of performance implications when using multiple <code>mx-load</code> attributes on a single page. </li>
  <li>Consider using loading indicators ( <code>mx-indicator</code>) with <code>mx-load</code> to provide visual feedback during the loading process. </li>
  <li>Ensure your server can handle the potential increase in requests from <code>mx-load</code> elements. </li>
</ul>
<h2>Notes</h2>
<ul>
  <li>
    <code>mx-load</code> requests are processed as soon as the DOM is loaded, which may be before all page resources (like images) have finished loading.
  </li>
  <li>Unlike other HTTP method attributes, <code>mx-load</code> doesn't require a trigger event to be specified. </li>
  <li>Error handling for <code>mx-load</code> requests is managed in the same way as other Trongate MX HTTP requests. </li>
</ul>
<p>By leveraging the <code>mx-load</code> attribute, you can create more dynamic and responsive web applications that begin fetching necessary data as soon as the page loads, enhancing the user experience with Trongate MX. </p>