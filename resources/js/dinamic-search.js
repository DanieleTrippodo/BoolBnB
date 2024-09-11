document.addEventListener('DOMContentLoaded', function () {
    const locationInput = document.getElementById('location');

    // Ascolta l'evento "input" sul campo location
    locationInput.addEventListener('input', function () {
        const location = locationInput.value;

        // Se l'utente ha inserito almeno un carattere, invia la richiesta AJAX
        if (location.length > 0) {
            fetch(`{{ route('guest.search') }}?location=${location}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Recupera l'elemento che contiene la lista degli appartamenti
                const apartmentList = document.getElementById('apartment-list');

                // Se ci sono appartamenti disponibili, aggiornali
                if (data.apartments.length > 0) {
                    let html = '<ul>';
                    data.apartments.forEach(apartment => {
                        html += `<li><a href="/guest/apartment/${apartment.id}">${apartment.title}</a></li>`;
                    });
                    html += '</ul>';
                    apartmentList.innerHTML = html;
                } else {
                    // Se nessun appartamento corrisponde alla ricerca, mostra un messaggio
                    apartmentList.innerHTML = '<p>Nessun appartamento trovato.</p>';
                }
            })
            .catch(error => console.error('Errore:', error));
        } else {
            // Se il campo è vuoto, ripristina lo stato iniziale
            document.getElementById('apartment-list').innerHTML = '<p>Nessun appartamento trovato.</p>';
        }
    });
});
