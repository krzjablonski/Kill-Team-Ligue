<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paring;
use App\Player;
use App\Round;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Paring as ParingResource;
use App\Http\Resources\ParingCollection;
use App\Http\Resources\Error as ErrorResource;

class ParingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $parings = Paring::all();
      if ($parings->count() === 0) {
        return new ErrorResource(['error' => 'Resource does not exitsts']);
      }
      return new ParingCollection($parings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->data;
        $response = array();
        $error = false;
        $round_num = Round::orderBy('id', 'desc')->first()->round_num;

        foreach ($data as $item) {
          $paring = Paring::find($item['id']);
          $paring->round_num = $round_num;
          $paring->isUsed = true;
          if (!$paring->save()) {
            $error = true;
          }
          $response[] = $paring;
        }

        if ($error) {
          return new ErrorResource(['error' => 'Resource does not exitsts']);
        }
        return new ParingCollection(collect($response));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $paring = Paring::find($id);

      if (empty($paring)) {
        return new ErrorResource(['error' => 'Resource does not exitsts']);
      }

      return new ParingResource($paring);
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
     * Draw player's pairs for. Created pairs can't be identical with previously created. One player can't pause if all players hasn't.
     *
     * @return \Illuminate\Http\Response
     */

    public function draw()
    {

      $round = Round::orderby('id', 'desc')->first();

      if (empty($round)) {
        return new ErrorResource(['error' => 'Create Round to make parings']);
      }

      if (Player::all()->isEmpty()) {
        return new ErrorResource(['error' => 'Add Players to make parings']);
      }

      if (Round::all()->isEmpty()) {
        return new ErrorResource(['error' => 'Create Round to make parings']);
      }

      if ($round->parings->count() != 0) {
        return new ErrorResource(['error' => 'You can not generate parings for this round. Create new round']);
      }

      //Get players to play

      if (isset($round->pausing_player_id)) {
        $players = Player::where('id', '!=', $round->pausing_player_id)->get();
      }else{
        $players = Player::all();
      }

      $parings = [];
      $playerA = $players->shift();
      $usedPlayersId = [];
      while ($players->count()) {
        $paring = Paring::where('isUsed', 0)
                        ->where('PlayerA_id', '!=', $round->pausing_player_id)
                        ->where('PlayerB_id', '!=', $round->pausing_player_id)
                        ->whereNotIn('PlayerA_id', $usedPlayersId)
                        ->whereNotIn('PlayerB_id', $usedPlayersId)
                        ->where(function($query) use($playerA) {
                          $query->where('PlayerA_id', $playerA->id)
                                ->orWhere('PlayerB_id', $playerA->id);
                        })
                        ->first();
        $usedPlayersId[] = $playerA->id;
        $playerB = '';
        $players = $players->reject(function($item, $key) use(&$paring, &$usedPlayersId){
          if ($item->id == $paring->PlayerA_id || $item->id == $paring->PlayerB_id) {
            $usedPlayersId[] = $item->id;
            return true;
          }
        });
        $playerA = $players->shift();
        $parings[] = $paring;
      }

      return new ParingCollection(collect($parings));

    }

    // private function checkParing($PlayerA, $PlayerB)
    // {
    //   if ( Paring::whereExists( function($query) use(&$PlayerA, &$PlayerB){
    //     $query->selectRaw('1')
    //           ->where([
    //             ['PlayerA_id', '=', $PlayerA->id],
    //             ['PlayerB_id', '=', $PlayerB->id]
    //           ])
    //           ->orWhere([
    //             ['PlayerA_id', '=', $PlayerB->id],
    //             ['PlayerB_id', '=', $PlayerA->id]
    //           ]);
    //   } )->first() ) {
    //       return true;
    //   }
    //   return false;
    // }
}
