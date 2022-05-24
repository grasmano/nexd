<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignCreatives;
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

        $campaigns = Campaign::all()->toArray();


//        print_r($request['campaigns']);

        $ids = [];

        foreach ($campaigns as $dbCampaign) {
            foreach ($request['campaigns'] as $reqCampaign) {
                if ($dbCampaign['id'] != $reqCampaign['id']) {
                    $ids[] = $dbCampaign['id'];
                }
            }

//            if (array_key_exists($campaign['id'],$request['campaigns'])) {
//                $ids[] = $campaign['id'];
//            }
//            if (($key = array_search($campaign['id'], $request['campaigns'])) !== false) {
//                unset($messages[$key]);
//                $ids[] = $campaign['id'];
//            }
        }

//        print_r('IDS:');
//        print_r($ids);


        foreach ($ids as $id) {
            Campaign::deleteCampaign($id);
        }

//        if (($key = array_search($id, $request['campaigns'])) !== null) {
//            unset($campaigns[$key]);

        //////////////

        foreach ($request['campaigns'] as $req) {

//            $campaignValidator = Validator::make(
//                $req,
//                [
//                    "Campaign title" => ["required"],
//                    "Campaign status" => ["required"]
//                ]
//            );
//            if ($campaignValidator->fails()) {
//                return [
//                    'status' => false,
//                    'errors' => $campaignValidator->messages()
//                ];
//            }

            if ($req['id'] != null) {
                Campaign::updateCampaign($req);
                $campaignId = $req['id'];
            } else {
                $campaignId =  Campaign::createCampaign($req);
            }
            if ($campaignId) {
                foreach ($req['creatives'] as $creative) {

//                    $creativeValidator = Validator::make(
//                        $creative,
//                        [
//                            "Creative title" => ["required"],
//                            "Creative status" => ["required"]
//                        ]
//                    );
//                    if ($creativeValidator->fails()) {
//                        return [
//                            'status' => false,
//                            'errors' => $creativeValidator->messages()
//                        ];
//                    }

                    if ($creative['id'] != null) {
                        Creative::updateCreative($creative);
                    } else {
                        Creative::createCreative($creative, $campaignId );
                    }
                }
            }

        }
        return response()->json('ok');
//        return [
//            'status' => true,
//            'info' => 'ok'
//        ];

        /////////////////

//        $ids = array_map(fn($item) => $item['id'], $campaigns );
//        foreach ($request as $req) {
//            if ()
//        }
//
//        if (($key = array_search($del_val, $messages)) !== false) {
//            unset($messages[$key]);
//        }
//
//        if (($key = array_search($id, $campaigns)) !== null) {
//        unset($campaigns[$key]);
    }

//        return response()->json($items);

//        $campaign = Campaign::create($request)([
//            'title' => $request->input('title'),
//            'status' => $request->input('status')
//        ]);
//        $campaign->save();
//        return response()->json('Campaign created!');
//    }
}