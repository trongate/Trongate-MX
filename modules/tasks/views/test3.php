<h1>Test 3</h1>

<p>A form that populates a result div when submitted.   The form should submit a post request and the div should contain the posted value.</p>

<form mx-post="<?= $endpoint_url ?>" mx-target="#result" mx-indicator=".spinner">
	<input type="text" name="task_title" value="" placeholder="Enter task title here..." required>
	<button type="submit">Submit Form</button>
</form>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result"></div>

<style>
	#result {
		margin-top: 33px;
	}
</style>