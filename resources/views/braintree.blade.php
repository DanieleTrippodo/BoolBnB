@extends('layouts.admin')

@section('content')
    <div class="py-12">
        @csrf
        <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
        <div style="display: flex;justify-content: center;align-items: center; color: white">
            <button id="submit-button" class="btn btn-sm btn-success">Procedi con il pagamento</button>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        const button = document.querySelector('#submit-button');
            braintree.dropin.create({
                authorization: '{{$token}}',
                container: '#dropin-container'
            }, function (createErr, instance) {
                button.addEventListener('click', function () {
                    instance.requestPaymentMethod(function (err, payload) {
                        (function($) {
                            $(function() {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: "POST",
                                    url: "{{route('token')}}",
                                    data: {nonce : payload.nonce},
                                    success: function (data) {
                                        console.log('success',payload.nonce)
                                    },
                                    error: function (data) {
                                        console.log('error',payload.nonce)
                                    }
                                });
                            });
                        });
                    });
                });
            });
    </script>
@endsection
