<h1><code>mx-select-oob</code></h1>

<p>The <code>mx-select-oob</code> attribute allows you to select content from a response to be swapped in via an out-of-band swap. This attribute provides more precise control over both the source of the content in the response and the target in the current DOM where it should be inserted.</p>

<p>The value of this attribute is a comma-separated list of selector pairs. Each pair consists of two parts separated by a colon (:). The first part is the selector for the source content in the response, and the second part is the selector for the target element in the current DOM.</p>

<p>This attribute is often used in conjunction with <code>mx-select</code>.</p>

<p>Here's an example that demonstrates the use of <code>mx-select-oob</code>:</p>

<pre><code class="language-html">
<div>
   <div id="alert"></div>
   <div id="sidebar"></div>
    <button mx-get="/info" 
            mx-select="#info-details" 
            mx-swap="outerHTML"
            mx-select-oob="#alert-content:#alert, #sidebar-content:#sidebar">
        Get Info!
    </button>
</div>
</code></pre>

<p>This button will issue a <code>GET</code> request to <code>/info</code> and then:</p>
<ol>
  <li>Select the element with the id <code>info-details</code> from the response and use it to replace the entire button in the DOM.</li>
  <li>Select the element with the id <code>alert-content</code> from the response and swap it into the element with id <code>alert</code> in the current DOM.</li>
  <li>Select the element with the id <code>sidebar-content</code> from the response and swap it into the element with id <code>sidebar</code> in the current DOM.</li>
</ol>

<p>Each value in the comma-separated list can specify a different swap strategy by adding it after the target selector, separated by another colon. For example:</p>

<pre><code class="language-html">
<div>
   <div id="alert"></div>
   <div id="sidebar"></div>
    <button mx-get="/info"
            mx-select="#info-details"
            mx-swap="outerHTML"
            mx-select-oob="#alert-content:#alert:afterbegin, #sidebar-content:#sidebar:innerHTML">
        Get Info!
    </button>
</div>
</code></pre>

<p>In this example, the alert content will be prepended to the alert div, while the sidebar content will replace the inner HTML of the sidebar div.</p>

<h2>Notes</h2>
<ul>
  <li><code>mx-select-oob</code> is inherited and can be placed on a parent element.</li>
  <li>Unlike HTMX's <code>hx-select-oob</code>, <code>mx-select-oob</code> requires explicit specification of both source and target selectors, providing more precise control over out-of-band swaps.</li>
  <li>The colon-separated format allows for different source and target selectors, enabling more flexible DOM updates.</li>
  <li>If no swap strategy is specified for an out-of-band swap, it will default to the swap strategy of the triggering element, or 'innerHTML' if not specified.</li>
</ul>