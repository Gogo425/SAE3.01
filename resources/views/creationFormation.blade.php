<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Création de Formation</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body class="bg-light">

    <div class="container py-5">
        <h1 class="text-center mb-4">Créer une formation</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="" method="POST" class="bg-white p-4 shadow-sm rounded">
            @csrf

            <!-- Niveau de Formation -->
            <div class="mb-3">
                <label for="id_level" class="form-label">Niveau de Formation :</label>
                <select class="form-select" id="id_level" name="id_level">
                @if($forma1 === null)
                    <option value="1">1</option>
                @endif
                @if($forma2 === null)
                    <option value="2">2</option>
                @endif
                @if($forma3 === null)
                    <option value="3">3</option>
                @endif
                </select>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Responsable de formation -->
            <div class="mb-3">
                <label for="name" class="form-label">Choix du responsable de formation :</label>
                <select class="form-select" name="name">
                    @foreach ($initsLess as $initLess)
                        <option value="{{$initLess->NAME}}">{{$initLess->NAME}} {{$initLess->SURNAME}}</option>
                    @endforeach
                </select>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            initiators-list
            <!-- Initiateurs -->
            <div class="mb-3">
                <label for="choice_initiateur" class="form-label">Choix des initiateurs :</label>
                <div id="initiators-list">
                    @foreach ($inits as $init)
                        <div class="form-check">
                            <input type="checkbox"
                                    class="form-check-input" 
                                    value="{{$init->ID_PER}}" 
                                    id="init-{{$init->ID_PER}}" 
                                    name="inits[]"
                                    data-level="{{ $init->ID_LEVEL }}">
                            <label class="form-check-label" for="init-{{$init->ID_PER}}">
                                {{$init->NAME}} {{$init->SURNAME}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Élèves -->
            <div class="mb-3">
                <label for="choice_students" class="form-label">Choix des élèves :</label>
                <div id="students-list">
                    @foreach ($studs as $stud)
                        <div class="form-check">
                            <input type="checkbox" 
                                    class="form-check-input" 
                                    value="{{$stud->ID_PER}}" 
                                    id="stud-{{$stud->ID_PER}}" 
                                    name="studs[]"
                                    data-level="{{ $stud->ID_LEVEL }}">
                            <label class="form-check-label" for="stud-{{$stud->ID_PER}}">
                                {{$stud->NAME}} {{$stud->SURNAME}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Dates -->
            <div class="mb-3">
                <label for="date_beginning" class="form-label">Date de début de la formation :</label>
                <input type="date" class="form-control" name="date_beginning">
            </div>

            <div class="mb-3">
                <label for="date_ending" class="form-label">Date de fin de la formation :</label>
                <input type="date" class="form-control" name="date_ending">
            </div>

            <!-- Bouton d'enregistrement -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/formation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>