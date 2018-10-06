@extends('layouts.adminLayout')

@section('content')
<div class="row pt-5">
  <div class="col-sm-12">
    {!! Form::open(['route' => 'rounds.store', 'class' => 'mb-3 d-flex justify-content-end']) !!}
      {{ Form::submit('Create New Round', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
  </div>
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">All Rounds</h4>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="column">#</th>
              <th scope="column">Round number</th>
              <th scope="column">Pausing Player</th>
              <th scope="column">Has Parings?</th>
              <th scope="column"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($rounds as $round)
              <tr>
                <th>{{ $round->id }}</th>
                <td>{{ $round->round_num }}</td>
                <td>
                  @if (isset($round->pausingPlayer->PlayerName))
                    {{$round->pausingPlayer->PlayerName}}
                  @endif
                </td>
                <td>
                  @if ($round->parings->count() > 0)
                    {{ $round->parings->count() }}
                  @else
                    {{ 'NO' }}
                  @endif
                </td>
                <td>
                  @if( $round->parings->count() > 0 )
                    {{Html::linkRoute('rounds.show', 'View Parings', [$round->id], ['class' => 'btn btn-primary']) }}
                    <button type="button" name="button" class="btn btn-secondary" disabled>Delete</button>
                  @else
                    {{Html::linkRoute('rounds.show', 'Add Parings', [$round->id], ['class' => 'btn btn-primary']) }}
                    {!! Form::open(['route' => ['rounds.destroy', $round->id], 'method' => 'DELETE', 'class' => 'mb-3 d-inline-block']) !!}
                      {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                    {!! Form::close() !!}
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop
