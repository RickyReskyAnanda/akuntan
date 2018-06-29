<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GeneralModel extends Model
{
    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
       {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->created_by = $userid;
            $model->updated_by = $userid;
        });

        static::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->updated_by = $userid;
        });
    }
}
