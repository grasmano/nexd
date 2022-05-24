<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'start_date',
    ];

    public function creatives()
    {
        return $this->hasMany(Creative::class);
    }

    public static function createCampaign($data)
    {
        $campaign = new Campaign ([
            'title' => $data['title'],
            'status' => $data['status'],
            'start_date' => $data['start_date']
        ]);
        $campaign->save();
        return $campaign['id'];
    }

    public static function updateCampaign($data)
    {
        Campaign::where('id', $data['id'])
            ->update(
                [
                    'id' => $data['id'],
                    'title' => $data['title'],
                    'status' => $data['status'],
                    'start_date' => $data['start_date']
                ]
            );
    }

    public static function deleteCampaign($id)
    {
        Campaign::where('id', $id)->delete();
    }

}
