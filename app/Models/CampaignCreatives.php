<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignCreatives extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'creative_id'
    ];

}
