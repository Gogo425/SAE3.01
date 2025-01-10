<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Liste de formations</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>
    <script defer src="../js/homePage.js"></script>
</head>
<body class="bg-light">
    @include('header')
    <div class="container py-5">
        <h1 class="text-center mb-4 text-5xl">Liste de formations</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

                <div class="card mb-4 shadow-sm">
                    <div class="card-body">

                        <!-- Formation level -->
                        <h5 class="card-title">Formation de niveau : {{$form->first()->ID_LEVEL-1}}</h5>
                        <p class="card-text">

                            <!-- Formation starting date -->
                            <strong>
                                Date de début :
                            </strong> 
                                {{$form->first()->DATE_BEGINNING}}
                            <br>

                            <!-- Formation ending date -->
                            <strong>
                                Date de fin :
                            </strong> 
                                {{$form->first()->DATE_ENDING}}
                            <br>

                            <!-- Training manager -->
                            <strong>
                                Responsable de formation :
                            </strong> 
                                {{ $pers->where('ID_PER','=',$form->first()->ID_PER_TRAINING_MANAGER)->first()->NAME }} 
                                {{ $pers->where('ID_PER','=',$form->first()->ID_PER_TRAINING_MANAGER)->first()->SURNAME }}
                        </p>

                        <!-- Initiators -->
                        <p class="card-text">
                        <strong>
                            Initiateurs :
                        </strong>
                        <br>
                            @foreach ($inits->where('ID_FORMATION','=',$form->first()->ID_FORMATION) as $init)
                                {{$init->NAME}} {{$init->SURNAME}} | Niveau
                                @if($init->ID_LEVEL == 5)
                                    MF1
                                @elseif($init->ID_LEVEL == 6)
                                    MF2
                                @elseif($init->ID_LEVEL == 7)
                                    MF3
                                @else
                                    {{$init->ID_LEVEL-1}}
                                @endif
                                <br>
                            @endforeach
                        </p>

                        <!-- Students -->
                        <p class="card-text">
                            <strong>Élèves :</strong><br>
                            @foreach ($studs->where('ID_FORMATION','=',$form->first()->ID_FORMATION) as $stud)
                                {{$stud->NAME}} {{$stud->SURNAME}}
                                <br>
                            @endforeach
                        </p>
                    </div>
                </div>
    </div>

    @include('footer')
    <!-- adding the JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
