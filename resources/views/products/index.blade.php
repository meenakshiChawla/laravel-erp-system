@extends('layouts.app')

@section('content')
<h3>Products</h3>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Quantity</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>₹{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Delete?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5">No products found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
