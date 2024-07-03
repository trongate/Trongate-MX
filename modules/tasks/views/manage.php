<h1>Manage Tasks</h1>

<form mx-post="http://localhost/trongate_mx/tasks/submit_task"  mx-target="#result">
    <?php
    $attr['placeholder'] = 'Enter task title here...';
    echo form_input('task_title', '', $attr);
    ?>
    <button type="submit" mx-indicator=".spinner">
        Post It!
    </button>
</form>

<div class="spinner mx-indicator" style="display: none;"></div>

<div id="result"></div>


<div class="spinner mx-indicator" style="display: none;"></div>


<div id="result"></div>