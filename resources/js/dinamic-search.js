document.addEventListener('DOMContentLoaded', function () {
    const locationInput = document.getElementById('location');
    const apartmentList = document.getElementById('apartment-list');
    let debounceTimeout;

    // Funzione debounce per limitare le richieste API quando l'utente digita
    function debounce(func, delay) {
        return function(...args) {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Funzione per eseguire la ricerca dinamica solo per la location
    function performSearch() {
        let location = locationInput.value;  // La città selezionata

        // Effettua una richiesta AJAX alla tua API o rotta di Laravel per la ricerca
        fetch(`/search?location=${encodeURIComponent(location)}`)
            .then(response => response.json())
            .then(data => {
                apartmentList.innerHTML = ''; // Svuota la lista dei risultati

                if (data.length > 0) {
                    data.forEach(result => {
                        let li = document.createElement('li');
                        li.innerHTML = `<a href="/appartamenti/${result.id}">${result.title}</a>`;
                        apartmentList.appendChild(li);
                    });
                } else {
                    apartmentList.innerHTML = '<li>Nessun appartamento trovato</li>';
                }
            })
            .catch(error => {
                console.error('Errore nella ricerca:', error);
            });
    }

    // Esegui la ricerca solo quando l'utente modifica la posizione
    locationInput.addEventListener('input', debounce(performSearch, 300));
});
