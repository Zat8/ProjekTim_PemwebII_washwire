import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['"Bebas Neue"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ink: '#111111',
                canvas: '#ffffff',
                'soft-cloud': '#f5f5f5',
                hairline: '#cacacb',
                'hairline-soft': '#e5e5e5',
                charcoal: '#39393b',
                ash: '#4b4b4d',
                mute: '#707072',
                stone: '#9e9ea0',
                sale: '#d30005',
                'sale-deep': '#780700',
                success: '#007d48',
                'success-bright': '#1eaa52',
            },
        },
    },

    plugins: [forms],
};
