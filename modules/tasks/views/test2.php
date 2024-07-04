<h1>Test 2</h1>

<p>A form that populates a result div when submitted.</p>

<form mx-get="<?= $endpoint_url ?>" mx-target="#result" mx-indicator=".spinner">
	<button type="submit">Submit Form</button>
</form>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result"></div>