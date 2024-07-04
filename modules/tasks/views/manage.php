<h1>Manage Tasks</h1>

<form mx-post="http://localhost/trongate_mx/tasks/submit_task" mx-trigger="load" mx-target="#result" mx-indicator=".spinner">
    <?php
    $attr['placeholder'] = 'Enter task title here...';
    echo form_input('task_title', 'New Task', $attr);
    ?>
    <button type="submit">
        Post It!
    </button>
</form>

<div class="spinner mx-indicator" style="display: none;"></div>

<div id="result"></div>

