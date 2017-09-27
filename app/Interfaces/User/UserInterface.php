<?php
namespace App\Interfaces\User;

interface UserInterface {

    public function setActiveUser($id,$active);
    public function getToken($length);
    public function setUser($request);
    public function UpdateUserLogin();
    public function setRole($user,$role);
    public function isAuthorized($param);
    public function BaseAuthLogin($request,$param);
}