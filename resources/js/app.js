import './bootstrap';

//importa il nostro custom SCSS
import '~resources/scss/app.scss';

//prende il JS di Bootstrap
import * as bootstrap from 'bootstrap';


// ? ----------Importazioni Immagini----------------
// per creare una scorciatoia per l'importazione di immagini
import.meta.glob([
    '../img/**'
]);
/*
*   How to use Image import:
*
*   <img src="{{ vite::asset('resources/img/NAMEIMG.jpg') }}" alt="NAME">
*
*/
// ? ----------Importazioni Immagini----------------

