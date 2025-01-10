<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Séance de Plongée</title>
    <!-- Lien CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/tailwind.config.js"></script>
</head>
<body>

    @include('header')
    <!-- Texte de bienvenue ou d'introduction -->
    <section class="bg-blue-600 text-white text-center py-12">
        <h1 class="text-3xl font-semibold">Détails de la Séance de Plongée</h1>
    </section>

    <!-- Contenu de la séance -->
    <section class="flex justify-center py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Séance du {{ $dateSession }} </h2>
            <p class="text-lg"><strong>Initiateur :</strong> {{ $initiator->name }} {{ $initiator->surname }}</p>
            <p class="text-lg mt-2"><strong>Aptitudes à travailler :</strong></p>
            <ul class="list-disc pl-5 mt-2 text-lg">
                @foreach ($abilities as $ability)
                    <li>{{ $ability->description }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    @include('footer')
</body>
</html>
