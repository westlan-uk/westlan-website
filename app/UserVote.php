<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVote extends Model
{
    protected $guarded = [];

    public function option()
    {
        return $this->belongsTo('App\SurveyOption', 'survey_option_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
