@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Order #{{ $order->order_number }}</h2>
    <p>Total: ₹{{ $order->total_amount }}</p>
    <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-secondary">Download Invoice PDF</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>₹{{ $product->pivot->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
