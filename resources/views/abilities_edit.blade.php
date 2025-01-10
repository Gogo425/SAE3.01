<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des aptitudes</title>
    <!-- Lien CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    @include('header')

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Gestion des aptitudes</h1>

         <!-- Menu pour sélectionner le niveau -->
         <form action="{{ route('abilities.index') }}" method="GET" class="mb-6">
            <label for="level" class="block text-sm font-medium text-gray-700">Choisissez un niveau :</label>
            <select id="level" name="level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="2" {{ request('level') == 2 ? 'selected' : '' }}>Niveau 1</option>
                <option value="3" {{ request('level') == 3 ? 'selected' : '' }}>Niveau 2</option>
                <option value="4" {{ request('level') == 4 ? 'selected' : '' }}>Niveau 3</option>
            </select>
            <button type="submit" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
                Charger
            </button>
        </form>

        {{-- Grouper les abilities par skill --}}
        @php
            $groupedAbilities = $abilities->groupBy('skill_id');
        @endphp

        @foreach($groupedAbilities as $skillId => $abilitiesGroup)
            {{-- Afficher le nom du skill --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-blue-600 mb-4">
                    {{ $abilitiesGroup->first()->skill_description }}
                </h2>

                <ul class="space-y-4">
                    @foreach($abilitiesGroup as $ability)
                        <li class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <form action="{{ route('abilities.update', $ability->ability_id) }}" method="POST" class="flex items-center space-x-4">
                                @csrf
                                @method('PUT')

                                {{-- Champ pour modifier le nom de l'ability --}}
                                <div class="flex-1">
                                    <label for="ability_name_{{ $ability->ability_id }}" class="block text-sm font-medium text-gray-700">Nom de l'aptitude :</label>
                                    <input type="text" id="ability_name_{{ $ability->ability_id }}" name="description" value="{{ $ability->ability_description }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                </div>

                                {{-- Bouton de soumission --}}
                                <div>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition">
                                        Sauvegarder
                                    </button>
                                </div>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    @include('footer')
</body>
</html>
