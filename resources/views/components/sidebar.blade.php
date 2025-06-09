<aside class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
            <span class="logo-text">Gestion Stages</span>
        </a>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav-links">
            @auth
                @if(auth()->user()->role === 'student')
                    <li class="nav-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('student.dashboard') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('student.applications.*') ? 'active' : '' }}">
                        <a href="{{ route('student.applications.index') }}" class="nav-link">
                            <i class="fas fa-file-alt"></i>
                            <span>Mes candidatures</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-search"></i>
                            <span>Rechercher des offres</span>
                        </a>
                    </li>
                    
                @elseif(auth()->user()->role === 'teacher')
                    <li class="nav-item {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-signature"></i>
                            <span>Conventions à valider</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Étudiants encadrés</span>
                        </a>
                    </li>
                    
                @elseif(auth()->user()->role === 'company')
                    <li class="nav-item {{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('company.dashboard') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('company.offers.index') ? 'active' : '' }}">
                        <a href="{{ route('company.offers.index') }}" class="nav-link">
                            <i class="fas fa-briefcase"></i>
                            <span>Mes offres</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('company.applications.index') ? 'active' : '' }}">
                        <a href="{{ route('company.applications.index') }}" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Candidatures reçues</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('company.offers.create') ? 'active' : '' }}">
                        <a href="{{ route('company.offers.create') }}" class="nav-link">
                            <i class="fas fa-plus-circle"></i>
                            <span>Publier une offre</span>
                        </a>
                    </li>
                @endif
                
                <!-- Liens communs -->
                <li class="nav-item mt-auto">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link" style="background: none; border: none; width: 100%; text-align: left; cursor: pointer;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
</aside>

<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 250px;
    background-color: var(--primary-color);
    color: white;
    display: flex;
    flex-direction: column;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.sidebar-header {
    padding: 1.5rem 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.logo {
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    font-size: 1.25rem;
    font-weight: 600;
}

.logo-img {
    height: 32px;
    margin-right: 10px;
}

.sidebar-nav {
    flex: 1;
    overflow-y: auto;
    padding: 1rem 0;
}

.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.nav-item {
    margin: 0.25rem 0.5rem;
    border-radius: 4px;
    overflow: hidden;
}

.nav-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.nav-item.active {
    background-color: var(--secondary-color);
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: all 0.2s;
}

.nav-link i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
}

.nav-link:hover {
    color: white;
    padding-left: 1.25rem;
}

.nav-item.active .nav-link {
    color: white;
    font-weight: 500;
}

/* Scrollbar personnalisée */
.sidebar-nav::-webkit-scrollbar {
    width: 6px;
}

.sidebar-nav::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}

.sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}
</style>
