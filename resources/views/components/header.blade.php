<header class="header">
    <div class="header-content">
        <div class="header-left">
            <button class="menu-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="page-title">@yield('title', 'Tableau de bord')</h1>
        </div>
        
        <div class="header-right">
            <div class="notifications">
                <button class="notification-btn" id="notificationsBtn">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </button>
                <div class="notifications-dropdown" id="notificationsDropdown">
                    <div class="notifications-header">
                        <h3>Notifications</h3>
                        <button class="mark-all-read">Tout marquer comme lu</button>
                    </div>
                    <div class="notifications-list">
                        <a href="#" class="notification-item unread">
                            <div class="notification-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="notification-content">
                                <p class="notification-text">Votre candidature a été acceptée</p>
                                <span class="notification-time">Il y a 2 heures</span>
                            </div>
                        </a>
                        <a href="#" class="notification-item">
                            <div class="notification-icon">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="notification-content">
                                <p class="notification-text">Nouveau message de l'entreprise X</p>
                                <span class="notification-time">Il y a 1 jour</span>
                            </div>
                        </a>
                    </div>
                    <div class="notifications-footer">
                        <a href="#" class="view-all">Voir toutes les notifications</a>
                    </div>
                </div>
            </div>
            
            <div class="user-menu">
                <button class="user-menu-btn" id="userMenuBtn">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-dropdown" id="userDropdown">
                    <div class="user-info">
                        <div class="user-avatar large">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="user-details">
                            <h4>{{ Auth::user()->name }}</h4>
                            <span class="user-role">
                                @if(Auth::user()->role === 'student')
                                    Étudiant
                                @elseif(Auth::user()->role === 'teacher')
                                    Enseignant
                                @elseif(Auth::user()->role === 'company')
                                    Entreprise
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user"></i> Mon profil
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-cog"></i> Paramètres
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
.header {
    background-color: white;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 100;
    padding: 0.75rem 2rem;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1400px;
    margin: 0 auto;
}

.header-left {
    display: flex;
    align-items: center;
}

.menu-toggle {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--gray-600);
    cursor: pointer;
    margin-right: 1rem;
    padding: 0.5rem;
    border-radius: 4px;
    transition: all 0.2s;
}

.menu-toggle:hover {
    background-color: var(--gray-100);
    color: var(--primary-color);
}

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    color: var(--primary-color);
}

.header-right {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

/* Notifications */
.notifications {
    position: relative;
}

.notification-btn {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--gray-600);
    cursor: pointer;
    position: relative;
    padding: 0.5rem;
    border-radius: 4px;
    transition: all 0.2s;
}

.notification-btn:hover {
    background-color: var(--gray-100);
    color: var(--primary-color);
}

.badge {
    position: absolute;
    top: 0;
    right: 0;
    background-color: var(--danger-color);
    color: white;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.notifications-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    width: 350px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.2s;
    z-index: 1000;
}

.notifications:hover .notifications-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.notifications-header {
    padding: 1rem;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notifications-header h3 {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
}

.mark-all-read {
    background: none;
    border: none;
    color: var(--primary-color);
    font-size: 0.85rem;
    cursor: pointer;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
}

.mark-all-read:hover {
    background-color: rgba(44, 62, 80, 0.1);
}

.notifications-list {
    max-height: 400px;
    overflow-y: auto;
}

.notification-item {
    display: flex;
    padding: 1rem;
    text-decoration: none;
    color: var(--gray-800);
    transition: all 0.2s;
    border-left: 3px solid transparent;
}

.notification-item:hover {
    background-color: var(--gray-50);
}

.notification-item.unread {
    background-color: rgba(52, 152, 219, 0.05);
    border-left-color: var(--primary-color);
}

.notification-icon {
    margin-right: 1rem;
    color: var(--primary-color);
    font-size: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background-color: rgba(52, 152, 219, 0.1);
    border-radius: 50%;
}

.notification-content {
    flex: 1;
}

.notification-text {
    margin: 0 0 0.25rem 0;
    font-size: 0.9rem;
}

.notification-time {
    font-size: 0.8rem;
    color: var(--gray-500);
}

.notifications-footer {
    padding: 0.75rem 1rem;
    text-align: center;
    border-top: 1px solid var(--gray-200);
}

.view-all {
    color: var(--primary-color);
    font-size: 0.9rem;
    text-decoration: none;
    font-weight: 500;
}

.view-all:hover {
    text-decoration: underline;
}

/* User Menu */
.user-menu {
    position: relative;
}

.user-menu-btn {
    display: flex;
    align-items: center;
    background: none;
    border: 1px solid var(--gray-200);
    border-radius: 50px;
    padding: 0.25rem 0.5rem 0.25rem 0.25rem;
    cursor: pointer;
    transition: all 0.2s;
}

.user-menu-btn:hover {
    background-color: var(--gray-100);
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 0.5rem;
    font-size: 0.9rem;
}

.user-name {
    margin-right: 0.5rem;
    font-weight: 500;
    color: var(--gray-700);
}

.user-menu-btn i {
    font-size: 0.8rem;
    color: var(--gray-600);
}

.user-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    width: 280px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.2s;
    z-index: 1000;
    margin-top: 0.5rem;
}

.user-menu:hover .user-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.user-info {
    display: flex;
    align-items: center;
    padding: 1.25rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 8px 8px 0 0;
    color: white;
}

.user-avatar.large {
    width: 48px;
    height: 48px;
    font-size: 1.25rem;
    margin-right: 1rem;
}

.user-details h4 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
}

.user-role {
    font-size: 0.85rem;
    opacity: 0.9;
}

.dropdown-divider {
    height: 1px;
    background-color: var(--gray-200);
    margin: 0.5rem 0;
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.25rem;
    color: var(--gray-700);
    text-decoration: none;
    transition: all 0.2s;
    font-size: 0.95rem;
}

.dropdown-item i {
    margin-right: 0.75rem;
    color: var(--gray-500);
    width: 20px;
    text-align: center;
}

.dropdown-item:hover {
    background-color: var(--gray-50);
    color: var(--primary-color);
}

.dropdown-item:hover i {
    color: var(--primary-color);
}

/* Responsive */
@media (max-width: 992px) {
    .header {
        padding: 0.75rem 1rem;
    }
    
    .notifications-dropdown {
        right: -100px;
        width: 300px;
    }
    
    .user-name {
        display: none;
    }
    
    .user-menu-btn {
        padding: 0.25rem;
    }
    
    .user-avatar {
        margin-right: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar on mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        });
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        // Close notifications dropdown
        if (!event.target.closest('.notifications')) {
            const notificationsDropdown = document.getElementById('notificationsDropdown');
            if (notificationsDropdown) {
                notificationsDropdown.style.opacity = '0';
                notificationsDropdown.style.visibility = 'hidden';
                notificationsDropdown.style.transform = 'translateY(10px)';
            }
        }
        
        // Close user dropdown
        if (!event.target.closest('.user-menu')) {
            const userDropdown = document.getElementById('userDropdown');
            if (userDropdown) {
                userDropdown.style.opacity = '0';
                userDropdown.style.visibility = 'hidden';
                userDropdown.style.transform = 'translateY(10px)';
            }
        }
    });
});
</script>
