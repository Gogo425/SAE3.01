<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<div class="container">
    <h1>Créer une évaluation</h1>

    <!-- Affiche les messages de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire d'évaluation -->
    <form action="{{ route('evaluations.store') }}" method="POST">
        @csrf

        <!-- Sélectionner une session -->
        <div class="form-group mt-3">
            <label for="id_sessions">Sélectionner une session</label>
            <select name="id_sessions" id="id_sessions" class="form-control" required>
                <option value="">-- Choisir une session --</option>
                @foreach($sessions as $session)
                    <option value="{{ $session->ID_SESSIONS }}">{{ $session->DATE_SESSION }}</option>
                @endforeach
            </select>
        </div>


        <!-- Sélectionner un élève -->
        <div class="form-group mt-3">
            <label for="eleve_id">Sélectionner un élève</label>
            <select name="eleve_id" id="eleve_id" class="form-control" required>
                <option value="">-- Choisir un élève --</option>
                @foreach($eleves as $eleve)
                    <option value="{{ $eleve->id }}">{{ $eleve->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tableau des abiltés -->
        <h3 class="mt-5">Évaluation des compétences</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Abilités</th>
                    <th>Statut</th>
                    <th>Observation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($abilities as $ability)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <input type="hidden" name="description" value="{{$ability->DESCRIPTION}}">
                        {{ $ability->DESCRIPTION }}
                    </td>
                    <td>
                        <select name="status[{{ $ability->ID_ABILITIES }}]" class="form-control" required>
                        @foreach($status as $sta)
                        <option value="{{ $sta->ID_STATUS }}">{{ $sta->DESCRIPTION}}</option>
                        @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="observations[{{ $ability->ID_ABILITIES }}]" class="form-control" placeholder="Observation (optionnel)">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bouton d'envoi -->
        <button type="submit" class="btn btn-primary mt-3">Enregistrer l'évaluation</button>
    </form>
</div>

</body>
</html>
