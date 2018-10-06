<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Resources\Paring as ParingResource;
use App\Http\Resources\ParingCollection;
use App\Http\Resources\Error as ErrorResource;
use App\Round;
use App\Player;
use App\Paring;

use Session;

class RoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rounds.index')->withRounds(Round::all());
    }

    /**
     * Display a single resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
       return view('rounds.show')->withRound(Round::find(filter_var($id, FILTER_SANITIZE_NUMBER_INT)));
     }

     /**
      * Returns json of a single resource.
      *
      * @return \Illuminate\Http\Response
      */
      public function getParingsByRound($id)
      {
        $round = Round::find(filter_var($id, FILTER_SANITIZE_NUMBER_INT));
        if ($round->parings->count() == 0) {
          return new ErrorResource(['error' => 'This round has no parings. Create new.']);
        }
        return new ParingCollection($round->parings);
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastRound = Round::orderBy('id', 'desc')->first();

        if (!empty($lastRound) && $lastRound->parings->count() == 0) {
          return Redirect::back()->withErrors(['Round could not be created because your previous round has no parings.']);
        }

        $round = new Round;

        //Get number of all players in db
        $playersCount = Player::count();

        if ($playersCount % 2 != 0) {
          $playerToPause = $this->getPausingPlayer();
          $round->pausing_player_id = $playerToPause->id;
          $player = Player::where('id', $round->pausing_player_id)->first();
          $player->PlayerPause = 1;
          $player->save();
        }else{
          $round->pausing_player_id = NULL;
        }

        if (empty($lastRound)) {
          $round->round_num = 1;
        }else{
          $round->round_num = $lastRound->round_num  + 1;
        }

        if ($round->save()) {
          Session::flash('success', 'Round was added');
          return redirect()->route('rounds.index');
        }else{
          return Redirect::back()->withErrors(['Round could not be created. Please contact administrator.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('round.index')->withRound( Round::find( filter_var( $id, FILTER_SANITIZE_NUMBER_INT ) ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $round = Round::find(filter_var($id, FILTER_SANITIZE_NUMBER_INT));
        print_r($round);
        if ($round->parings->count() > 0) {
          return Redirect::back()->withErrors(['You can not delete round with parrings attached']);
        }

        if($round->delete()){
          $player = Player::where('id', $round->pausing_player_id)->first();
          $player->PlayerPause = 0;
          $player->save();
          Session::flash('success', 'Round was removed');
          return redirect()->route('rounds.index');
        }else{
          return Redirect::back()->withErrors(['Round could not be removed. Please contact administrator.']);
        }

    }

    public function getPausingPlayer()
    {
      $playerToPause = Player::where('PlayerPause', 0)->first();

      // If there are no players that can pause, reset them.
      if (empty($playerToPause)) {
        $this->resetPause();
        $playerToPause = Player::where('PlayerPause', 0)->first();
      }
      return $playerToPause;
    }


    /**
     * Reset player's pause column
     *
     * @return void
     */
    private function resetPause()
    {
      $players = Player::all();
      foreach ($players as $player) {
        $player->PlayerPause = 0;
        $player->save();
      }
    }
}
