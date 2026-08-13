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

  const revealElements = document.querySelectorAll('.reveal');

  if (!('IntersectionObserver' in window)) {
    revealElements.forEach((element) => element.classList.add('is-visible'));
  } else {
    const revealObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15 }
    );

    revealElements.forEach((element) => revealObserver.observe(element));
  }

  const parallaxElement = document.querySelector('[data-peru-parallax]');
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

  if (parallaxElement && !prefersReducedMotion.matches) {
    let parallaxFrame = 0;

    const updateParallax = () => {
      cancelAnimationFrame(parallaxFrame);
      parallaxFrame = requestAnimationFrame(() => {
        const rect = parallaxElement.getBoundingClientRect();
        const offset = rect.top + rect.height / 2 - window.innerHeight / 2;

        parallaxElement.style.transform = `translateY(${offset * -0.12}px) scale(1.08)`;
      });
    };

    updateParallax();
    window.addEventListener('scroll', updateParallax, { passive: true });
  }
});
