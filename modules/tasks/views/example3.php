<h1>Example 3: Form Submission</h1>
<p>This example demonstrates a form submission using Trongate MX. When you enter a task title and submit the form, it will send a POST request to http://localhost/trongate_mx/tasks/submit_task. The response will be displayed in the result div.</p>

<form mx-post="http://localhost/trongate_mx/tasks/submit_task"
      mx-target="#result"
      mx-indicator=".spinner">
    <label>Task Title:</label>
    <input type="text" name="task_title" required>
    <button type="submit">Submit Task</button>
</form>

<div class="spinner mx-indicator" style="display: none"></div>

<div id="result" class="mt-3"></div>