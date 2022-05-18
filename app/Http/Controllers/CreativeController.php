<?php

namespace App\Http\Controllers;

use App\Models\Creative;
use Illuminate\Http\Request;

class CreativeController extends Controller
{
    public function index()
    {
        $creatives = Creative::all()->toArray();
        return response()->json($creatives);
    }
    public function store(Request $request)
    {
        $creative = Creative::create($request)([
            'title' => $request->input('title'),
            'status' => $request->input('status')
        ]);
        $creative->save();
        return response()->json('Creative created!');
    }
    public function show($id)
    {
        $creative = Creative::find($id);
        return response()->json($creative);
    }
    public function update($id, Request $request)
    {
        $creative = Creative::find($id);
        $creative->update($request->all());
        return response()->json('Creative updated!');
    }
    public function destroy($id)
    {
        $creative = Creative::find($id);
        $creative->delete();
        return response()->json('Creative deleted!');
    }
}