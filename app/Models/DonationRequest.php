<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_phone', 'patient_age', 'bags_num', 'hospital_name', 'hospital_address', 'details',
        'lattitude', 'longitude','city_id' , 'client_id' , 'blood_type_id');

    public function BloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

}
