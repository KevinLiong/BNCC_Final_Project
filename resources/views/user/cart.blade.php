@extends('layouts.navbar')

@section('container')

<h2>Your Cart</h2>
<br>

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="max-width:400px">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="max-width:650px">
        {{ session('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if($carts->isEmpty())
    <div class="alert alert-info" role="alert" style="width:300px">
        Your cart is empty
    </div>
@else
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach($carts as $cart)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cart->product->productName }}</td>
                    <td>{{ $cart->product->category->name }}</td>
                    <td>
                        <form class="d-flex" action="{{ url('cart/update', $cart->id) }}" method="post">
                            @csrf
                            <div class="col-auto">
                                @if($cart->product->quantity > 0)
                                    <input type="number" value="{{ $cart->quantity }}" min="1" max="{{ $cart->product->quantity }}" class="form-control me-2" name="quantity" style="width: 80px;">
                                @else
                                    <input type="number" value="{{ $cart->quantity }}" min="1" max="1" class="form-control me-2" name="quantity" style="width: 80px;">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                    <td>{{ $cart->product->quantity }}</td>
                    <td>Rp{{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}</td> <!-- Format subtotal into Rupiah -->
                    <td>
                        <form action="{{ url('cart/delete', $cart->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                    @php
                        $totalPrice += $cart->quantity * $cart->product->price;
                    @endphp
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-lg-8">
        <h4>Total Price: Rp{{ number_format($totalPrice, 0, ',', '.') }}</h4>
        <br>
        <form method="post" action="/cart">
            @csrf
            <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required autofocus value="{{ old('address') }}">
                @error('address')
                    <div class="invalid-feedback">
                        Address must be 10-100 letters long
                    </div>
                @enderror
            </div>
            <div class="mb-3">
            <label for="postalCode" class="form-label">Postal Code</label>
            <input type="number" class="form-control @error('postalCode') is-invalid @enderror" id="postalCode" name="postalCode" required value="{{ old('postalCode') }}">
                @error('postalCode')
                    <div class="invalid-feedback">
                        Postal code must be 5 digits
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
    </div>
@endif

@endsection
