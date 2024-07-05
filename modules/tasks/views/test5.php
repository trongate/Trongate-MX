<h1>Basic Crud App</h1>
<h2>The first CRUD app ever that's made with Trongate MX</h2>
<div id="submission-result"></div>
<div class="container-xs">
	
	<form id="task-form" 
	      mx-post="<?= BASE_URL ?>tasks/submit_task" 
	      mx-select="#response"
	      mx-target="#submission-result"
	      mx-select-oob="table:#task-list"
	      mx-indicator=".spinner">
	<label>Task Title</label>
	<input name="task_title" type="text" value="" placeholder="Enter task title here..." required>
	<button type="submit">Submit Task</button>
	<?= form_close() ?>

	<div class="spinner mx-indicator" style="display: none"></div>

	<div id="task-list" class="mt-3" mx-get="<?= BASE_URL ?>tasks/list" mx-trigger="load" mx-select="table" mx-indicator=".spinner"></div>

</div>

<style>
.fa-trash {
	color: #990000;
	cursor: pointer;
}

tr button {
	margin-top: 0;
}
</style>

