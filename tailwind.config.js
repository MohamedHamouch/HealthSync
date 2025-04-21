/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          primary: {
            50: '#e6f7f7',
            100: '#ccefef',
            200: '#99dfdf',
            300: '#66cfcf',
            400: '#33bfbf',
            500: '#00aeae',
            600: '#00a0a0',
            700: '#008080',
            800: '#006060',
            900: '#004040',
          },
          secondary: {
            500: '#0891b2', /* cyan-600 */
          }
        },
        animation: {
          'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
        }
      }
    },
    plugins: [],
  }