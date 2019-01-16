<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany('App\SurveyOption');
    }

    public function votes()
    {
        return $this->hasManyThrough('App\UserVote', 'App\SurveyOption');
    }
}
