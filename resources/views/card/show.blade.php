@extends('layouts.app')

@section('title', 'Flashcard: ' . $card->begrip)

@section('content')
    <div class="panel-body">
        <h1>
            <a href="{{ route('mappen.show', [$card->getSet()->folder]) }}">{{ $card->getSet()->folder->naam }}</a>
            /
            <a href="{{ route('sets.show', [$card->getSet()]) }}">{{ $card->getSet()->naam }}</a>
            /
            {{ $card->begrip }}
        </h1>
        {!! Form::open(['route' => ['cards.destroy', $card], 'method' => 'delete']) !!}
            <div class="btn-group">
                <a href="{{ route('cards.edit', [$card]) }}" class="btn btn-lg btn-primary">Bewerken</a>
                {!! Form::submit('Verwijderen', ['class'=>'btn btn-lg btn-danger']) !!}
            </div>
        {!! Form::close() !!}
        <div class="form-group">
            <h2>
                {!! Form::label('begrip', 'Begrip: ') !!}
                <span>{{ $card->begrip }}</span>
            </h2>
        </div>
        <div class="form-group">
            <h3>
                {!! Form::label('omschrijving', 'Omschrijving: ') !!}
                <span>{{ $card->omschrijving }}</span>
            </h3>
        </div>
        <div class="form-group">
            <div>
                <img src="{{ $card->afbeelding->large->url }}">
            </div>
        </div>
    </div>
@endsection
