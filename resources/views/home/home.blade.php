<!-- Buat Show Product Barang -->
@extends('layouts.app')
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Produk</h1>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <h6 class="card-subtitle mb-2 text-muted">Harga: {{ $product->price }}</h6>
                            <a href="#" class="btn btn-primary">Beli</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
