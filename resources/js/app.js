import './bootstrap';
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('[data-mobile-menu-button]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    const mobileMenuOverlay = document.querySelector('[data-mobile-menu-overlay]');

    mobileMenuButton.addEventListener('click', () => {
        const isOpen = mobileMenu.style.display === 'block';
        mobileMenu.style.display = isOpen ? 'none' : 'block';
        mobileMenuOverlay.style.display = isOpen ? 'none' : 'block';
    });

    mobileMenuOverlay.addEventListener('click', () => {
        mobileMenu.style.display = 'none';
        mobileMenuOverlay.style.display = 'none';
    });
});