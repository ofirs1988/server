<?php
namespace App\Interfaces\Campaign;


use App\Campaign;
use JWTAuth;
use Tymon\JWTAuth\JWTException;

class CampaignEloquent implements \App\Interfaces\Campaign\CampaignInterface {

    public function createCampaign($request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->body = isset($request->description) ? $request->description : null;
        $campaign->published = isset($request->published) ? $request->published : 0;
        $campaign->uid = $user->id;
        $campaign->cid = $request->cid;
        if($campaign->save()){
            return true;
        }
        return false;


    }

    public function getCampaign($request)
    {
        // TODO: Implement getCampaign() method.
    }

    public function getCampaigns()
    {
        // TODO: Implement getCampaigns() method.
    }

    public function setCampaign($id)
    {
        // TODO: Implement setCampaign() method.
    }

    public function deleteCampaigns()
    {
        // TODO: Implement deleteCampaigns() method.
    }

}