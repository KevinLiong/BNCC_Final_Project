@extends('layouts.navbar')

@section('container')

<h2>Products</h2>

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="max-width:400px">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if(session()->has('fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="max-width:600px">
        {{ session('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($products->isEmpty())
    <div class="alert alert-info" role="alert" style="width:300px">
        No product available
    </div>
@else
    <div style="display: flex; flex-wrap: wrap;">
        @foreach($products as $product)
            <div class="col" style="flex: 0 0 auto;">
                <div class="card text-center" style="width: 18rem; margin: 10px;">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ asset('storage/' . $product->image) }}" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->productName }}</h5>
                        <p class="card-text"><strong>Category: </strong>{{ $product->category->name}}</p>
                        <p class="card-text"><strong>Price: </strong>Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Stock: </strong>{{ $product->quantity }}</p>
                        @if ($product->quantity == 0)
                            <div class="input-group mx-auto" style="max-width: 100px;">
                                <input type="number" value="0" min="1" max="{{ $product->quantity }}" class="form-control" name="quantity">
                            </div>
                            <br>
                            <button type="button" class="btn btn-danger disabled">Out of stock</button>
                        @else
                            <form action="{{ url('addToCart', $product->id) }}" method="post">
                                @csrf
                                <div class="input-group mx-auto" style="max-width: 100px;">
                                    <input type="number" value="1" min="1" max="{{ $product->quantity }}" class="form-control" name="quantity">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Add to cart</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif


@endsection
