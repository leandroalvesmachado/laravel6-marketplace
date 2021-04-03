@extends('layouts.front')

@section('stylesheets')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@endsection

@section('content')

<div class="container">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h2>Dados para Pagamento</h2>
                <hr>
            </div>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Nome no Cartão</label>
                    <input type="text" name="card_name" id="" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Número do Cartão <span class="brand"></span></label>
                    <input type="text" name="card_number" id="" class="form-control">
                    <input type="hidden" name="card_brand">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Mês de Expiração</label>
                    <input type="text" name="card_month" id="" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Ano de Expiração</label>
                    <input type="text" name="card_year" id="" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Código de Segurança</label>
                    <input type="text" name="card_cvv" id="" class="form-control">
                </div>
                <div class="form-group installments col-md-12">
                </dvi>
            </div>
            <button class="btn btn-success btn-lg processCheckout">Efetuar Pagamento</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    const sessionId = "{{ session()->get('pagseguro_session_code') }}";
    const urlThanks = "{{ route('checkout.thanks') }}";
    const urlProccess = "{{ route('checkout.proccess') }}";
    const amountTransaction = "{{ $cartItems }}";
    const csrf = "{{ csrf_token() }}";

    PagSeguroDirectPayment.setSessionId(sessionId);
</script>

<script src="{{ asset('js/pagseguro_functions.js') }}"></script>
<script src="{{ asset('js/pagseguro_events.js') }}"></script>

@endsection

