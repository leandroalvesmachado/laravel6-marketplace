@extends('layouts.app')

@section('content')

<h1>Criar Loja</h1>

<form action="{{ route('admin.stores.store') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label>Nome Loja</label>
        <input type="text" name="name" id="" class="form-control">
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" id="" class="form-control">
    </div>
    <div class="form-group">
        <label>Telefone</label>
        <input type="text" name="phone" id="" class="form-control">
    </div>
    <div class="form-group">
        <label>Celular</label>
        <input type="text" name="mobile_phone" id="" class="form-control">
    </div>
    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" id="" class="form-control">
    </div>
    <div class="form-group">
        <label>Usuário</label>
        <select name="user" id="" class="form-control">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-large btn-success">Criar Loja</button>
    </div>
</form>

@endsection