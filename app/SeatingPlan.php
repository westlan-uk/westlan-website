<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeatingPlan extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany('App\SeatingItem');
    }
}
