<h1>Testing mx-token</h1>
<p>Testing mx-token</p>
<?= json($data) ?>
<button mx-get="http://localhost/trongate_mx/tasks/read_token" 
        mx-target="#result"
        mx-indicator=".spinner" mx-token="abc">Fetch Content</button>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result"></div>


