import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                15: '3.75rem',
            },
            screens: {
                lsm: { max: '640px' },
                lmd: { max: '768px' },
                llg: { max: '1024px' },
                lxl: { max: '1280px' },
            },
        },
    },

    plugins: [forms],
};
