<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeatingItem extends Model
{
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo('App\SeatingPlan');
    }
}
