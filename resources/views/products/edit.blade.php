@extends('layouts.app')

@section('content')
<h3>{{ isset($product) ? 'Edit' : 'Create' }} Product</h3>

<form method="POST" action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}">
    @csrf
    @if(isset($product)) @method('PUT') @endif

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>SKU</label>
        <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Quantity</label>
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}" class="form-control" required>
    </div>

    <button class="btn btn-success">{{ isset($product) ? 'Update' : 'Create' }}</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
