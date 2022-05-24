<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'campaign_id'
    ];

    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }

    public static function findByCampaignId($campaign_id)
    {
        $creatives = Creative::where('campaign_id','=', $campaign_id)->get()->toArray();
        return $creatives;
    }

    public static function createCreative($data, $campaign_id) {
        $creative = new Creative ([
            'title' => $data['title'],
            'status' => $data['status'],
            'campaign_id' => $campaign_id
        ]);
        $creative->save();

        return 'Creative created';
    }

    public static function updateCreative($data) {
        print_r($data);
        Creative::where('id', '=', $data['id'])
            ->update(
                [
                    'id' => $data['id'],
                    'title' => $data['title'],
                    'status' => $data['status'],
                    'campaign_id' => $data['campaign_id'],
                ]
            );
        return 'Creative updated';
    }
//
//    public static function updateCampaign($data) {
//        print_r($data);
//        Campaign::where('id', $data['id'])
//            ->update(
//                [
//                    'id' => $data['id'],
//                    'title' => $data['title'],
//                    'status' => $data['status'],
//                    'start_date' => $data['start_date']
//                ]
//            );
//    }
}
