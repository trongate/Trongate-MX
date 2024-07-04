<?php
class Tasks extends Trongate {

    function manage() {
    	$data['view_file'] = 'manage';
    	$this->template('public', $data);
    }

    public function populate_element_example() {
        $data['view_file'] = 'populate_element_example';
        $this->template('public', $data);
    }

    function list() {
    	$data['view_module'] = 'tasks';
    	$this->view('list', $data);
    }

	function submit_task() {
	    // Simulate a delay of 2 seconds
	    sleep(1);
        http_response_code(200);
	    $task_title = post('task_title');
	    echo $task_title;
	    die();
	}

}