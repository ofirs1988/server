<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\JWTException;

class CampaignController extends Controller
{

    protected $campaign;

    public function __construct()
    {

    }

    public function getCampaign(){
        $user = JWTAuth::parseToken()->authenticate()->get();
        dd($user);
    }

}
