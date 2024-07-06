<h1>Loading Indicators</h1>
<p>Trongate MX provides a simple yet powerful way to display loading indicators during asynchronous operations. This feature enhances user experience by providing visual feedback when content is being loaded or forms are being submitted.</p>
<h2>Using the mx-indicator Attribute</h2>
<p>The <code>mx-indicator</code> attribute allows you to specify which element should be shown as a loading indicator during an AJAX request. This attribute can be added to any element that triggers a request. </p>
<pre>
	<code>&lt;button mx-get="/api/data" mx-target="#result" mx-indicator="#loading"&gt;Load Data&lt;/button&gt; &lt;div id="loading" class="spinner mx-indicator" style="display: none"&gt;&lt;/div&gt; &lt;div id="result"&gt;&lt;/div&gt;</code>
</pre>
<p>In this example, the div with id "loading" will be shown while the request is in progress.</p>
<h2>Built-in Spinner</h2>
<p>Trongate CSS, which comes with the Trongate framework, includes a built-in spinner class. You can easily create a loading indicator by adding the <code>spinner</code> class to an element: </p>
<pre>
	<code>&lt;div class="spinner mx-indicator" style="display: none"&gt;&lt;/div&gt;</code>
</pre>
<p>This will create a beautiful spinning icon that can be used as a loading indicator.</p>
<h2>Custom Indicators</h2>
<p>While the built-in spinner is convenient, you're not limited to using it. You can use any element as a loading indicator, including custom HTML, images, or GIFs. Simply apply the necessary classes and reference it in the <code>mx-indicator</code> attribute: </p>
<pre>
	<code>&lt;button mx-post="/api/submit" mx-indicator="#custom-loader"&gt;Submit&lt;/button&gt; &lt;div id="custom-loader" class="mx-indicator" style="display: none"&gt; &lt;img src="path/to/your/loader.gif" alt="Loading..."&gt; &lt;/div&gt;</code>
</pre>
<h2>How It Works</h2>
<p>Trongate MX manages loading indicators through CSS classes:</p>
<ul>
  <li>
    <code>mx-indicator</code>: Applied to the element when it's actively showing as a loader.
  </li>
  <li>
    <code>mx-indicator-hidden</code>: Applied to hide the loader when it's not active.
  </li>
</ul>
<p>The JavaScript functions <code>activateLoader()</code> and <code>hideLoader()</code> handle the switching between these classes. </p>
<h2>Automatic Management</h2>
<p>Trongate MX automatically manages the visibility of loading indicators:</p>
<ul>
  <li>When a request starts, the indicator is shown by adding the <code>mx-indicator</code> class and removing <code>mx-indicator-hidden</code>. </li>
  <li>When a request completes, the indicator is hidden by removing the <code>mx-indicator</code> class and adding <code>mx-indicator-hidden</code>. </li>
</ul>
<h2>Initial Page Load</h2>
<p>On initial page load, Trongate MX ensures all indicators are hidden:</p>
<pre>
	<code>document.addEventListener('DOMContentLoaded', function() { document.querySelectorAll('.mx-indicator').forEach(element => { hideLoader(element); element.style.display = ''; // Remove inline style "display: none;" }); // ... other initialization code });</code>
</pre>
<h2>Best Practices</h2>
<ul>
  <li>Use meaningful IDs for your loading indicators to make your code more readable.</li>
  <li>Consider using different indicators for different types of operations (e.g., loading data vs. submitting forms).</li>
  <li>Ensure your loading indicators are accessible, including appropriate ARIA attributes if necessary.</li>
  <li>Test your loading indicators with various network conditions to ensure a good user experience.</li>
</ul>
<p>By effectively using loading indicators, you can significantly improve the perceived performance and user experience of your Trongate MX applications.</p>