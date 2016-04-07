<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function versions(){
        return $this->hasMany('App\Version');
    }
}
