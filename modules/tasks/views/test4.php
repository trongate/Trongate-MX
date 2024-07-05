<h1>Test 4</h1>

<p>A simple button that, when clicked, populates a 'result' div.  The result div should ONLY contain the content specified inside mx-select</p>

<div class="mb-3"><button mx-select="table" mx-get="<?= $endpoint_url ?>" mx-swap="textContent" mx-target="#result" mx-indicator=".spinner">Click Me</button></div>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result">
	<p>First</p>
	<p>Second</p>
	<p>Third</p>
</div>

<style>
#result {
	background-color: cyan;
	border: 3px red dashed;
	min-height: 300px;
	padding: 24px;
}
</style>