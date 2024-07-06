<h1>Quick Start</h1>
<p>This guide will help you get up and running with Trongate MX quickly. Before you begin, ensure you have the latest version of the Trongate PHP framework installed and operational.</p>

<h2>Step 1: Include Trongate MX</h2>
<p>Trongate MX is pre-installed in every Trongate application. To use it, open your HTML template and add the following line just before the closing <code>&lt;/body&gt;</code> tag:</p>
<pre><code>&lt;script src="&lt;?= BASE_URL ?&gt;js/trongate-mx.js"&gt;&lt;/script&gt;</code></pre>

<h2>Step 2: Create a Basic Example</h2>
<p>Let's create a simple example that demonstrates the power of Trongate MX. We'll make a button that, when clicked, fetches information from another URL and populates a result div.</p>
<p>Here's the HTML for our example:</p>
<pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Trongate MX Quick Start&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Trongate MX Demo&lt;/h1&gt;
    &lt;button mx-get="&lt;?= BASE_URL ?&gt;api/get_message" mx-target="#result"&gt;Get Message&lt;/button&gt;
    &lt;div id="result"&gt;&lt;/div&gt;
    &lt;script src="&lt;?= BASE_URL ?&gt;js/trongate-mx.js"&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>

<p>In this example:</p>
<ul>
    <li>We have a button with two Trongate MX attributes:
        <ul>
            <li><code>mx-get</code>: Specifies the URL to fetch data from when the button is clicked.</li>
            <li><code>mx-target</code>: Specifies where to put the response (in this case, in the element with id "result").</li>
        </ul>
    </li>
    <li>We have a div with id "result" where the fetched content will be placed.</li>
</ul>

<h2>Step 3: Create the API Endpoint</h2>
<p>Now, let's create a simple API endpoint that our button will call. Create a new controller named <code>Api.php</code> in your Trongate application's modules directory with the following content:</p>
<pre><code>&lt;?php
class Api extends Trongate {
    function get_message() {
        $data['message'] = "Hello from Trongate MX!";
        echo json_encode($data);
    }
}
</code></pre>

<h2>Step 4: Test Your Application</h2>
<p>Now, when you load your page and click the "Get Message" button, Trongate MX will:</p>
<ol>
    <li>Make a GET request to the specified URL (<code>&lt;?= BASE_URL ?&gt;api/get_message</code>).</li>
    <li>Receive the JSON response.</li>
    <li>Insert the response into the div with id "result".</li>
</ol>
<p>You should see "Hello from Trongate MX!" appear in the result div when you click the button.</p>

<h2>What's Next?</h2>
<p>This is just a simple example of what Trongate MX can do. Explore the other Trongate MX attributes to add more dynamic behaviors to your web pages without writing any JavaScript code!</p>
