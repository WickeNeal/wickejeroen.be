/** @type {import('tailwindcss').Config} */
export default {
  darkMode: "class",
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php"
  ],
  theme: {
    extend: {
        colors: {
            "primary": "#d4b280", // Warm Beige/Tan
            "background-light": "#F5F5DC", // Beige
            "background-dark": "#1a1a1a", // Near-black
            "text-light": "#36454F", // Charcoal on light bg
            "text-dark": "#F5F5DC", // Beige on dark bg
        },
        fontFamily: {
            "display": ["'Oswald'", "sans-serif"], // For headings
            "body": ["'Montserrat'", "sans-serif"], // For body text
        },
        borderRadius: {
            "DEFAULT": "0.25rem",
            "lg": "0.5rem",
            "xl": "0.75rem",
            "full": "9999px"
        },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/container-queries'),
  ],
}
