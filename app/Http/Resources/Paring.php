<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Paring extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
        'id' => $this->id,
        'PlayerA_id' => $this->PlayerA_id,
        'PlayerB_id' => $this->PlayerB_id,
        'PlayerA_Name' => $this->PlayerA->PlayerName,
        'PlayerA_Army' => $this->PlayerA->PlayerArmy,
        'PlayerB_Name' => $this->PlayerB->PlayerName,
        'PlayerB_Army' => $this->PlayerB->PlayerArmy,
        'Round' => $this->round
      ];
    }
}
