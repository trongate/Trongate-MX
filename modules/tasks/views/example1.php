<h1>Example 1</h1>
<p>When the button is clicked, a spinner appears while content is fetched from http://localhost/trongate_mx/tasks/list. The fetched content is then displayed in the result div.</p>

<button mx-get="http://localhost/trongate_mx/tasks/list" 
        mx-target="#result"
        mx-indicator=".spinner">Fetch Content</button>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result"></div>