<form mx-post="<?= BASE_URL ?>tasks/submit_new_task" mx-target="#page-upper" mx-on-success="#result">
<label>Task Title</label>
<input type="text" name="task_title" placeholder="Enter task title here..." autocomplete="off">
<button type="submit">Submit</button>
<?php
if (segment(3) > 0) {
	echo '<button type="button" class="alt" onclick="closeModal()">Close</button>';
}
?>
</form>