document.addEventListener('DOMContentLoaded', () => {
  const header = document.querySelector('[data-site-header]');

  if (!header) {
    return;
  }

  const menuToggle = header.querySelector('[data-menu-toggle]');
  const mobileMenu = header.querySelector('[data-mobile-menu]');
  const mobileMenuLinks = header.querySelectorAll('[data-mobile-menu-link]');
  const desktopMediaQuery = window.matchMedia('(min-width: 1024px)');
  const pageRegions = Array.from(document.body.children).filter(
    (element) => element !== header && !['SCRIPT', 'STYLE'].includes(element.tagName)
  );
  const previousInertStates = new Map();

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

    pageRegions.forEach((region) => {
      if (isOpen) {
        previousInertStates.set(region, region.inert);
        region.inert = true;
      } else if (previousInertStates.has(region)) {
        region.inert = previousInertStates.get(region);
      }
    });

    if (!isOpen) {
      previousInertStates.clear();
    }

    if (isOpen) {
      const firstMenuLink = mobileMenu.querySelector('a[href]');
      firstMenuLink?.focus();
    }

    if (returnFocus) {
      menuToggle.focus();
    }
  };

  setScrolledState();
  window.addEventListener('scroll', setScrolledState, { passive: true });

  menuToggle.addEventListener('click', () => {
    const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
    setMenuState(!isOpen, isOpen);
  });

  mobileMenuLinks.forEach((link) => {
    link.addEventListener('click', () => setMenuState(false, true));
  });

  document.addEventListener('keydown', (event) => {
    const isMenuOpen = menuToggle.getAttribute('aria-expanded') === 'true';

    if (event.key === 'Escape' && isMenuOpen) {
      setMenuState(false, true);
    }

    if (event.key === 'Tab' && isMenuOpen) {
      const focusableElements = [
        menuToggle,
        ...mobileMenu.querySelectorAll('a[href], button:not([disabled]), input:not([disabled])'),
      ];
      const firstFocusable = focusableElements[0];
      const lastFocusable = focusableElements[focusableElements.length - 1];

      if (event.shiftKey && document.activeElement === firstFocusable) {
        event.preventDefault();
        lastFocusable.focus();
      } else if (!event.shiftKey && document.activeElement === lastFocusable) {
        event.preventDefault();
        firstFocusable.focus();
      }
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
        const maximumOffset = parallaxElement.offsetHeight * 0.035;
        const translatedOffset = Math.max(
          -maximumOffset,
          Math.min(maximumOffset, offset * -0.12)
        );

        parallaxElement.style.transform = `translateY(${translatedOffset}px) scale(1.08)`;
      });
    };

    updateParallax();
    window.addEventListener('scroll', updateParallax, { passive: true });
    window.addEventListener('resize', updateParallax, { passive: true });
  }
});
