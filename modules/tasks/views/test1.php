<h1>Test 1</h1>

<p>A simple button that, when clicked, populates a 'result' div.</p>


<div><button mx-get="<?= $endpoint_url ?>" mx-target="#result" mx-indicator=".spinner">Click Me</button></div>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result"></div>