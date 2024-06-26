/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
        colors: {
        'theme-green-color': '#4ec590',
      },
    },
  },
  plugins: [
    require('flowbite/plugin'),
  ],
}

