@extends('base')

@section('title', 'acceuil')

@section('content')

        <p>{{Auth::user();}}</p>
        <button>Liste d'élèves et d'initiateurs</button>
        <button>Liste de formations</button>
        <button>Consulter ma formation</button>

        <button><a href="{{ asset('calendar/calendarDirector') }}">Consulter l'emploi du temps Responsable de Formation</a></button>
        <button><a href="{{ asset('calendar/calendarStudent') }}">Consulter l'emploi du temps élèves</a></button>
        <button><a href="{{ asset('calendar/calendarInitiator') }}">Consulter l'emploi du temps Initiateur</a></button>

@endsection
