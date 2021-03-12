@extends('layouts.app')

@section('content')

<h1>Criar Produto</h1>

<form action="{{ route('admin.products.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label>Nome Produto</label>
        <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label>Conteúdo</label>
        <textarea name="body" id="" cols="30" rows="5" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
        @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label>Preço</label>
        <input type="text" name="price" id="" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
        @error('price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label>Categorias</label>
        <select name="categories[]" id="" class="form-control" multiple>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" id="" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-large btn-success">Criar Produto</button>
    </div>
</form>

@endsection