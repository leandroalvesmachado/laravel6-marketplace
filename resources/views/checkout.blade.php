@extends('layouts.front')

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
                    <label>Número do Cartão</label>
                    <input type="text" name="card_number" id="" class="form-control">
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
            </div>
            <button class="btn btn-success btn-lg">Efetuar Pagamento</button>
        </form>
    </div>
</div>

@endsection