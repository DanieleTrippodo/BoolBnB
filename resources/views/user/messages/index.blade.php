@extends('layouts.admin')

@section('content')
<div class="container">
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
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartmentMessages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->sender_email }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
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
        background: linear-gradient(135deg, #f8f9fa, #ffc0cb, #0a3d62) !important;
        font-family: 'Roboto', sans-serif !important;
        color: #333 !important;
    }

    .container {
        margin-top: 30px !important;
        max-width: 1200px !important;
        padding: 0 15px !important;
    }

    .message-container {
    background-color: #ffffff !important;
    border-radius: 15px !important;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1) !important;
    padding: 25px !important;
    margin-bottom: 25px !important;
    border-left: 5px solid #1e88e5 !important;
    border-right: 5px solid transparent !important;
    border-bottom: 5px solid transparent !important;
    border-image: linear-gradient(135deg, #1e88e5, #1565c0) 1 !important;
    transition: all 0.3s ease-in-out !important;
}


    .message-container:hover {
        border-left: 5px solid #1565c0 !important;
        transform: translateY(-5px) !important;
    }

    .message-header {
        font-size: 26px !important;
        color: #1e88e5 !important;
        font-weight: bold !important;
        margin-bottom: 15px !important;
    }

    .table {
        border-radius: 10px !important;
        overflow: hidden !important;
    }

    .table th, .table td {
        padding: 18px !important;
        text-align: left !important;
        vertical-align: top !important;
        border-bottom: 1px solid #ddd !important;
    }

    .table th {
        background-color: #1e88e5 !important;
        color: #fff !important;
        font-size: 16px !important;
        text-transform: uppercase !important;
        border-radius: 0 !important;
    }

    .table td {
        font-size: 15px !important;
        border-radius: 0 !important;
    }

    .table tr {
        transition: background-color 0.3s ease-in-out !important;
    }

    .table tr:hover {
        background-color: #e3f2fd !important;
        border-radius: 10px !important;
    }

    .message-button {
        background-color: #1e88e5 !important;
        color: white !important;
        padding: 12px 20px !important;
        border-radius: 20px !important;
        text-decoration: none !important;
        font-size: 15px !important;
        transition: background-color 0.3s ease-in-out !important;
    }

    .message-button:hover {
        background-color: #1565c0 !important;
    }
</style>

