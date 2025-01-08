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
    </head>
    <body >
    <h1>Liste de formations</h1>
        
    
    @foreach ($forms as $form)
    <div>
        <h2>{{$form->NOM}}</h2>
        <p>
            Formation de niveau : {{$form->ID_LEVEL}}
            <br>
            Date de début : {{$form->DATE_BEGINNING}}
            <br>
            Date de fin : {{$form->DATE_ENDING}}
            <br>
            Responsable de formation : {{ $pers->where('ID_PER','=',$form->ID_PER_TRAINING_MANAGER)->first()->NAME }} , {{ $pers->where('ID_PER','=',$form->ID_PER_TRAINING_MANAGER)->first()->SURNAME }}
        </p>
        <p>
            Initiateurs :
            <br>
            @foreach ($inits->where('ID_FORMATION','=',$form->ID_FORMATION) as $init)
                {{$init->NAME}}
                {{$init->SURNAME}}
                <br>
                
            @endforeach
        </p>
        <p>
            Eleves :
            <br>
            @foreach ($studs->where('ID_FORMATION','=',$form->ID_FORMATION) as $stud)
                {{$stud->NAME}}
                {{$stud->SURNAME}}
                <br>
                
            @endforeach
        </p>
        <p>
            <a href="" class="btn btn-primary">Modifier</a>
            <a href="" class="btn btn-primary">Supprimer</a>
        </p>
    </div>
    @endforeach
    <p>
        <a href="creationFormation" class="button"> Ajouter une formation </a>
    </p>

    </form>
    </body>
</html>
