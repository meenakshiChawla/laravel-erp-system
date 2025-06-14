@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Sales Order</h2>
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        @foreach ($products as $product)
            <div class="mb-3">
                <label>{{ $product->name }} (Stock: {{ $product->quantity }})</label>
                <input type="number" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}" hidden>
                <input type="number" required name="products[{{ $loop->index }}][quantity]" class="form-control" placeholder="Enter quantity" min="0">
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>
@endsection
