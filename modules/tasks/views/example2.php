<h1>Example 2</h1>
<p>When the button is clicked, a spinner appears while content is fetched from http://localhost/trongate_mx/tasks/list. The first table element from the response is then displayed in the result div, which has a top margin of 3em.</p>

<button mx-get="http://localhost/trongate_mx/tasks/list" 
        mx-target="#result"
        mx-select="table"
        mx-indicator=".spinner">Fetch Content</button>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result" class="mt-3"></div>