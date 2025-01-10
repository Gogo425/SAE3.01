<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une évaluation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Créer une évaluation</h1>

    <!-- Affiche les messages de succès -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('alert'))
    <div class="alert alert-warning">
        {{ session('alert') }}
    </div>
    @endif

    <!-- Formulaire d'évaluation -->
    <form action="{{ route('evaluations.store') }}" method="POST">
        @csrf

        <input type="hidden" name="idSession" value="{{ $idSession }}">

        <!-- Affichage des compétences pour chaque élève -->
        <div id="abilities-container" class="mt-4">
            <h3 class="mt-5">Évaluation des compétences par Mr/Mme {{Auth::user()->name}}</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Noms des élèves</th>
                        <th>Aptitudes</th>
                        <th>Statut</th>
                        <th>Observation</th>
                    </tr>
                </thead>
                <tbody>
    @foreach($eleves as $eleve)
        @foreach($eleve->abilities as $ability)
            <tr>
                <!-- Hidden field for student ID -->
                <input type="hidden" name="id[{{ $eleve->id_per }}]" value="{{ $eleve->id_per }}">

                <!-- Ability ID -->
                <input type="hidden" name="ability[{{ $eleve->id_per }}][{{ $ability->id_abilities }}]" value="{{ $ability->id_abilities }}">

                <td>{{ $eleve->surname }} {{ $eleve->name }}</td>
                <td>
                    <input type="hidden" name="description[{{ $eleve->id_per }}][{{ $ability->id_abilities }}]" value="{{ $ability->description }}">
                    {{ $ability->description }}
                </td>
                <td>
                    <select name="status[{{ $eleve->id_per }}][{{ $ability->id_abilities }}]" class="form-control" required>
                        @foreach($status as $sta)
                            <option value="{{ $sta->ID_STATUS }}">{{ $sta->DESCRIPTION }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="observations[{{ $eleve->id_per }}][{{ $ability->id_abilities }}]" class="form-control" placeholder="Observation (optionnel)">
                </td>
            </tr>
        @endforeach
    @endforeach
</tbody>
            </table>
        </div>

        <!-- Bouton d'envoi -->
        <button type="submit" class="btn btn-primary mt-3">Enregistrer l'évaluation</button>
    </form>
</div>
</body>
</html>
