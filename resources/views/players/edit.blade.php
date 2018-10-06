@extends('layouts.adminLayout')
@section('content')

<span class="pt-2">
  {{ Form::model($player, ['route' => ['players.update', $player->id], 'method' => "PUT"]) }}

    {{ Form::label('PlayerName', 'Player\'s Name') }}
    {{ Form::text('PlayerName', null, ['class' => 'form-control mb-3']) }}

    {{ Form::label('PlayerArmy', 'Player\'s Army') }}
    {{ Form::text('PlayerArmy', null, ['class' => 'form-control mb-3']) }}

    {{ Form::label('PlayerScore', 'Player\'s Score') }}
    {{ Form::number('PlayerScore', null, ['class' => 'form-control mb-3']) }}

    {{ Form::label('PlayerPause', 'Player\'s Pause') }}
    {{ Form::select('PlayerPause', [1 => 'YES', 0 => 'NO'], null, ['class' => 'form-control']) }}

    {{ Form::submit('Update Player', ['class' => 'btn btn-primary btn-sm mt-3']) }}

  {{ Form::close() }}
</span>
@stop
