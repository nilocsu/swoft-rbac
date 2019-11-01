<?php


namespace App\Admin\Common\Service;

use App\Admin\Exception\AuthorizationException;
use Firebase\JWT\JWT;

class JwtService
{
    public static function encode(array $data, $role = 'admin')
    {
        //jwt 荷载中的过期时间   按role角色决定
        ($role == 'admin') ? $exp = \config('jwt.systemExp') : $exp = config('jwt.userExp');
        $token = [
            'iss'  => \config('jwt.iss'),    //签发者
            'aud'  => $data['username'],     //接收jwt的一方
            'iat'  => time(),                         //签发时间
            'exp'  => time() + $exp,                  //jwt的过期时间，过期时间必须要大于签发时间
            'nbf'  => time(),                         //该时间前不接受处理该token
            'data' => $data,
        ];
        return JWT::encode($token, \config('jwt.privateKey'), \config('jwt.type'));
    }

    public static function decode()
    {
        $token = context()->getRequest()->getHeaderLine('Authorization');
        $auth  = JWT::decode($token, \config('jwt.publicKey'), ['type' => \config('jwt.type')]);
        return ((array)$auth)['data'];
    }
}