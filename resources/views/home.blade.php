@extends('base')

@section('title', 'Accueil')

@section('content')
    <div class="container mx-auto px-4 py-6 sm:px-6 md:px-8 lg:px-12 xl:px-16 ml-6 sm:ml-12 md:ml-16 lg:ml-20 xl:ml-24">
        <!-- Titre de bienvenue -->
        <p class="text-4xl text-center font-bold text-blue-600 mb-6">
            Bienvenue {{ Auth::user()->name }}
        </p>

        <!-- Section sur la FFESSM -->
        <section class="mb-8">
            <p class="text-2xl font-semibold text-blue-700 mb-4">Qu'est-ce que la FFESSM ?</p>
            <p class="text-lg text-gray-800 leading-relaxed mb-6">
                La FFESSM (Fédération Française d'Études et de Sports Sous-Marins) est une organisation qui s’occupe de tout ce qui concerne les activités subaquatiques en France. Cela inclut des sports comme la plongée sous-marine, l’apnée, la nage avec palmes, ou encore des disciplines plus spécifiques comme le hockey subaquatique, la chasse sous-marine, ou l’archéologie sous-marine.
            </p>
        </section>

        <!-- Section sur les objectifs -->
        <section class="mb-8">
            <p class="text-2xl font-semibold text-blue-700 mb-4">Nos objectifs</p>
            <p class="text-lg text-gray-800 leading-relaxed mb-6">
                Nos objectifs sont de former les pratiquants, organiser des examens et délivrer des diplômes reconnus pour diverses activités subaquatiques. Nous encourageons la pratique de ces activités via un réseau de clubs, d'événements et de compétitions. Nous protégeons également l'environnement marin afin de sensibiliser les pratiquants à la préservation des océans et de leur biodiversité.
            </p>
        </section>

        <!-- Section avec des informations supplémentaires ou autres textes -->
        <section>
            <p class="text-xl font-medium text-gray-700 mb-4">Les avantages de la FFESSM</p>
            <p class="text-lg text-gray-800 leading-relaxed mb-6">
                La FFESSM permet de promouvoir un environnement sécurisé et organisé pour les activités subaquatiques. Avec un réseau de professionnels, de formateurs certifiés, et une série d'événements réguliers, elle assure le développement de ces sports tout en garantissant la sécurité et la formation continue des pratiquants. De plus, nous favorisons des initiatives pour la protection de la faune et la flore marines.
            </p>
        </section>
    </div>
@endsection
