<h1>Testing mx-headers</h1>
<p>Testing mx-token</p>
<?= json($data) ?>

<button mx-get="http://localhost/trongate_mx/tasks/read_headers" 
        mx-target="#result"
        mx-indicator=".spinner"
        mx-headers='[
            {"key":"City", "value":"London"},
            {"key":"Country", "value":"UK"},
            {"key":"Language", "value":"English"}
        ]'>
    Fetch Content
</button>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result"></div>