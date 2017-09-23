<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Http\Response;
use Tymon\JWTAuth\JWTException;

class BasicController extends Controller
{
//    public function __construct()
//    {
//        // Apply the jwt.auth middleware to all methods in this controller
//        // except for the authenticate method. We don't want to prevent
//        // the user from retrieving their token if they don't already have it
//        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
//    }

    public function index()
    {
        // Retrieve all the users in the database and return them
        $users = User::all();
        return $users;
    }
}