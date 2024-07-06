<h1>Out-of-Band Content Selection and Swapping</h1>
<p>Trongate MX offers a powerful feature for updating multiple parts of your webpage with a single request through the <code>mx-select-oob</code> attribute. This "out-of-band" swapping allows you to update elements beyond the primary target of your request, providing a more dynamic and efficient way to refresh your page content. </p>
<h2>Understanding mx-select-oob</h2>
<p>The <code>mx-select-oob</code> attribute allows you to select specific content from a server response and swap it into designated parts of your current DOM. This provides precise control over both the source of the content in the response and where it should be inserted in your page. </p>
<h2>Syntax</h2>
<p>The value of <code>mx-select-oob</code> is a comma-separated list of selector pairs. Each pair consists of two parts separated by a colon (:): </p>
<pre>
  <code>mx-select-oob="[source selector]:[target selector], [source selector]:[target selector], ..."</code>
</pre>
<ul>
  <li>
    <strong>Source selector:</strong> Identifies the content in the server response
  </li>
  <li>
    <strong>Target selector:</strong> Specifies where in the current DOM to insert the content
  </li>
</ul>
<h2>Basic Example</h2>
<p>Here's a simple example demonstrating the use of <code>mx-select-oob</code>: </p>
<pre>
  <code class="language-html"> &lt;div&gt; &lt;div id="alert"&gt;&lt;/div&gt; &lt;div id="sidebar"&gt;&lt;/div&gt; &lt;button mx-get="/info" mx-select="#info-details" mx-swap="outerHTML" mx-select-oob="#alert-content:#alert, #sidebar-content:#sidebar"&gt; Get Info! &lt;/button&gt; &lt;/div&gt; </code>
</pre>
<p>When this button is clicked, Trongate MX will:</p>
<ol>
  <li>Make a GET request to <code>/info</code>
  </li>
  <li>Replace the button with the <code>#info-details</code> element from the response </li>
  <li>Insert the <code>#alert-content</code> from the response into the <code>#alert</code> div </li>
  <li>Insert the <code>#sidebar-content</code> from the response into the <code>#sidebar</code> div </li>
</ol>
<h2>Advanced Usage: Specifying Swap Strategies</h2>
<p>You can specify different swap strategies for each out-of-band swap by adding a third part to the selector pair:</p>
<pre>
  <code class="language-html"> &lt;button mx-get="/info" mx-select="#info-details" mx-swap="outerHTML" mx-select-oob="#alert-content:#alert:afterbegin, #sidebar-content:#sidebar:innerHTML"&gt; Get Info! &lt;/button&gt; </code>
</pre>
<p>In this example:</p>
<ul>
  <li>The alert content will be prepended to the <code>#alert</code> div </li>
  <li>The sidebar content will replace the inner HTML of the <code>#sidebar</code> div </li>
</ul>
<h2>Key Features</h2>
<ul>
  <li>
    <strong>Inheritance:</strong>
    <code>mx-select-oob</code> can be placed on a parent element and will be inherited by its children.
  </li>
  <li>
    <strong>Precise Control:</strong> Unlike some similar libraries, <code>mx-select-oob</code> requires explicit specification of both source and target selectors, offering more precise control over out-of-band swaps.
  </li>
  <li>
    <strong>Flexible DOM Updates:</strong> The colon-separated format allows for different source and target selectors, enabling more flexible DOM updates.
  </li>
  <li>
    <strong>Default Behavior:</strong> If no swap strategy is specified for an out-of-band swap, it will default to the swap strategy of the triggering element, or 'innerHTML' if not specified.
  </li>
</ul>
<h2>Best Practices</h2>
<ul>
  <li>Use meaningful IDs for your source and target elements to keep your code readable and maintainable.</li>
  <li>Consider the performance implications of updating multiple elements in a single request. While it can be more efficient, it may also increase the complexity of your server response.</li>
  <li>Use out-of-band swaps judiciously. They're powerful for updating related content, but overuse can lead to complex and hard-to-maintain code.</li>
  <li>Always ensure your server responses are structured to match your <code>mx-select-oob</code> selectors to avoid unexpected behavior. </li>
</ul>
<p>By mastering out-of-band content selection and swapping, you can create more dynamic and responsive web applications with Trongate MX, updating multiple parts of your page efficiently with a single server request.</p>