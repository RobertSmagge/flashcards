@extends('layouts.app')

@section('title', 'Map: ' . $folder->naam)

@section('content')
    <div class="panel-body">
        <h1>{{ $folder->naam }}</h1>
        {!! Form::open(['route' => ['mappen.destroy', $folder], 'method' => 'delete']) !!}
            <div class="btn-group">
                <a href="{{ route('mappen.edit', [$folder]) }}" class="btn btn-lg btn-primary">Bewerken</a>
                {!! Form::submit('Verwijderen', ['class'=>'btn btn-lg btn-danger']) !!}
            </div>
        {!! Form::close() !!}
        <ul>
            @foreach($folder->sets as $set)
                <li>
                    <a href="{{ route('sets.show', [$set]) }}">{{ $set->naam }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
