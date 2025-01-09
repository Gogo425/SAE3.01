<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Liste de formations</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    </head>
    <body >
    <h1>Liste de formations</h1>
        
    
    @foreach ($forms as $form)
    <div>
        <tr>
            <td>Formation de niveau : {{$form->ID_LEVEL-1}}</td>
            <br>
            <td>Date de début : {{$form->DATE_BEGINNING}}</td>
            <br>
            <td>Date de fin : {{$form->DATE_ENDING}}</td>
            <br>
            <td>Responsable de formation : {{ $pers->where('ID_PER','=',$form->ID_PER_TRAINING_MANAGER)->first()->NAME }}  {{ $pers->where('ID_PER','=',$form->ID_PER_TRAINING_MANAGER)->first()->SURNAME }}</td>
            <br>
            <td>Initiateurs :</td>
            <td>
                @foreach ($inits->where('ID_FORMATION','=',$form->ID_FORMATION) as $init)
                    {{$init->NAME}}
                    {{$init->SURNAME}}
                @endforeach
            </td>
            <br><br>
            <td>Eleves :</td>
            <td>
                @foreach ($studs->where('ID_FORMATION','=',$form->ID_FORMATION) as $stud)
                    {{$stud->NAME}}
                    {{$stud->SURNAME}}
                @endforeach
            </td>
            <br><br>
            <td class="action-buttons">
                <form action="{{ route('formation.delete', $form->ID_FORMATION) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation?')">Supprimer</button>
                </form>
                <form action="" method="GET" style="display: inline;">
                    @csrf 
                    <button type="submit">Modifier</button>
                </form>


            </td>
        </tr>
    </div>
    @endforeach
    <br><br>
    <p>
        <a href="creationFormation" class="btn btn-primary"> Ajouter une formation </a>
    </p>

    </form>
    </body>
</html>
