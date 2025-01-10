<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formation Plongée - Elèves et Initiateurs</title>
    <!-- Lien CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    @include('header')
    <!-- Texte de bienvenue ou d'introduction -->
    <section class="bg-blue-600 text-white text-center py-12">
        <h1 class="text-3xl font-semibold">Formation Plongée - Elèves et Initiateurs</h1>
        <p class="text-lg mt-4">Liste des élèves et des initiateurs de la formation en plongée.</p>
    </section>

    <!-- Contenu principal -->
    <section class="py-8 px-4">
        <!-- Section des élèves -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-2xl sm:text-3xl font-semibold text-blue-600 mb-4">Élèves de la formation</h2>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-blue-100 text-left">
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Nom de l'élève</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Email</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Numéro de licence</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Date de certificate médical</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Date de naissance</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Adresse</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="border-b border-gray-200">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $student->NAME }} {{ $student->SURNAME }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $student->EMAIL }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $student->LICENCE_NUMBER }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $student->MEDICAL_CERTIFICATE_DATE }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $student->BIRTH_DATE }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $student->ADRESS }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section des initiateurs -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl sm:text-3xl font-semibold text-blue-600 mb-4">Initiateurs de la formation</h2>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-blue-100 text-left">
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Nom de l'initiateur</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Email</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Numéro de licence</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Date de certificate médical</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Date de naissance</th>
                        <th class="px-6 py-4 text-sm font-medium text-gray-900">Adresse</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($initiators as $initiator)
                        <tr class="border-b border-gray-200">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $initiator->NAME }} {{ $initiator->SURNAME }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $initiator->EMAIL }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $initiator->LICENCE_NUMBER }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $initiator->MEDICAL_CERTIFICATE_DATE }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $initiator->BIRTH_DATE }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $initiator->ADRESS }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @include('footer')
</body>
</html>
