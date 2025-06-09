@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Gestion de Stages Universitaires</h1>
                    <p class="text-xl mb-8">Une plateforme complète pour gérer les stages, les étudiants et les entreprises partenaires.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="bg-white text-blue-700 hover:bg-blue-100 font-semibold py-3 px-8 rounded-lg text-center transition duration-300">
                            Commencer maintenant
                        </a>
                        <a href="#features" class="bg-transparent border-2 border-white hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg text-center transition duration-300">
                            En savoir plus
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="{{ asset('images/hero-illustration.svg') }}" alt="Gestion de stages" class="w-full max-w-lg mx-auto">
                </div>
            </div>
        </div>
    </section>



    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Fonctionnalités principales</h2>
                <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Découvrez comment notre plateforme simplifie la gestion des stages
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Gestion des offres</h3>
                    <p class="text-gray-600">Publiez et gérez facilement les offres de stage proposées par les entreprises partenaires.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Suivi des étudiants</h3>
                    <p class="text-gray-600">Assurez un suivi personnalisé de chaque étudiant tout au long de son stage.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Rapports détaillés</h3>
                    <p class="text-gray-600">Générez des rapports détaillés pour évaluer les performances et les progrès.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-blue-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl mb-6">
                Prêt à commencer ?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Rejoignez dès maintenant notre plateforme et simplifiez la gestion des stages de votre établissement.
            </p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg text-lg font-medium hover:bg-blue-50 transition duration-300">
                Créer un compte
            </a>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-white">Gestion de Stages</h3>
                    <p class="text-gray-400">La solution tout-en-un pour gérer efficacement les stages universitaires.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Accueil</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Fonctionnalités</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Compte</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition">S'inscrire</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <p class="text-gray-400">Email: contact@gestion-stages.fr</p>
                    <p class="text-gray-400">Tél: +33 1 23 45 67 89</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Gestion de Stages. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</div>
@endsection
