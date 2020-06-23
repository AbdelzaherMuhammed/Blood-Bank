<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');


    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

}
