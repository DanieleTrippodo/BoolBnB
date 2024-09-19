@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1>Messaggi ricevuti:</h1>

        @if ($messages->isEmpty())
            <p>Non hai ricevuto messaggi.</p>
        @else
            @foreach ($messages->groupBy('apartment_id') as $apartmentId => $apartmentMessages)
                <h2 class="message-header">{{ $apartmentMessages->first()->apartment->title }}</h2>

                <div class="table-responsive message-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mittente</th>
                                <th>Email del Mittente</th>
                                <th>Messaggio</th>
                                <th class="date-column">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apartmentMessages as $message)
                                <tr>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->sender_email }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td class="date-column">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif
    </div>
@endsection

<style>
    body {
        background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62);
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    .container {
        padding: 2rem;
    }

    h1 {
        font-weight: bold;
        font-size: 2rem;
    }

    .message-container {
        background-color: #ffffff;
        border-radius: 1.5rem;
        box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
        border-left: 0.5rem solid #1e88e5;
        transition: all 0.3s ease-in-out;
        overflow-x: auto;
    }

    .message-header {
        font-size: 2rem;
        color: #1e88e5;
        font-weight: bold;
        margin-bottom: 1.5rem;
    }

    .table {
        width: 100%;
    }

    .table th,
    .table td {
        padding: 1rem;
        font-size: 1rem;
        text-align: left;
        vertical-align: top;
        border-bottom: 1px solid #ddd;
        word-wrap: break-word;
    }

    .table th {
        background-color: #1e88e5 !important;
        color: #fff !important;
        font-size: 1.2rem;
        text-transform: uppercase;
    }

    .table td {
        font-size: 1rem;
    }

    .message-button {
        background-color: #1e88e5;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 2rem;
        text-decoration: none;
        font-size: 1rem;
        transition: background-color 0.3s ease-in-out;
    }

    @media (max-width: 768px) {
        .table td {
            word-wrap: break-word;
            white-space: normal;
        }

        .message-container {
            padding: 1rem;
        }
    }

    @media (max-width: 790px) {
        .date-column {
            display: none;
        }
    }
</style>
