@extends('layouts.front')

@section('content')

<div class="row">
    @foreach ($products as $key => $product)
    <div class="col-md-4">
        <div class="card">
            @if ($product->photos->count())
            <img src="{{ asset('storage/'.$product->photos->first()->image) }}" class="card-img-top" alt="">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                <p class="card-text">
                    {{ $product->description }}
                </p>
            </div>
        </div>
    </div>
    @if (($key + 1 )% 3 == 0) </div><div class="row"> @endif
    @endforeach
</div>

@endsection