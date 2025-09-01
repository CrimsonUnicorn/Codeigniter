<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TeacherModel;

class Teacher extends ResourceController
{
    protected $modelName = 'App\Models\TeacherModel';
    protected $format = 'json';

    public function create()
    {
        $data = $this->request->getJSON();
        $this->model->insert($data);
        return $this->respond(['message' => 'Teacher added successfully']);
    }

    public function index()
    {
        $teachers = $this->model->findAll();
        return $this->respond($teachers);
    }
}
