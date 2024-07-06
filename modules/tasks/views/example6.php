<div id="page-title">
    <h1>Example 6: Simple Form with Validation</h1>
</div>

<div id="message-area"></div>

<p>This example demonstrates a simple form submission using Trongate MX. The form will be submitted to http://localhost/trongate_mx/tasks/submit_task. If validation passes, a success message will be displayed. If not, validation errors will be shown.</p>

<form mx-post="http://localhost/trongate_mx/tasks/submit_task"
      mx-target="#message-area"
      mx-indicator=".spinner">
    <label for="task_title">Task Title:</label>
    <input type="text" id="task_title" name="task_title" required>
    
    <button type="submit">Submit Task</button>
<?= form_close() ?>

<div class="spinner mx-indicator" style="display: none;"></div>