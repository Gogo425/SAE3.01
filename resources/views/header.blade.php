<header>
    <menu>
        <div class="flex items-center justify-between p-4 bg-gray-100">
            <img src="./img/logo.png" alt="logo" class="w-16 h-16">
            <div class="flex space-x-4">

            
             @guest
                <a href="{{ route('login') }}">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Connexion</button>
                </a>
            @endguest

              
               @auth
                    <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Profil</button>
                    <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Déconnexion</button>
                   
                @endauth

                <?php
                    $technicalDirectors = DB::select('select * from technical_directors where id_per = :id', ['id' => $id])[0];
                    $trainingManager = DB::select('select * from training_managers where id_per = :id', ['id' => $id])[0];
                    $initiator =DB::select('select * from initiators where id_per = :id', ['id' => $id])[0];
                    $student =DB::select('select * from students where id_per = :id', ['id' => $id])[0];

                    if($technicalDirectors == 1){
                        /* aptitudes et compétences / formation et peut les modif si jamais le manuel technique évolue 
                                - listes des utilisateurs ds la base -> ajout et modif info
                                - créer formation, attribuer un responsable de formation ds eleves et initiateurs
                                - voir ensemble formations existantes
                                - bilan /eleves
                        */
                    }
                    if($trainingManager == 1){
                        /*
                        - voir ensemble élèves et initiateurs de la formation
                        - créer des séances,voir les séances déjà faites
                        - voir bilan de sa formation /eleves pour toutes les compétences
                        */
                    }

                    if($initiator == 1){
                        /*  - voir ses séances, séances passées, 
                            -qui il a
                            - quelle aptitude il travaille
                            - evaluer eleves
                        */
                    }

                    if($student == 1){
                        /*
                          - bilan formation
                            - seance passée et avenir
                        */
                    }
                ?>
            </div>
        </div>    
    </menu>

</header>