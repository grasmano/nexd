<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Creative;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all()->toArray();
        $items = [];
        foreach ($campaigns as $campaign) {

            $campaign['creatives'] = Creative::findByCampaignId($campaign['id']);
            $items[] = $campaign;

        }
        return response()->json($items);
    }

    public function store(Request $request)
    {

//        $campaigns = Campaign::all()->toArray();

        $ids = [];

        foreach (Campaign::all()->toArray() as $dbCampaign) {
            $ids[] = $dbCampaign['id'];
        }
        foreach ($request['campaigns'] as $reqCampaign) {
            if (($key = array_search($reqCampaign['id'], $ids)) !== false) {
                unset($ids[$key]);
            }
        }

        foreach ($ids as $id) {
            Campaign::deleteCampaign($id);
        }

        foreach ($request['campaigns'] as $req) {
            if ($req['id'] &&  $req['id'] !== null) {
                Campaign::updateCampaign($req);
                $campaignId = $req['id'];
            }
            else {
                $campaignId = Campaign::createCampaign($req);
            }

            foreach ($req['creatives'] as $creative) {
                if ($creative['id'] != null) {
                    Creative::updateCreative($creative);
                } else {
                    Creative::createCreative($creative, $campaignId);
                }
            }

        }
        return response()->json('ok');
    }

}