<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Liste de formations</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Liste de formations</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($forms as $form)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Formation de niveau : {{$form->ID_LEVEL-1}}</h5>
                <p class="card-text">
                    <strong>Date de début :</strong> {{$form->DATE_BEGINNING}}<br>
                    <strong>Date de fin :</strong> {{$form->DATE_ENDING}}<br>
                    <strong>Responsable de formation :</strong> {{ $pers->where('ID_PER','=',$form->ID_PER_TRAINING_MANAGER)->first()->NAME }} {{ $pers->where('ID_PER','=',$form->ID_PER_TRAINING_MANAGER)->first()->SURNAME }}
                </p>
                <p class="card-text">
                    <strong>Initiateurs :</strong><br>
                    @foreach ($inits->where('ID_FORMATION','=',$form->ID_FORMATION) as $init)
                        {{$init->NAME}} {{$init->SURNAME}}<br>
                    @endforeach
                </p>
                <p class="card-text">
                    <strong>Élèves :</strong><br>
                    @foreach ($studs->where('ID_FORMATION','=',$form->ID_FORMATION) as $stud)
                        {{$stud->NAME}} {{$stud->SURNAME}}<br>
                    @endforeach
                </p>
                @if($sessions->where('ID_FORMATION',$form->ID_FORMATION)->count() == 0)
                <div class="d-flex">
                    <form action="{{ route('formation.delete', $form->ID_FORMATION) }}" method="POST" class="me-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation?')">Supprimer</button>
                    </form>
                    <!-- <form action="" method="PUT">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">Modifier</button>
                    </form> -->
                </div>
                @endif
            </div>
        </div>
        @endforeach

        <div class="text-center">
            <a href="creationFormation" class="btn btn-primary">Ajouter une formation</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
