<?php
namespace App\Interfaces\Campaign;

interface CampaignInterface {
    public function createCampaign($request);
    public function setCampaign($id);
    public function getCampaign($request);
    public function getCampaigns();

}