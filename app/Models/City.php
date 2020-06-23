<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name' ,'governorate_id');

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function donations()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }

}
