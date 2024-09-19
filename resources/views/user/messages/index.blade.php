@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Messaggi ricevuti</h1>

    @if ($messages->isEmpty())
        <p>Non hai ricevuto messaggi.</p>
    @else
        @foreach ($messages->groupBy('apartment_id') as $apartmentId => $apartmentMessages)
            <h2>{{ $apartmentMessages->first()->apartment->title }}</h2> <!-- Titolo dell'appartamento -->

            <div class="table-responsive">
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
