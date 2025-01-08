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
            <label for="session_id">Sélectionner une session</label>
            <select name="session_id" id="session_id" class="form-control" required>
                <option value="">-- Choisir une session --</option>
                @foreach($sessions as $session)
                    <option value="{{ $session->id }}">{{ $session->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sélectionner un élève -->
        <div class="form-group mt-3">
            <label for="eleve_id">Sélectionner un élève</label>
            <select name="eleve_id" id="eleve_id" class="form-control" required>
                <option value="">-- Choisir un élève --</option>
                @foreach($eleves as $eleve)
                    <option value="{{ $eleve->id }}">{{ $eleve->nom }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tableau des abiltés -->
        <h3 class="mt-5">Évaluation des compétences</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Compétence</th>
                    <th>Statut</th>
                    <th>Observation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($abilities as $ability)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <input type="hidden" name="abilities_id[]" value="{{ $ability->id }}">
                        {{ $ability->name }}
                    </td>
                    <td>
                        <select name="status[{{ $ability->id }}]" class="form-control" required>
                            <option value="Évalué">Évalué</option>
                            <option value="Pas acquis">Pas acquis</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="observations[{{ $ability->id }}]" class="form-control" placeholder="Observation (optionnel)">
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
