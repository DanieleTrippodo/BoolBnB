@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Messaggi ricevuti</h1>

    @if ($messages->isEmpty())
        <p>Non hai ricevuto messaggi.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Appartamento</th>
                        <th>Mittente</th>
                        <th>Email del Mittente</th>
                        <th>Messaggio</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ $message->apartment->title }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->sender_email }}</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
