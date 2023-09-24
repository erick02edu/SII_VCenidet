import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';


export default defineConfig({


    // theme: {
    //     extend: {
    //         // Define tu tema oscuro
    //         darkSelector: '.dark-mode',
    //         dark: {
    //             // Define tus colores, tipografía, etc., para el tema oscuro
    //         },
    //     },
    // },

    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
