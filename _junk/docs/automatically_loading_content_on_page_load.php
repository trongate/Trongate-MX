<h1>Automatic Content Loading on Page Load</h1>
<p>The `mx-load` attribute in Trongate MX allows you to automatically load content when an element is first added to the DOM. This feature is particularly useful for initializing elements with dynamic content without requiring user interaction.</p>
<h2>Purpose and Functionality</h2>
<p>The `mx-load` attribute triggers an HTTP request as soon as the element is loaded into the DOM. This is in contrast to other HTTP method attributes like `mx-get` or `mx-post`, which typically require a user action to trigger the request.</p>
<h2>Usage</h2>
<p>To use `mx-load`, simply add it to an HTML element with the URL you want to request as the value:</p>
<pre>
  <code>&lt;div mx-load="&lt;?= BASE_URL ?&gt;api/get_initial_data"&gt;&lt;/div&gt;</code>
</pre>
<p>This div will automatically make a request to the specified URL when the page loads.</p>
<h2>How It Works</h2>
<p>The `mx-load` attribute is processed by the `handleMxTrigger` function along with other HTTP method attributes:</p>
<pre>
  <code>function handleMxTrigger(element) { const methodAttributes = ['mx-get', 'mx-post', 'mx-put', 'mx-delete', 'mx-patch', 'mx-load']; // ... }</code>
</pre>
<p>When an element with `mx-load` is encountered, it's treated as an immediate request, similar to other HTTP methods but without waiting for a user-triggered event.</p>
<h2>Initialization</h2>
<p>The `mx-load` attribute is initialized along with other Trongate MX attributes when the DOM is fully loaded:</p>
<pre>
  <code>document.addEventListener('DOMContentLoaded', function() { // ... document.querySelectorAll('[mx-get], [mx-post], [mx-put], [mx-delete], [mx-patch], [mx-load]').forEach(element => { handleMxTrigger(element); }); });</code>
</pre>
<h2>Combining with Other Attributes</h2>
<p>You can combine `mx-load` with other Trongate MX attributes for more complex behavior. Here's an example that demonstrates automatic loading with a loading indicator:</p>
<pre>
  <code>&lt;div id="loading" class="mx-indicator"&gt;Loading...&lt;/div&gt; &lt;div id="result" mx-load="http://localhost/trongate_mx/tasks/list" mx-select="table" mx-indicator="#loading"&gt;&lt;/div&gt;</code>
</pre>
<p>In this example:</p>
<ul>
  <li>The content will be loaded automatically when the page loads.</li>
  <li>The response will be inserted into the div with id "result".</li>
  <li>The div with id "loading" will be shown during the request and hidden when it's complete.</li>
  <li>The `mx-select` attribute specifies which part of the response should be inserted.</li>
  <li>The `mx-indicator` attribute specifies which element should be used as the loading indicator.</li>
</ul>
<h2>Best Practices</h2>
<ul>
  <li>Use `mx-load` for content that needs to be fetched immediately when the page loads.</li>
  <li>Be mindful of performance implications when using multiple `mx-load` attributes on a single page.</li>
  <li>Consider using loading indicators (`mx-indicator`) with `mx-load` to provide visual feedback during the loading process.</li>
  <li>Ensure your server can handle the potential increase in requests from `mx-load` elements.</li>
</ul>
<h2>Notes</h2>
<ul>
  <li>`mx-load` requests are processed as soon as the DOM is loaded, which may be before all page resources (like images) have finished loading.</li>
  <li>Unlike other HTTP method attributes, `mx-load` doesn't require a separate trigger event to be specified.</li>
  <li>Error handling for `mx-load` requests is managed in the same way as other Trongate MX HTTP requests.</li>
</ul>
<p>By leveraging the `mx-load` attribute, you can create more dynamic and responsive web applications that begin fetching necessary data as soon as the page loads, enhancing the user experience with Trongate MX.</p>