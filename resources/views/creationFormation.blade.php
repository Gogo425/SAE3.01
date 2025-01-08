<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CreationFormation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">  
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    </head>
    <body >
    <h1>Créer une formation</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    
        <label for="nom">Nom de la formation :</label><br>
            <input type="text" id="nom" name="nom" value="{{ old('nom') }}">
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
            <br><br>

        <form action="" method="POST">
        @csrf
        <label for="id_level">Niveau de Formation :</label>
        <select class="form-control" name="id_level">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        @error('name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br><br>

        <label for="email">Email du Responsable de formation :</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br><br>

        <div class="container">  
            <label for="date_beginning"> Date de début de la formation </label>
            <input class="date form-control" type="text" name="date_beginning">  
        </div>  

        <div class="container2">  
            <label for="date_ending"> Date de fin de la formation </label>
            <input class="date form-control" type="text" name="date_ending">  
        </div>

        <script type="text/javascript">  
            $('.date').datepicker({    
            format: 'yyyy-mm-dd'  
            });    
        </script>
        
        <button type="submit">Enregistrer</button>
    </form>
    </body>
</html>
