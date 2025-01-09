<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une évaluation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        <!-- Sélectionner un élève -->
        <div class="form-group mt-3">
            <label for="id_eleve">Sélectionner un élève</label>
            <select name="id_eleve" id="id_eleve" class="form-control" required>
                <option value="">-- Choisir un élève --</option>
                @foreach($eleves as $eleve)
                    <option value="{{ $eleve->ID_PER }}">{{ $eleve->NAME }}</option>
                @endforeach
            </select>
        </div>

        <!-- Conteneur pour les abilités -->
        <div id="abilities-container" class="mt-4">
            <h3 class="mt-5">Évaluation des compétences</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Aptitudes</th>
                        <th>Statut</th>
                        <th>Observation</th>
                    </tr>
                </thead>
                <tbody id="abilities-table-body">
                    <!-- Le tableau des abilités sera chargé dynamiquement via AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Bouton d'envoi -->
        <button type="submit" class="btn btn-primary mt-3">Enregistrer l'évaluation</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#id_eleve').on('change', function () {
            const eleveId = $(this).val(); 
            if (eleveId) {

                $.ajax({
                    url: "{{ route('abilities.by.student') }}",
                    type: "POST",
                    data: {
                        id_eleve: eleveId,
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function (abilities) {

                        $('#abilities-table-body').empty();

                        abilities.forEach(ability => {
                            const row = `
                                <tr>
                                    <td>
                                        <input type="hidden" name="ability[${ability.id_abilities}]" value="${ability.id_abilities}">
                                        ${ability.id_abilities}
                                    </td>
                                    <td>
                                        <input type="hidden" name="description[${ability.id_abilities}]" value="${ability.description}">
                                        ${ability.description}
                                    </td>
                                    <td>
                                        <select name="status[${ability.id_abilities}]" class="form-control" required>
                                            @foreach($status as $sta)
                                                <option value="{{ $sta->ID_STATUS }}">{{ $sta->DESCRIPTION }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="observations[${ability.id_abilities}]" class="form-control" placeholder="Observation (optionnel)">
                                    </td>
                                </tr>
                            `;
                            $('#abilities-table-body').append(row); 
                        });
                    },
                    error: function (xhr) {
                        console.error("Erreur lors du chargement des abilités", xhr);
                    }
                });
            } else {
                $('#abilities-table-body').empty();
            }
        });
    });
</script>



</body>
</html>
