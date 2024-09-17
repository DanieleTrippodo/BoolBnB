import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({

    /* Cambiare la vostra porta con quella del front-end */
    server:{
        port: 5174, /* fate npm run dev e cambiate la porta con quella che avete */
    },

    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
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
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    // server: {
    //     port: 5174,        // Imposta la porta fissa per Vite in Laravel (differente da quella di Vue.js)
    //     strictPort: true,  // Se la porta è occupata, Vite fallisce invece di usare una porta diversa
    //     hmr: {
    //         host: 'localhost',
    //     },
    // },
});
