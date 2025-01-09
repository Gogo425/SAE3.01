
@extends('base')

@section('title', 'acceuil')

@section('content')
    
    <?php
        $id = Auth::id();

        $infos = DB::select('select * from persons where id_per = :id', ['id' => $id])[0];

        $niveaux = DB::select('select * from levels');

    ?>
    <h1>Informations générales</h1>
    <p>Nom : <?php echo $infos->NAME; ?></p>
    <p>Prénom : <?php echo $infos->SURNAME; ?></p>
    <p>Date de naissance : <?php echo $infos->BIRTH_DATE; ?></p>
    <p>Date du certificat médical : <?php echo $infos->MEDICAL_CERTIFICATE_DATE; ?></p>
    <p>Numéro de licence : <?php echo $infos->LICENCE_NUMBER; ?></p>
    <p>Adresse : <?php echo $infos->ADRESS; ?></p>

    <?php
        $student = DB::select('select * from students where id_per = :id', ['id' => $id]);
        if(count($student) == 1){   
    ?>
    <h2>Vos informations d'élève</h2>
    <p>Niveau d'initiateur : <?php echo $niveaux[$student[0]->ID_LEVEL - 1]->DESCRIPTION ?></p>
    <?php
        } else {
    ?>

    <?php
        $td = DB::select('select * from technical_directors where id_per = :id', ['id' => $id]);
        if(count($td) == 1){
    ?>
    <h2>Vous êtes directeur technique</h2>
    <?php
        }
    ?>

    <?php
        $initiator = DB::select('select * from initiators where id_per = :id', ['id' => $id]);
        if(count($initiator) == 1){   
    ?>
    <h2>Vos informations d'initiateurs</h2>
    <p>Niveau d'initiateur : <?php echo $niveaux[$initiator[0]->ID_LEVEL - 1]->DESCRIPTION ?></p>
    <?php
        }
    ?>

    <?php
        }
    ?>

@endsection
