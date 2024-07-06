<h1>HTTP Methods in Trongate MX</h1>
<p>Trongate MX provides a set of attributes that allow you to make various types of HTTP requests directly from your HTML elements. These attributes correspond to different HTTP methods and enable you to create dynamic, interactive web applications with minimal JavaScript.</p>
<h2>Available HTTP Method Attributes</h2>
<p>Trongate MX supports the following HTTP method attributes:</p>
<ul>
  <li>
    <code>mx-get</code>: For making GET requests
  </li>
  <li>
    <code>mx-post</code>: For making POST requests
  </li>
  <li>
    <code>mx-put</code>: For making PUT requests
  </li>
  <li>
    <code>mx-patch</code>: For making PATCH requests
  </li>
  <li>
    <code>mx-delete</code>: For making DELETE requests
  </li>
</ul>
<h2>How to Use HTTP Method Attributes</h2>
<p>To use these attributes, simply add them to your HTML elements with the URL you want to request as the value. For example:</p>
<pre>
	<code>&lt;button mx-get="&lt;?= BASE_URL ?&gt;api/get_data"&gt;Get Data&lt;/button&gt;</code>
</pre>
<h2>Handling Different Request Types</h2>
<h3>GET Requests</h3>
<p>GET requests are typically used to retrieve data. They are handled by the <code>invokeHttpRequest</code> function: </p>
<pre>
	<code>function invokeHttpRequest(element, triggerEvent, httpMethodAttribute) { const targetUrl = element.getAttribute(httpMethodAttribute); const requestType = httpMethodAttribute.replace('mx-', '').toUpperCase(); attemptActivateLoader(element); const http = new XMLHttpRequest(); http.open(requestType, targetUrl); http.setRequestHeader('Accept', 'text/html'); http.send(); http.onload = function() { attemptHideLoader(element); handleHttpResponse(http, element); }; }</code>
</pre>
<h3>POST, PUT, and PATCH Requests</h3>
<p>These requests typically involve sending data to the server. They are handled by the <code>invokeFormPost</code> function: </p>
<pre>
	<code>function invokeFormPost(element, triggerEvent, httpMethodAttribute) { const targetUrl = element.getAttribute(httpMethodAttribute); const requestType = httpMethodAttribute.replace('mx-', '').toUpperCase(); attemptActivateLoader(element); const containingForm = element.closest('form'); const formData = new FormData(containingForm); const http = new XMLHttpRequest(); http.open('POST', targetUrl); http.send(formData); http.onload = function() { attemptHideLoader(element); containingForm.reset(); handleHttpResponse(http, element); }; }</code>
</pre>
<h2>Form Submissions</h2>
<p>For form submissions, Trongate MX uses the <code>mxSubmitForm</code> function: </p>
<pre>
	<code>function mxSubmitForm(element, triggerEvent, httpMethodAttribute) { const containingForm = element.closest('form'); const submitButton = element.querySelector('button[type="submit"]'); if (submitButton) { submitButton.disabled = true; // Disable submit button const requiresDataAttributes = ['mx-post','mx-put','mx-patch']; if (requiresDataAttributes.includes(httpMethodAttribute)) { invokeFormPost(element, triggerEvent, httpMethodAttribute); } else { invokeHttpRequest(element, triggerEvent, httpMethodAttribute); } } else { console.log('no submit button found'); } }</code>
</pre>
<h2>Handling Responses</h2>
<p>After a request is made, the response is handled by the <code>handleHttpResponse</code> function. This function checks if the request was successful and updates the DOM accordingly: </p>
<pre>
	<code>function handleHttpResponse(http, element) { if (http.status >= 200 && http.status < 300) { const mxTargetStr = getAttributeValue(element,'mx-target'); if (mxTargetStr) { const targetEl = document.querySelector(mxTargetStr); if(targetEl) { populateTargetEl(targetEl, http, element); } } // ... (additional success handling) } else { console.error('Request failed with status:', http.status); // ... (error handling) } }
	</code>
</pre>
<h2>Examples</h2>
<h3>GET Request</h3>
<pre>
	<code>&lt;button mx-get="&lt;?= BASE_URL ?&gt;api/get_data" mx-target="#result"&gt;Get Data&lt;/button&gt; &lt;div id="result"&gt;&lt;/div&gt;</code>
</pre>
<h3>POST Request (Form Submission)</h3>
<pre>
	<code>&lt;form mx-post="&lt;?= BASE_URL ?&gt;api/submit_data" mx-target="#result"&gt; &lt;input type="text" name="data"&gt; &lt;button type="submit"&gt;Submit&lt;/button&gt; &lt;/form&gt; &lt;div id="result"&gt;&lt;/div&gt;</code>
</pre>
<h2>Best Practices</h2>
<ul>
  <li>Use appropriate HTTP methods for different operations (GET for retrieving data, POST for submitting data, etc.)</li>
  <li>Always provide a target for the response using the <code>mx-target</code> attribute </li>
  <li>Handle both success and error cases in your server-side code and client-side logic</li>
  <li>Use loaders ( <code>mx-indicator</code>) to provide visual feedback during requests </li>
</ul>
<h2>Notes</h2>
<ul>
  <li>The <code>mx-get</code> attribute can be used on any element, while <code>mx-post</code>, <code>mx-put</code>, and <code>mx-patch</code> are typically used with form elements </li>
  <li>For security reasons, browsers may not allow PUT, PATCH, or DELETE requests directly. In such cases, you may need to use POST with an additional parameter indicating the intended method</li>
  <li>Always validate and sanitize data on the server-side, regardless of the HTTP method used</li>
</ul>
<p>By mastering these HTTP method attributes, you can create rich, interactive web applications with Trongate MX, handling various types of server interactions with ease.</p>