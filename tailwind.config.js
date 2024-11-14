/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './assets/js/*.js'],
  theme: {
    extend: {
      ringColor: {
        DEFAULT: 'transparent',
      },
      boxShadow: {
        DEFAULT: 'none',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

