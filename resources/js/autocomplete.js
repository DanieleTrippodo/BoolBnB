document.addEventListener('DOMContentLoaded', function () {
    const apiKey = 'S14VN8AzM8BoQ73JkRu5N2PqtkZtrrjN';  // Inserisci qui la tua chiave API di TomTom
    const addressInput = document.getElementById('address');
    const suggestionsList = document.getElementById('suggestions-list');

    addressInput.addEventListener('input', function () {
        const query = this.value;

        if (query.length > 2) {
            // Effettua la richiesta all'API TomTom
            fetch(`https://api.tomtom.com/search/2/search/${encodeURIComponent(query)}.json?key=${apiKey}&language=it-IT&limit=5&resultSet=address`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Errore nella richiesta');
                    }
                    return response.json();
                })
                .then(data => {
                    suggestionsList.innerHTML = ''; // Svuota la lista dei suggerimenti

                    // Controlla se ci sono risultati
                    if (data.results && data.results.length > 0) {
                        // Filtra solo i risultati con `freeformAddress`
                        let suggestions = data.results
                            .filter(item => item.address && item.address.freeformAddress)
                            .map(item => item.address.freeformAddress);

                        suggestions.forEach(suggestion => {
                            let li = document.createElement('li');
                            li.textContent = suggestion;
                            li.style.cursor = 'pointer';

                            // Quando l'utente clicca su un suggerimento, l'indirizzo viene selezionato
                            li.addEventListener('click', function () {
                                addressInput.value = suggestion;
                                suggestionsList.innerHTML = ''; // Nascondi i suggerimenti dopo la selezione
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
    });
});
