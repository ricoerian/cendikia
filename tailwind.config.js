import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    '50': '#f0f4f4',
                    '100': '#dce5e6',
                    '200': '#bacbcc',
                    '300': '#98b1b3',
                    '400': '#769799',
                    '500': '#5b7e80',
                    '600': '#486567',
                    '700': '#384f51',
                    '800': '#2c3e40',
                    '900': '#253436',
                    '950': '#042227', // <- Warna utama
                },
                secondary: {
                    '50': '#eef6f7',
                    '100': '#d9ebee',
                    '200': '#b5d8de',
                    '300': '#90c5ce',
                    '400': '#5aaabe',
                    '500': '#3c92a3',
                    '600': '#0D7183', // <- Warna utama
                    '700': '#0b5b6a',
                    '800': '#0a4d59',
                    '900': '#09414c',
                    '950': '#062c34',
                },
                third: {
                    '50': '#fefef3',
                    '100': '#fcfbe2',
                    '200': '#faf8c5',
                    '300': '#f7f29e',
                    '400': '#f2ea71',
                    '500': '#ede253',
                    '600': '#D6CC48', // <- Warna utama
                    '700': '#bdae36',
                    '800': '#9a8d2f',
                    '900': '#7f742c',
                    '950': '#4a4315',
                }
            }
        },
    },

    plugins: [forms],
};
