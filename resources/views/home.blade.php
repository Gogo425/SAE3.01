@extends('base')

@section('title', 'acceuil')

@section('content')

        <p class="text-4xl text-center p-10"> BIENVENUE {{Auth::user()->name;}}</p>

        <p class="text-2xl p-3"> Qu'est ce que la FFESSM?</p>

        <p class="pl-10 pb-7"> La FFESSM (Fédération Française d'Études et de Sports Sous-Marins) est une organisation qui s’occupe de tout ce qui concerne les activités subaquatiques en France. Cela inclut des sports comme la plongée sous-marine, l’apnée, la nage avec palmes, ou encore des disciplines plus spécifiques comme le hockey subaquatique, la chasse sous-marine, ou l’archéologie sous-marine.<p>
       
        <p class="text-2xl  p-3"> Nos objectifs </p>

        <p class="pl-10 pb-7"> Nos objectifs sont de former les pratiquants, organiser des examens et délivrer des diplômes reconnus pour diverses activités subaquatiques, nous encourageons la pratique de ces activités via un réseau de clubs, d'événements et de compétitions et nous protégeons l'environnement marin afin de sensibiliser les pratiquants à la préservation des océans et de leur biodiversité. </p>
       
       <!--  <button>Liste d'élèves et d'initiateurs</button>
        <button>Liste de formations</button>
        <button>Consulter ma formation</button>

       <button><a href="{{ asset('calendar/calendarDirector') }}">Consulter l'emploi du temps Responsable de Formation</a></button>
        <button><a href="{{ asset('calendar/calendarStudent') }}">Consulter l'emploi du temps élèves</a></button>
        <button><a href="{{ asset('calendar/calendarInitiator') }}">Consulter l'emploi du temps Initiateur</a></button> -->

@endsection
