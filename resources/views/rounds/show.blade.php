@extends('layouts.adminLayout')

@section('content')

  <div class="row pt-5">
    <div class="col d-flex align-items-center justify-content-between">
      <h1 class="">Round number: <span>{{$round->round_num}}<span><br>
        @if (isset($round->pausingPlayer->PlayerName))
          <small class="muted" style="font-size: 0.5em"><strong>Pausing Player:</strong> {{ $round->pausingPlayer->PlayerName }}</small>
        @endif
      </h1>
    </div>
  </div>
  <div class="row">
    <div class="col" id="app">
      <div v-if="!loading" class="app-wrapper">
        <div  class="d-flex justify-content-between">
          <button v-on:click="drawParings" v-if="generateBtn" type="button" name="button" class='generate-parings-btn btn btn-primary btn-lg mt-5'>Generate Parings</button>
          <button v-on:click="saveParings" v-if="saveBtn" type="button" name="button" class='generate-parings-btn btn btn-success btn-lg mt-5'>Save Parings</button>
        </div>
        <round-component :parings="parings" :error="error" :success="success" :generate="generate"></round-component>
      </div>
      <input type="hidden" name="round_1" value="{{$round->round_num}}" v-model="roundNum">
    </div>
  </div>
@stop
