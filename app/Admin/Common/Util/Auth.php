<?php


namespace App\Admin\Common\Util;


use App\Model\Entity\TUser;
use Swoft\Context\Context;

class Auth
{
    /**
     * @return TUser
     */
    public static function admin(){
        $admin = Context::get()->getRequest()->admin;
        $user = TUser::new($admin);
        return $user;
    }
}