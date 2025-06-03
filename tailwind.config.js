/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    './assets/**/*.{js,ts,scss}',
    './**/*.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [require('@tailwindcss/typography')],
}
