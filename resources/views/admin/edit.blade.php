@extends('layouts.navbar')

@section('container')

<h3>Edit Product</h3>

<div class="col-lg-8">
    <form method="post" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
          <label for="productName" class="form-label">Product Name</label>
          <input type="text" class="form-control @error('productName') is-invalid @enderror" id="productName" name="productName" required autofocus value="{{ old('productName', $product->productName) }}">
            @error('productName')
                <div class="invalid-feedback">
                    Product name must be 5-80 letters long
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="categoryId" required>
                @foreach ($categories as $category)
                    @if(old('categoryId', $product->categoryId) == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" class="form-control" id="price" name="price" required value="{{ old('price', $product->price) }}">
        </div>
        <div class="mb-3">
          <label for="quantity" class="form-label">Quantity</label>
          <input type="number" class="form-control" id="quantity" name="quantity" required value="{{ old('quantity', $product->quantity) }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="hidden" name="oldImage" value="{{ $product->image }}">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>


@endsection