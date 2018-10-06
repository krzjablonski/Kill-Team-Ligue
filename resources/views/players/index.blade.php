@extends('layouts.adminLayout')
@section('content')
    <div class="row pt-5">
      <div class="col-sm-12">
        {{ Form::open(['route' => 'players.store', 'class' => 'form-inline justify-content-end']) }}
          {{ Form::label('PlayerName', 'Player\'s Name') }}
          {{ Form::text('PlayerName', null, ['class' => 'form-control form-control-sm ml-1 mr-3']) }}
          {{ Form::label('PlayerArmy', 'Player\'s Name') }}
          {{ Form::text('PlayerArmy', null, ['class' => 'form-control form-control-sm ml-1 mr-2']) }}
          {{ Form::submit('Add Player', ['class' => 'btn btn-primary btn-sm']) }}
        {{ Form::close() }}
      </div>
      <div class="col-sm-12 pt-2">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">All Players</h4>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Player's Name</th>
                  <th scope="col">Player's Army</th>
                  <th scope="col">Player's Score</th>
                  <th scope="col">Player's Pause</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($players as $player)
                  <tr>
                    <th scope="row">{{ $player->id }}</th>
                    <td>{{ Html::linkRoute('players.edit', $player->PlayerName, [$player->id]) }}</td>
                    <td>{{ $player->PlayerArmy }}</td>
                    <td class="text-center">{{ $player->PlayerScore }}</td>
                    <td class="text-center">{{ $player->PlayerPause }}</td>
                    <th>
                      {{ Html::linkRoute('players.edit', 'Edytuj', [$player->id], ['class' => 'btn btn-primary btn-sm']) }}
                      {{ Form::open(['route' => ['players.destroy', $player->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                      {{ Form::close() }}
                    </th>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@stop
