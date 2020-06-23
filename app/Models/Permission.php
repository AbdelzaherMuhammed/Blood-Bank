<?php namespace App\models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['name' , 'display_name' , 'description'];
}
