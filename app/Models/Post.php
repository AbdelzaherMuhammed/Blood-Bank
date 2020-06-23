<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'content' , 'category_id' , 'is_favourite' , 'small_desc');
    protected $appends = ['is_favourite'];



//    public function getIsFavouriteAttribute()
//    {
//        $favourite = auth()->guard('client-web')->check() ?request()->user()->whereHas('posts',function ($query){
//            $query->where('clientables.clientable' , $this->id);
//        })->first() : null;
//
//        if ($favourite)
//        {
//            return true;
//        }
//        return false;
//    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }
    protected $hidden = [
        'pivot'
    ];

}
