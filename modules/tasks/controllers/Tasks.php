<?php
Class Tasks extends Trongate {

    public function dev6() {
        $this->module('trongate_security');
        $data['token'] = $this->trongate_security->_make_sure_allowed();
        $data['view_file'] = 'dev6';
        $this->template('public', $data);
    }

    public function submit_delete() {
    	$update_id = segment(3, 'int');
    	$this->model->delete($update_id);
    }

    public function submit_new_task() {
    	$data['task_title'] = post('task_title', true);
    	$this->model->insert($data);
    	echo '<p style="color: green">The task record was successfully created.</p>';
    }

    public function create() {
    	$data['view_file'] = 'create_task';
    	$this->template('public', $data);
    }

    public function list() {
    	$data['rows'] = $this->model->get('id');
    	$data['view_file'] = 'list';
    	$this->template('admin', $data);
    }

    public function resquence() {
    	$this->model->resequence_ids('tasks');
    	redirect('tasks/dev6');
    }

	}