<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Appartamento - BoolBnB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #394C85;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .header a {
            color: white;
            text-decoration: none;
            font-size: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #32759E;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        .apartment-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .services {
            list-style-type: none;
            padding: 0;
        }

        .services li {
            background-color: #32759E;
            color: white;
            display: inline-block;
            padding: 5px 10px;
            margin-right: 10px;
            border-radius: 5px;
        }

    </style>
</head>
<body>

    <div class="header">
        <a href="/">BoolBnB</a>
    </div>

    <div class="container">
        <!-- Immagine dell'appartamento -->
        <div class="apartment-image">
            @if($apartment->images)
                <img src="{{ asset('storage/' . $apartment->images) }}" alt="Immagine dell'appartamento">
            @else
                <p>Immagine non disponibile.</p>
            @endif
        </div>

        <!-- Dettagli dell'appartamento -->
        <h2>{{ $apartment->title }}</h2>
        <p><strong>Indirizzo:</strong> {{ $apartment->address }}</p>


        <!-- Servizi dell'appartamento -->
        <p><strong>Servizi:</strong></p>
        <ul class="services">
            @if(is_array($apartment->services) && count($apartment->services) > 0)
                @foreach($apartment->services as $service)
                    <li>{{ $service }}</li>
                @endforeach
            @else
                <li>Nessun servizio disponibile.</li>
            @endif
        </ul>

        <p><strong>Descrizione:</strong> {{ $apartment->description }}</p>
    </div>

</body>
</html>
