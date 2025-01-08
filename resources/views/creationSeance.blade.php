<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/resources/js/app.js">


        <title>Création d'une séance</title>
    </head>
    <header>
        <img src="../image/logo.png" alt="logo"/>
        <button>Profil</button>
        <button>Déconnexion</button>
    </header>
    <body>
        <form action="{{ route('seance.save') }}" method="POST">
            @csrf
            <label>Date :</label>
            <input type="date" id="dateSeance" name="dateSeance" required/> <!-- vérifier que la date n'est pas avant date du jour-->

            <div name='eleve1'>
                <select name="eleve" id="eleve">
                    <option value="">--choisir un nom--</option>

                    <?php foreach ($listEleve as $nomEleve): ?>

                        <option value ="<?php echo $nomEleve?>"><?php echo $nomEleve?></option>

                    <?php endforeach; ?>
                </select>

                <select name="aptitude1" id="aptitude1">
                    <option value="">--choisir une aptitude--</option>

                    <?php foreach ($listAptitude as $nomAptitude): ?>

                        <option value ="<?php echo $nomAptitude?>"><?php echo $nomAptitude?></option>

                    <?php endforeach; ?>
                </select>

                <select name="aptitude2" id="aptitude2">
                    <option value="">--choisir une aptitude--</option>

                    <?php foreach ($listAptitude as $nomAptitude): ?>

                        <option value ="<?php echo $nomAptitude?>"><?php echo $nomAptitude?></option>

                    <?php endforeach; ?>
                </select>

                <select name="aptitude3" id="aptitude3">
                    <option value="">--choisir une aptitude--</option>

                    <?php foreach ($listAptitude as $nomAptitude): ?>

                        <option value ="<?php echo $nomAptitude?>"><?php echo $nomAptitude?></option>

                    <?php endforeach; ?>
                </select>

                <select name="initiateur" id="initiateur">
                    <option value="">--choisir un initiateur--</option>

                    <?php foreach ($listInitiateur as $nomInitiateur): ?>

                        <option value ="<?php echo $nomInitiateur?>"><?php echo $nomInitiateur?></option>

                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <input type="button" onclick="ajoutEleve()" value="Ajouter un elève"/>
            <button type="submit">Créer une séance</button>
        </form>
    </body>
</html>