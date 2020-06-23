<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('about_app', 'fb_link', 'tw_link', 'inst_link', 'whatsapp' , 'youtube_link' ,
        'phone' , 'email' , 'small_disc' , 'long_disc' , 'google_play_link' , 'app_store_link');

}
