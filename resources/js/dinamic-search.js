document.addEventListener('DOMContentLoaded', function () {
    const apiKey = 'S14VN8AzM8BoQ73JkRu5N2PqtkZtrrjN';  // Inserisci qui la tua chiave API di TomTom
    const locationInput = document.getElementById('location');
    const suggestionsList = document.createElement('ul');  // Lista dei suggerimenti
    const apartmentList = document.getElementById('apartment-list');
    let debounceTimeout;

    locationInput.parentNode.appendChild(suggestionsList); // Aggiungi la lista dei suggerimenti sotto il campo di input

    // Funzione debounce per limitare le richieste API quando l'utente digita
    function debounce(func, delay) {
        return function(...args) {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Funzione per eseguire la ricerca dinamica degli appartamenti
    function performSearch(location) {
        // Effettua una richiesta AJAX alla tua API o rotta di Laravel per la ricerca
        fetch(`/search?location=${encodeURIComponent(location)}`)
            .then(response => response.json())
            .then(data => {
                apartmentList.innerHTML = ''; // Svuota la lista dei risultati

                if (data.length > 0) {
                    data.forEach(result => {
                        let li = document.createElement('li');
                        li.innerHTML = `<a href="guest/apartment/${result.id}">${result.title}</a>`;
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

    // Funzione per ottenere i suggerimenti dalla API TomTom
    function getCitySuggestions() {
        const query = locationInput.value;

        if (query.length > 2) {
            // Effettua una richiesta all'API TomTom per ottenere i suggerimenti delle città
            fetch(`https://api.tomtom.com/search/2/search/${encodeURIComponent(query)}.json?key=${apiKey}&language=it-IT&typeahead=true&limit=5&entityType=Municipality`)
                .then(response => response.json())
                .then(data => {
                    suggestionsList.innerHTML = ''; // Svuota la lista dei suggerimenti

                    if (data.results && data.results.length > 0) {
                        // Filtra e mostra solo i risultati con `freeformAddress`
                        let suggestions = data.results
                            .filter(item => item.address && item.address.freeformAddress)
                            .map(item => item.address.freeformAddress);

                        suggestions.forEach(suggestion => {
                            let li = document.createElement('li');
                            li.textContent = suggestion;
                            li.style.cursor = 'pointer';

                            // Quando l'utente clicca su un suggerimento, esegue la ricerca
                            li.addEventListener('click', function () {
                                locationInput.value = suggestion;
                                suggestionsList.innerHTML = ''; // Nascondi i suggerimenti dopo la selezione
                                performSearch(suggestion);  // Esegui la ricerca degli appartamenti per la città selezionata
                            });

                            suggestionsList.appendChild(li);
                        });
                    }
                })
                .catch(error => {
                    console.error('Errore nel fetch:', error);
                });
        } else {
            suggestionsList.innerHTML = ''; // Nascondi i suggerimenti se non ci sono abbastanza caratteri
        }
    }

    // Aggiungi il debounce per la funzione di suggerimenti delle città
    locationInput.addEventListener('input', debounce(getCitySuggestions, 300));
});
