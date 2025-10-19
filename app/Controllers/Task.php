<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TaskModel;
use CodeIgniter\HTTP\ResponseInterface;

class Task extends BaseController
{
    protected $taskModel;

    public function __construct(){
        $this->taskModel = new TaskModel();
        helper(['form', 'url']);
    }

    private function load_page($page, $data = array()){
         return view('templates/header')
             . view($page, $data)
             . view('templates/footer');
    }
    public function index()
    {
        $data['task'] = $this->taskModel->orderBy('id', 'DESC')->findAll();
        return $this->load_page('dashboard', $data);      
    }

    public function create(){
       return $this->load_page('task_form');
    }

    public function store(){
        $validation = $this->validate([
            'title' => 'required|min_length[3]'
        ]);

        if(!$validation){
            return $this->load_page('task_form', ['validation' => $this->validator ]);
        }

        $this->taskModel->save([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/')->with('success', "Task Added Successfully!");
    }

    public function edit($id){
        $data['task'] = $this->taskModel->find($id); 
        return $this->load_page('edit_form', $data);
    }

    public function update($id){
         $validation = $this->validate([
            'title' => 'required|min_length[3]',
            'is_completed' => 'required'
        ]);

        if(!$validation){
            return $this->load_page('edit_form', ['validation' => $this->validator ]);
        }

        $this->taskModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'is_completed' =>$this->request->getPost('is_completed')
        ]);

        return redirect()->to('/')->with('success', "Task Updated Successfully!");
    }

    public function complete($id){

        $is_completed = $this->taskModel->find($id);

        if($is_completed['is_completed'] == 0){
            $value = 1;
            $message = 'Task marked as Completed Sucessfully!';
        }else{
            $value = 0;
            $message = 'Task marked as Pending Sucessfully!';
        }

        $this->taskModel->update(
            $id,
            ['is_completed' => $value]
        );
        echo json_encode(['success' => $message]);
    }

    public function delete($id){
        $this->taskModel->delete($id);
        return redirect()->to('/')->with('success', 'Task deleted Successfully!');
    }
}
