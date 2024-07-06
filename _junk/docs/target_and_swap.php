<h1>Target and Swap Operations</h1>
<p>Trongate MX provides powerful mechanisms for updating the DOM with server responses through target and swap operations. These operations are controlled by the <code>mx-target</code> and <code>mx-swap</code> attributes, allowing for precise control over where and how content is inserted or replaced in your web page. </p>
<h2>The mx-target Attribute</h2>
<p>The <code>mx-target</code> attribute specifies which element in the DOM should be updated with the server response. If not specified, the triggering element itself becomes the target. </p>
<pre>
	<code>&lt;button mx-get="/api/data" mx-target="#result"&gt;Get Data&lt;/button&gt; &lt;div id="result"&gt;&lt;/div&gt;</code>
</pre>
<p>In this example, the response will be inserted into the div with id "result".</p>
<h2>The mx-swap Attribute</h2>
<p>The <code>mx-swap</code> attribute determines how the content should be inserted into the target element. If not specified, it defaults to 'innerHTML'. </p>
<p>Available swap methods:</p>
<ul>
  <li>
    <code>innerHTML</code> (default): Replace the inner HTML of the target
  </li>
  <li>
    <code>outerHTML</code>: Replace the entire target element
  </li>
  <li>
    <code>textContent</code>: Replace the text content of the target
  </li>
  <li>
    <code>beforebegin</code>: Insert before the target element
  </li>
  <li>
    <code>afterbegin</code>: Insert as the first child of the target element
  </li>
  <li>
    <code>beforeend</code>: Insert as the last child of the target element
  </li>
  <li>
    <code>afterend</code>: Insert after the target element
  </li>
  <li>
    <code>delete</code>: Remove the target element
  </li>
  <li>
    <code>none</code>: Do not insert the content (useful with out-of-band swaps)
  </li>
</ul>
<pre>
	<code>&lt;button mx-get="/api/data" mx-target="#result" mx-swap="afterbegin"&gt;Prepend Data&lt;/button&gt; &lt;div id="result"&gt;&lt;/div&gt;</code>
</pre>
<h2>Content Selection</h2>
<p>The <code>mx-select</code> attribute allows you to select a specific part of the response to be swapped: </p>
<pre>
	<code>&lt;button mx-get="/api/data" mx-target="#result" mx-select="#important-data"&gt;Get Important Data&lt;/button&gt;</code>
</pre>
<p>This will select the element with id "important-data" from the response and insert it into the target.</p>
<h2>Out-of-Band Swaps</h2>
<p>The <code>mx-select-oob</code> attribute enables updating multiple elements on the page with a single request. It uses a comma-separated list of selector pairs. </p>
<pre>
	<code>&lt;button mx-get="/api/data" mx-target="#main-content" mx-select-oob="#sidebar-content:#sidebar, #header-content:#header"&gt; Update Multiple Elements &lt;/button&gt;</code>
</pre>
<p>This will update the main content, sidebar, and header in a single request.</p>
<h2>Handling Responses</h2>
<p>Trongate MX automatically handles the server responses:</p>
<ul>
  <li>For successful responses (status 200-299), the content is swapped as specified.</li>
  <li>For error responses, error handling is triggered, which may include displaying validation errors for forms.</li>
</ul>
<h2>Best Practices</h2>
<ul>
  <li>Use descriptive IDs for your target elements to make your code more readable.</li>
  <li>Choose the appropriate swap method based on your needs to minimize DOM manipulation.</li>
  <li>Utilize out-of-band swaps to update multiple parts of your page efficiently.</li>
  <li>Handle both success and error cases in your server responses for a smooth user experience.</li>
</ul>
<p>By mastering target and swap operations, you can create dynamic, responsive web applications with minimal JavaScript, leveraging the full power of Trongate MX.</p>