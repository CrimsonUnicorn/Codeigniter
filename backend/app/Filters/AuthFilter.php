<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (!$authHeader) return Services::response()->setStatusCode(401)->setBody('Token required');

        $token = str_replace('Bearer ', '', $authHeader);
        try {
            $key = getenv('JWT_SECRET') ?: 'secret_key';
            JWT::decode($token, $key, ['HS256']);
        } catch (\Exception $e) {
            return Services::response()->setStatusCode(401)->setBody('Invalid Token');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing here
    }
}
