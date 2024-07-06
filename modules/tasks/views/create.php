<h1>Create Task</h1>
<?php
echo form_open('tasks/submit');
echo form_label('Task Title');
echo form_input('task_title', '');
echo form_submit('submit', 'Submit');
echo form_close();