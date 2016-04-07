<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function app(){
        return $this->belongsTo('App\App');
    }

    public function patch(){
        return $this->hasOne('App\Patch');
    }
}
