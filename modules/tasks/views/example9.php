<div id="page-title">
    <h1>Example 9: Auto-updating Task List with Form Submission</h1>
</div>

<div id="message-area"></div>

<form mx-post="http://localhost/trongate_mx/tasks/submit_task"
      mx-target="#message-area"
      mx-indicator=".spinner"
      mx-trigger="submit">
    <label for="task_title">Task Title:</label>
    <input type="text" id="task_title" name="task_title" required>
    
    <button type="submit">Submit Task</button>
<?= form_close() ?>

<p>This example demonstrates auto-loading content and improved form submission using Trongate MX. The current list of tasks will be fetched from http://localhost/trongate_mx/tasks/list upon page load and displayed in the result div below. You can also add new tasks using the form above. If validation passes, a success message will be displayed, and the task list will be automatically refreshed.</p>

<div class="spinner mx-indicator" style="display: none;"></div>
<div id="result" 
     mx-load="http://localhost/trongate_mx/tasks/list" 
     mx-select="table" 
     mx-indicator=".spinner"
     mx-trigger="load, refreshed from:body">
</div>