
@extends('base')

@section('title', 'acceuil')

@section('content')
    
    <?php
        $id = Auth::id();

        $infos = DB::select('select * from persons where id_per = :id', ['id' => $id])[0];

        $niveaux = DB::select('select * from levels');

    ?>

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">

        <div class="text-center">
            <h1 class="text-3xl font-semibold text-blue-600">Profil Utilisateur</h1>
            <p class="text-gray-600 mt-2">Informations détaillées sur votre profil.</p>
        </div>

        <!-- Carte de profil -->
        <div class="mt-8">
            <div class="flex items-center bg-blue-100 p-6 rounded-lg">
                <!-- Icône ou Avatar -->
                <div class="w-20 h-20 rounded-full bg-blue-500 text-white flex items-center justify-center text-2xl font-semibold">
                    U
                </div>
                <!-- Informations principales -->
                <div class="ml-6">
                    <h2 class="text-2xl font-semibold text-blue-600">{{ $infos->SURNAME }} {{ $infos->NAME }}</h2>
                    <?php
                        $student = DB::select('select * from students where id_per = :id', ['id' => $id]);
                        if(count($student) == 1){   
                    ?>
                    <p>Niveau de plongée : <?php echo $niveaux[$student[0]->ID_LEVEL - 1]->DESCRIPTION ?></p>
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
                    <p>Niveau de plongée : <?php echo $niveaux[$initiator[0]->ID_LEVEL - 1]->DESCRIPTION ?></p>
                    <?php
                        }
                    ?>

                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Tableau des informations -->
        <div class="mt-8">
            <table class="min-w-full border border-gray-200 rounded-lg shadow-md bg-white">
                <tbody>
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-600 font-medium">Nom :</td>
                        <td class="px-6 py-4 text-gray-800">{{$infos->SURNAME}}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-600 font-medium">Prénom :</td>
                        <td class="px-6 py-4 text-gray-800">{{$infos->NAME}}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-600 font-medium">Date de naissance :</td>
                        <td class="px-6 py-4 text-gray-800">10 Janvier 1985</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-600 font-medium">Date du certificat médical :</td>
                        <td class="px-6 py-4 text-gray-800">{{$infos->BIRTH_DATE}}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-600 font-medium">Numéro de licence :</td>
                        <td class="px-6 py-4 text-gray-800">{{$infos->LICENCE_NUMBER}}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-600 font-medium">Adresse :</td>
                        <td class="px-6 py-4 text-gray-800">{{$infos->ADRESS}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
