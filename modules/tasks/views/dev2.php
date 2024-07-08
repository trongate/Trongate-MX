<h1 class="text-center">Form Test</h1>
<div id="page-top"></div>
<div class="container-xs">
	<form 
	            mx-post="http://localhost/trongate_mx/tasks/submit_task" 
	            mx-target="#page-top" 
	            mx-indicator=".spinner" 
	            mx-on-success="#result" 
	            mx-trigger="submit">
	<label>Task Title</label>	
	<input type="text" name="task_title" placeholder="Enter task title here...">
	<button type="submit">Submit</button>
	<?= form_close() ?>	
</div>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result" class="blink mt-3 text-center" 
     mx-get="http://localhost/trongate_mx/tasks/list" 
     mx-trigger="load"
     mx-select="table">...loading</div>
