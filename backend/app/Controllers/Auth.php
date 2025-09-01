<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT; // Install firebase/php-jwt
use App\Models\AuthUserModel;

class Auth extends ResourceController
{
    protected $modelName = 'App\Models\AuthUserModel';
    protected $format = 'json';

    public function register()
    {
        $data = $this->request->getJSON();
        $data->password = password_hash($data->password, PASSWORD_DEFAULT);
        $this->model->insert($data);
        return $this->respond(['message' => 'User registered successfully']);
    }

    public function login()
    {
        $data = $this->request->getJSON();
        $user = $this->model->where('email', $data->email)->first();

        if (!$user || !password_verify($data->password, $user['password'])) {
            return $this->fail('Invalid credentials', 401);
        }

        $key = getenv('JWT_SECRET') ?: 'secret_key';
        $payload = [
            'id' => $user['id'],
            'email' => $user['email'],
            'iat' => time(),
            'exp' => time() + 3600
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');

        return $this->respond(['token' => $jwt]);
    }
    public function index()
    {
         $users = $this->model->findAll(); // fetch all users
         return $this->respond($users);     // return as JSON
    }

}
