<?php

namespace App\Http\Controllers;

use App\Http\Resources\Paring as ParingResource;
use App\Http\Resources\ParingCollection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Round;
use App\Player;
use App\Paring;

class CampaginController extends Controller
{
    public function createCampagin()
    {
      if (!Round::all()->isEmpty()) {
        return redirect()->route('rounds.index');
      }

      if (!Paring::all()->isEmpty()) {
        return redirect()->route('rounds.index');
      }

      $allParings = $this->drawAllParings(Player::all());

      foreach ($allParings as $paring) {
        $paring->save();
      }

    }

    private function drawAllParingsTest($players, $parings = [])
    {
      foreach ($players as $item) {
        foreach ($players as $playerB) {
          if ($item->id != $playerB->id) {
            $paring = new Paring;
            $paring->PlayerA_id = $item->id;
            $paring->PlayerB_id = $playerB->id;
            $parings[] = $paring;
          }
        }
      }
      return $parings;
    }

    private function drawAllParings($players, $parings = [])
    {
      global $parings;

      $playerA = $players->shift();

      foreach ($players as $item) {
        $paring = new Paring;
        $paring->PlayerA_id = $playerA->id;
        $paring->PlayerB_id = $item->id;
        $parings[] = $paring;
      }

      if ($players->count() != 1) {
        $this->drawAllParings($players, $parings);
      }

      return $parings;
    }
}
