<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Évaluer un élève</h1>

    <!-- Affiche les messages de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Liste des élèves -->
    <form action="{{ route('evaluations.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="eleve_id">Sélectionner un élève</label>
            <select name="eleve_id" id="eleve_id" class="form-control" required>
                <option value="">-- Choisir un élève --</option>
                @foreach($student as $eleve)
                    <option value="{{ $eleve->id }}">{{ $eleve->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control" required>
                <option value="Évalué">Évalué</option>
                <option value="Pas acquis">Pas acquis</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Enregistrer l'évaluation</button>
    </form>
</div>
@endsection

    
</body>
</html>