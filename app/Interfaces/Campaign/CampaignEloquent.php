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

        $campaign->title = $request->name;
        $campaign->slug = isset($request->slug) ? $request->slug : null;
        $campaign->body = isset($request->description) ? $request->description : null;
        $campaign->published = isset($request->published) ? $request->published : 0;
        $campaign->published = isset($request->published) ? $request->published : 0;
        $campaign->uid = $user->id;
        $campaign->cid = $request->cid;
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

}