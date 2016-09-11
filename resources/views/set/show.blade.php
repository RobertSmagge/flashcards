@extends('layouts.app')

@section('title', 'Set: ' . $set->naam)

@section('content')
    <div class="panel-body">
        <h1>
            <a href="{{ route('mappen.show', [$set->folder]) }}">{{ $set->folder->naam }}</a>
            /
            {{ $set->naam }}
        </h1>
        {!! Form::open(['route' => ['sets.destroy', $set], 'method' => 'delete']) !!}
            <div class="btn-group">
                <a href="{{ route('sets.present', [$set, 0, 1]) }}" class="btn btn-lg btn-primary">Presenteren</a>
                <a href="{{ route('sets.edit', [$set]) }}" class="btn btn-lg btn-primary">Bewerken</a>
                {!! Form::submit('Verwijderen', ['class'=>'btn btn-lg btn-danger']) !!}
            </div>
        {!! Form::close() !!}
        <ul>
            @foreach($set->cards as $card)
                <h2>
                    <li>
                        <a href="{{ route('cards.show', [$card]) }}">{{ $card->begrip }}</a>
                    </li>
                </h2>
            @endforeach
        </ul>
    </div>
@endsection
