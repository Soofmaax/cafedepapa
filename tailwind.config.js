/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './woocommerce/**/*.php',
    './assets/js/**/*.js',
  ],

  theme: {
    extend: {
      colors: {
        coffee: {
          50: '#faf6f2',
          100: '#f1e7dc',
          200: '#e2ccba',
          300: '#cda989',
          400: '#b8835f',
          500: '#9a6638',
          600: '#7d4f2a',
          700: '#5f3d22',
          800: '#3d2817',
          900: '#241609',
          950: '#140b03',
        },

        cream: {
          50: '#fdfcf9',
          100: '#faf6ee',
          200: '#f4ebd9',
          300: '#ecdcbf',
          400: '#dcc59a',
          500: '#c9a872',
        },

        terracotta: {
          400: '#d08560',
          500: '#bd6b47',
          600: '#a25636',
          700: '#83452e',
        },

        forest: {
          500: '#3d5a3d',
          600: '#2f4a30',
          700: '#233822',
          800: '#1a2a19',
        },

        gold: {
          400: '#c9a24a',
          500: '#b08a32',
          600: '#92722a',
        },
      },

      fontFamily: {
        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
        sans: ['"Inter"', 'system-ui', 'sans-serif'],
      },

      letterSpacing: {
        widest2: '0.25em',
      },

      animation: {
        'fade-up': 'fadeUp 0.9s ease-out forwards',
        'fade-in': 'fadeIn 1.2s ease-out forwards',
      },

      keyframes: {
        fadeUp: {
          '0%': {
            opacity: '0',
            transform: 'translateY(28px)',
          },
          '100%': {
            opacity: '1',
            transform: 'translateY(0)',
          },
        },

        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
      },
    },
  },

  plugins: [],
};