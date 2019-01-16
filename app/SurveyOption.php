<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyOption extends Model
{
    protected $guarded = [];

    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }

    public function votes()
    {
        return $this->hasMany('App\UserVote');
    }
}
