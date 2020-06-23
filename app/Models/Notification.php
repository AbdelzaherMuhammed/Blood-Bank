<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content');

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function donation()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }


    protected $hidden = [
        'pivot',
    ];
}
