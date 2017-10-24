<?php

namespace App\Http\Controllers;

use App\Interfaces\Campaign\CampaignInterface AS Campaign;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\JWTException;

class CampaignController extends Controller
{

    protected $campaignObject;

    public function __construct(Campaign $u)
    {
        $this->campaignObject = $u;
    }

    public function create(Request $request){
        return response()->json(array('success' => $this->campaignObject->createCampaign($request)),200);
    }


    public function getCampaign(){
        $user = JWTAuth::parseToken()->authenticate()->get();
        dd($user);
    }

}
