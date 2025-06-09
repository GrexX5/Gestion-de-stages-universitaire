<footer class="footer">
    <div class="footer-content">
        <span>&copy; {{ date('Y') }} Gestion de Stages Universitaire. Tous droits réservés.</span>
        <span class="footer-links">
            <a href="#">Mentions légales</a> · <a href="#">Contact</a>
        </span>
    </div>
</footer>
<style>
.footer {
    width: 100%;
    background: var(--primary-color);
    color: #fff;
    padding: 1rem 0;
    text-align: center;
    font-size: 0.95rem;
    position: relative;
    bottom: 0;
    margin-top: 2rem;
}
.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: center;
    justify-content: center;
}
.footer-links a {
    color: #fff;
    margin: 0 0.25rem;
    text-decoration: underline;
    opacity: 0.85;
    transition: opacity 0.2s;
}
.footer-links a:hover {
    opacity: 1;
}
</style>
