<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paring extends Model
{
    public function PlayerA()
    {
      return $this->belongsTo('App\Player', 'PlayerA_id');
    }

    public function PlayerB()
    {
      return $this->belongsTo('App\Player', 'PlayerB_id');
    }

    public function round()
    {
      return $this->belongsTo('App\Round', 'round_num', 'round_num');
    }
}
