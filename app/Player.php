<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function paringsA()
    {
      return $this->hasMany('App\Paring', 'PlayerA_id');
    }

    public function paringsB()
    {
      return $this->hasMany('App\Paring', 'PlayerB_id');
    }

    public function pauses()
    {
      return $this->hasMany('App\Round', 'pausing_player_id');
    }

    public function leading()
    {
      return $this->hasMany('App\Round', 'leading_player_id');
    }

}
