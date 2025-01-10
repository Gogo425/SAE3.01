<header>
    <menu>
        <div class="flex flex-wrap items-center justify-between p-4 bg-gray-100">
            <a href="/"><img src="../img/logo.png" alt="logo" class="w-16 h-16 mb-4 md:mb-0"></a>
            <div class="flex flex-wrap justify-center gap-4 md:flex-nowrap">
                <?php
                    $id = Auth::id();
                    
                    $technicalDirectors = DB::select('select count(*) as count from technical_directors where id_per = :id', ['id' => $id])[0];
                    $trainingManager = DB::select('select count(*) as count from training_managers where id_per = :id', ['id' => $id])[0];
                    $initiator = DB::select('select count(*) as count from initiators where id_per = :id', ['id' => $id])[0];
                    $student = DB::select('select count(*) as count from students where id_per = :id', ['id' => $id])[0];
                  
                    if($technicalDirectors->count == 1){
                        echo "
                            <a href=".route('liste')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600'>Liste des utilisateurs</button></a>
                            <a href=".route('formation')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600'>Liste des formations</button></a>
                            <a href=".route('tableStudent')."><button class='px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600'>Bilan des élèves</button></a>
                            <a href=".route('abilities.index')."><button class='px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600'>Gestion des aptitudes</button></a>
                            ";
                    }
                    if($trainingManager->count == 1){
                        echo "
                            <a href=".route('calendar.calendarDirector')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600'>Consulter l'emploi du temps de votre formation</button></a>
                            <a href=".route('listStudentsInitiators')."><button class='px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600'>Visualiser les initiateurs et élèves de la formation</button></a>
                            <a href=".route('formationUnique')."><button class='px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600'>Votre formation</button></a>
                            ";
                    }
                    if($initiator->count == 1){
                        echo "
                            <a href=".route('calendar.calendarInitiator')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600'>Consulter vos séances</button></a>
                            ";
                    }
                    if($student->count == 1){
                        echo "
                            <a href=".route('tableAbilities')."><button class='px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600'>Mon bilan de la formation</button></a>
                            <a href=".route('calendar.calendarStudents')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600'>Consulter vos séances</button></a>
                            ";
                    }
                ?>
                <a href="/profile">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Profil</button>
                </a>
                <a href="/logout">
                    <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Déconnexion</button>
                </a>
            </div>
        </div>
    </menu>
</header>
