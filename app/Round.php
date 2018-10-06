<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    public function leadingPlayer()
    {
      return $this->belongsTo('App\Player', 'leading_player_id');
    }

    public function pausingPlayer()
    {
      return $this->belongsTo('App\Player', 'pausing_player_id');
    }

    public function parings()
    {
      return $this->hasMany('App\Paring', 'round_num', 'round_num');
    }
}
