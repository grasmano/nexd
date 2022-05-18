<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all()->toArray();
        return response()->json($campaigns);
    }
    public function store(Request $request)
    {
        $campaign = Campaign::create($request)([
            'title' => $request->input('title'),
            'status' => $request->input('status')
        ]);
        $campaign->save();
        return response()->json('Campaign created!');
    }
    public function show($id)
    {
        $campaign = Campaign::find($id);
        return response()->json($campaign);
    }
    public function update($id, Request $request)
    {
        $campaign = Campaign::find($id);
        $campaign->update($request->all());
        return response()->json('Campaign updated!');
    }
    public function destroy($id)
    {
        $campaign = Campaign::find($id);
        $campaign->delete();
        return response()->json('Campaign deleted!');
    }
}