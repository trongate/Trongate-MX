<?php
class Tasks extends Trongate {

    //private $endpoint_url = BASE_URL.'tasks/list';
    //private $endpoint_url = BASE_URL.'tasks/submit_task';
    private $endpoint_url = BASE_URL.'tasks/demo';

    public function demo() {
        sleep(1);
        $data['view_file'] = 'demo_content'; // Just some page content
        $this->template('public', $data);
    }

    public function test1() {
        // Populate a 'result' div upon the pressing of a button.
        $data['view_file'] = 'test1';
        $data['endpoint_url'] = $this->endpoint_url;
        $this->template('public', $data);
    }

    public function test2() {
        // Populate a 'result' div upon the submission of a form.
        $data['view_file'] = 'test2';
        $data['endpoint_url'] = $this->endpoint_url;
        $this->template('public', $data);
    }

    public function test3() {
        // Populate a 'result' div upon the submission of a form.
        // The result div should display the posted value.
        $data['view_file'] = 'test3';
        $data['endpoint_url'] = $this->endpoint_url;
        $this->template('public', $data);
    }

    public function test4() {
        // Back to basic button example.  However, this time we will use mx-select to ONLY display one element from response.
        $data['view_file'] = 'test4';
        $data['endpoint_url'] = $this->endpoint_url;
        $this->template('public', $data);
    }

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
	    // Simulate a delay
	    sleep(1);
        http_response_code(200);
	    $task_title = post('task_title');
	    echo $task_title;
	    die();
	}

}