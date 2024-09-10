@extends('layouts.admin')

@section('content'){{-- test2 --}}

<body>
<div class="container">
    <div class="row">
        @foreach ($apartments as $apartment)
            <div class="col-md-4">
                <div class="card mb-3" style="width: 80%;">
                    @if ($apartment->image) {{-- Se è disponibile la foto dell'appartamento --}}
                        <img src="{{ asset('storage/' . $apartment->image) }}" class="card-img-top" alt="Missing">
                    @else
                        <img src="..." class="card-img-top" alt="Placeholder_Image"> {{-- Inserire immagine placeholder --}}
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                    </div>

                    <div class="card-footer">
                        <div class="btn-group" role="group"> {{-- Azioni per appartamento --}}
                            <a href="{{ route('user.apartments.show', $apartment->id) }}" class="btn btn-primary me-1">Visualizza</a>
                            <a href="{{ route('user.apartments.edit', $apartment->id) }}" class="btn btn-primary me-1">Modifica</a>

                            <form id="delete-form-{{ $apartment->id }}" action="{{ route('user.apartments.destroy', $apartment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $apartment->id }})">Elimina</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>


<script>
    function confirmDelete(apartmentId) {
        Swal.fire({
            title: 'Sei sicuro di voler eliminare questo appartamento?',
            text: "Questa azione non può essere annullata!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sì, elimina!',
            cancelButtonText: 'Annulla'
        }).then((result) => {
            if (result.isConfirmed) {
                // Invia il form di cancellazione
                document.getElementById('delete-form-' + apartmentId).submit();
            }
        });
    }
</script>
