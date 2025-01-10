<header class="z-50 top-0 w-full shadow">
    <nav class="max-w-5xl mx-auto p-6 flex items-center justify-between flex-wrap">
       
        <a href="/">
            <img style="float" src="../img/logo.png" alt="logo" class="w-16 h-16">
        </a>

        
        <button id="burger" class="block md:hidden focus:outline-none">
            <span class="hamburger-line bg-gray-800 block w-6 h-0.5 mb-1 gap-6"></span>
            <span class="hamburger-line bg-gray-800 block w-6 h-0.5 mb-1"></span>
            <span class="hamburger-line bg-gray-800 block w-6 h-0.5"></span>
        </button>

     <ul id="menu" class="hidden md:flex flex-col md:flex-row items-center gap-4 bg-gray-100 md:bg-transparent  p-5 w-full ">
            <?php
                $id = Auth::id();
                
                $technicalDirectors = DB::select('select count(*) as count from technical_directors where id_per = :id', ['id' => $id])[0];
                $trainingManager = DB::select('select count(*) as count from training_managers where id_per = :id', ['id' => $id])[0];
                $initiator = DB::select('select count(*) as count from initiators where id_per = :id', ['id' => $id])[0];
                $student = DB::select('select count(*) as count from students where id_per = :id', ['id' => $id])[0];
              
                if ($technicalDirectors->count == 1) {
                    echo "
                        <li><a href=".route('liste')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 m-2'>Liste des utilisateurs</button></a></li>
                        <li><a href=".route('formation')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 m-2'>Liste des formations</button></a></li>
                        <li><a href=".route('tableStudent')."><button class='px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 m-2'>Bilan des élèves</button></a></li>";
                }
                if ($trainingManager->count == 1) {
                    echo "
                        <li><a href=".route('calendar.calendarDirector')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 m-2'>Consulter l'emploi du temps de votre formation</button></a></li>";
                }
                if ($initiator->count == 1) {
                    echo "
                        <li><a href=".route('calendar.calendarInitiator')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 m-2'>Consulter vos séances</button></a></li>";
                }
                if ($student->count == 1) {
                    echo "
                        <li><a href=".route('tableAbilities')."><button class='px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 m-2'>Mon bilan de la formation</button></a></li>
                        <li><a href=".route('calendar.calendarStudents')."><button class='px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 m-2'>Consulter vos séances</button></a></li>";
                }
            ?>
            <li><a href="/profile"><button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 m-2">Profil</button></a></li>
            <li><a href="/logout"><button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 m-2">Déconnexion</button></a></li>
        </ul>
    </nav>
</header>


