import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const path = require('path')

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],



    // Aggiungiamo un alias per la cartella /resource/
    resolve:{
        alias:{
            '~resources': '/resources/',
            '~bootstrap' : path.resolve(__dirname, 'node_modules/bootstap'),
        }
    },



});
