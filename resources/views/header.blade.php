<header>
    <menu>
        <div class="flex items-center justify-between p-4 bg-gray-100">
            <img src="./img/logo.png" alt="logo" class="w-16 h-16">
            <div class="flex space-x-4">
                
                
                @guest
                    <a href="home.blade.php">  <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Conexion</button> </a>
               
                @endguest
               @auth
                    <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Profil</button>
                    <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Déconnexion</button>
                    <?php
                       $infos = DB::select('select * from persons where id_per = :id', ['id' => $id])[0];
                        dd($infos)
                    ?> 
                @endauth
            </div>
        </div>    
    </menu>

</header>