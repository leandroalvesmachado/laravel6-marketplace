@extends('layouts.app')

@section('content')

<h1>Atualizar Produto</h1>

<form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post">
    <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
    <!-- ou -->
    @csrf
    
    <!-- <input type="hidden" name="_method" value="PUT"> -->
    <!-- ou -->
    @method("PUT")
    <div class="form-group">
        <label>Nome Produto</label>
        <input type="text" name="name" id="" class="form-control" value="{{ $product->name }}">
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" id="" class="form-control" value="{{ $product->description }}">
    </div>

    <div class="form-group">
        <label>Conteúdo</label>
        <textarea name="body" id="" cols="30" rows="5" class="form-control">{{ $product->body }}</textarea>
    </div>

    <div class="form-group">
        <label>Preço</label>
        <input type="text" name="price" id="" class="form-control" value="{{ $product->price }}">
    </div>

    <div class="form-group">
        <label>Categorias</label>
        <select name="categories[]" id="" class="form-control" multiple>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if ($product->categories->contains($category)) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" id="" class="form-control" value="{{ $product->slug }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-large btn-success">Atualizar Produto</button>
    </div>
</form>

@endsection