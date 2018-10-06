<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Player;
use Session;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();
        return view('players.index')->withPlayers($players);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
          'PlayerName' => 'required|max:255',
          'PlayerArmy' => 'required|max:255',
        ));

        $player = new Player();
        $player->PlayerName = filter_var($request->PlayerName, FILTER_SANITIZE_STRING);
        $player->PlayerArmy = filter_var($request->PlayerArmy, FILTER_SANITIZE_STRING);
        $player->PlayerScore = 0;
        $player->PlayerPause = 0;

        if ($player->save()) {
          Session::flash('success', 'Player was added');
          return redirect()->route('players.index');
        }else{
          return Redirect::back()->withErrors(['storeError', 'Player could not be updated. Please contact administrator.']);
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
        $player = Player::find(filter_var($id, FILTER_SANITIZE_NUMBER_INT));

        return view('players.edit')->withPlayer($player);
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
        $player = Player::find(filter_var($id, FILTER_SANITIZE_NUMBER_INT));

        $this->validate($request, array(
          'PlayerName' => 'required|max:255',
          'PlayerArmy' => 'required|max:255',
          'PlayerScore' => 'required|integer',
          'PlayerPause' => 'required|integer'
        ));

        $player->PlayerName = filter_var($request->PlayerName, FILTER_SANITIZE_STRING);
        $player->PlayerArmy = filter_var($request->PlayerArmy, FILTER_SANITIZE_STRING);
        $player->PlayerScore = filter_var($request->PlayerScore, FILTER_SANITIZE_NUMBER_INT);
        $player->PlayerPause = filter_var($request->PlayerPause, FILTER_SANITIZE_NUMBER_INT);

        if ($player->save()) {
          Session::flash('success', 'Player was updated');
          return redirect()->route('players.index');
        }else{
          return Redirect::back()->withErrors(['updateError', 'Player could not be updated. Please contact administrator.']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Player::find(filter_var($id, FILTER_SANITIZE_NUMBER_INT));

        if ($player->delete()) {
          Session::flash('success', 'Player was removed');
          return redirect()->route('players.index');
        }else{
          return Redirect::back()->withErrors(['deleteError', 'Player could not be removed. Please contact administrator.']);
        }

    }
}
