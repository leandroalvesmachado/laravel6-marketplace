@extends('layouts.app')

@section('content')

<h1>Criar Produto</h1>

<form action="{{ route('admin.products.store') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label>Nome Produto</label>
        <input type="text" name="name" id="" class="form-control">
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" id="" class="form-control">
    </div>

    <div class="form-group">
        <label>Conteúdo</label>
        <textarea name="body" id="" cols="30" rows="5" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Preço</label>
        <input type="text" name="price" id="" class="form-control">
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" id="" class="form-control">
    </div>

    <div class="form-group">
        <label>Lojas</label>
        <select name="user" id="" class="form-control">
            @foreach ($stores as $store)
            <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-large btn-success">Criar Produto</button>
    </div>
</form>

@endsection