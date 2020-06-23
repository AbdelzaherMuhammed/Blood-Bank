<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;
    protected $guard=['api', 'client-web'];
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'name', 'email', 'password', 'date_of_birth', 'city_id' , 'last_donation_date', 'blood_type_id', 'pin_code');


    public function BloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donations()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'clientable');
    }

    public function notifications()
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable');
    }

    public function BloodTypes()
    {
        return $this->morphedByMany('App\Models\BloodType', 'clientable');
    }

    public function governorates()
    {
        return $this->morphedByMany('App\Models\Governorate', 'clientable');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }




    protected $hidden = [
        'password', 'api_token', 'pivot'
    ];
}
