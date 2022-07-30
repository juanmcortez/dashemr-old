/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        container: {
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1280px',
                '2xl': '1280px',
            },
        },
        extend: {
            fontFamily: {
                sans: ['Amiko', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                twitter: '#00aaec',
                discord: '#7289da',
                facebook: '#4267b2',
                linkedin: '#2977c9',
            },
        },
    },
    variants: {
        extend: {
            opacity: ['disabled'],
            backgroundColor: ['active'],
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms"),
        require("daisyui"),
    ],
    daisyui: {
        logs: false,
        prefix: "dashemr",
        themes: [],
    },
}
