document.addEventListener('DOMContentLoaded', () => {
  const header = document.querySelector('[data-site-header]');

  if (!header) {
    return;
  }

  const menuToggle = header.querySelector('[data-menu-toggle]');
  const mobileMenu = header.querySelector('[data-mobile-menu]');
  const mobileMenuLinks = header.querySelectorAll('[data-mobile-menu-link]');
  const desktopMediaQuery = window.matchMedia('(min-width: 1024px)');

  const setScrolledState = () => {
    header.classList.toggle('is-scrolled', window.scrollY > 40);
  };

  const setMenuState = (isOpen, returnFocus = false) => {
    header.classList.toggle('is-menu-open', isOpen);
    document.body.classList.toggle('menu-open', isOpen);
    menuToggle.setAttribute('aria-expanded', String(isOpen));
    menuToggle.setAttribute('aria-label', isOpen ? 'Fermer le menu' : 'Ouvrir le menu');
    mobileMenu.setAttribute('aria-hidden', String(!isOpen));
    mobileMenu.inert = !isOpen;

    if (returnFocus) {
      menuToggle.focus();
    }
  };

  setScrolledState();
  window.addEventListener('scroll', setScrolledState, { passive: true });

  menuToggle.addEventListener('click', () => {
    setMenuState(menuToggle.getAttribute('aria-expanded') !== 'true');
  });

  mobileMenuLinks.forEach((link) => {
    link.addEventListener('click', () => setMenuState(false));
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && menuToggle.getAttribute('aria-expanded') === 'true') {
      setMenuState(false, true);
    }
  });

  desktopMediaQuery.addEventListener('change', (event) => {
    if (event.matches) {
      setMenuState(false);
    }
  });
});
