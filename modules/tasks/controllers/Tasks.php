<?php
class Tasks extends Trongate {

    //private $endpoint_url = BASE_URL.'tasks/list';
    //private $endpoint_url = BASE_URL.'tasks/submit_task';
    private $endpoint_url = BASE_URL.'tasks/demo';

    public function demo() {
        //sleep(1);
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
        // Now also have mx-swap working here!
        $data['view_file'] = 'test4';
        $data['endpoint_url'] = $this->endpoint_url;
        $this->template('public', $data);
    }

    public function test4b() {
        // Same as test4() but with mx-select-oob working.
        $data['view_file'] = 'test4b';
        $data['endpoint_url'] = $this->endpoint_url;
        $this->template('public', $data);
    }

    public function test4c() {
        // Same as test4b() but with mx-swap-oob working.
        $data['view_file'] = 'test4bc';
        $data['endpoint_url'] = $this->endpoint_url;
        $this->template('public', $data);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function test5() {
        // Real CRUD example that adds items and uses mx-select to display the list!
        $data['rows'] = $this->model->get('id');
        $data['view_file'] = 'test5';
        $data['endpoint_url'] = '';
        $this->template('public', $data);
    }

    public function test6() {
        // Same as test 5 but with delete buttons.
    }

    public function test7() {
        // BUILD THE NET NINJA APP - as demonstrated here: https://youtu.be/Yr-ubS0H7z4?si=KDVs4rvU9_JHKZdf&t=280
    }

    public function test8() {
        // Build and test the 'mx-load' feature.
    }

    public function test9() {
        // Post values from NON FORM elements.
    }

    public function test10() {
        // HANDLE FORM VALIDATION ERRORS
    }

    // THEN:  Get the button replacing thing working.   Get .innerHTML etc working (hx-swap)
    /*
value,description
innerHTML,the default, puts the content inside the target element
outerHTML,replaces the entire target element with the returned content
afterbegin,prepends the content before the first child inside the target
beforebegin,prepends the content before the target in the target's parent element
beforeend,appends the content after the last child inside the target
afterend,appends the content after the target in the target's parent element
delete,deletes the target element regardless of the response
none,does not append content from response (Out of Band Swaps and Response Headers will still be processed)
    */
    // ...advanced triggers (e.g., hx-trigger="keyup changed delay:500ms")


    function manage() {
    	$data['view_file'] = 'manage';
    	$this->template('public', $data);
    }

    public function populate_element_example() {
        $data['view_file'] = 'populate_element_example';
        $this->template('public', $data);
    }

    function list() {
        $data['rows'] = $this->model->get('id');
        $data['view_file'] = 'task_list';
    	$data['view_module'] = 'tasks';
    	$this->template('public', $data);
    }

    function delete_task() {
        $update_id = segment(3, 'int');


        $this->model->delete($update_id);

            $rows = $this->model->get('id');
            echo '<div id="updated-list">';
            echo '<ul>';
            foreach($rows as $row) {
                echo '<li>'.$row->task_title.' <i class=\'fa fa-trash\'></i></li>';
            }
            echo '</ul></div>';


    }

	function submit_task() {
	    // Simulate a delay       
        // sleep(2);
        $this->validation->set_rules('task_title', 'task_title', 'required|min_length[3]');
        $result = $this->validation->run();

        if ($result === true) {
            
            http_response_code(200);
            $data['task_title'] = post('task_title', true);
            $this->model->insert($data, 'tasks');

            echo '<div id="response" style="color: green">Here is your response</div>';

            $this->list();

        } else {
            validation_errors(422);
        }

	}













}