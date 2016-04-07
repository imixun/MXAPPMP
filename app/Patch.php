<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patch extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function version(){
        return $this->belongsTo('App\Version');
    }
}
