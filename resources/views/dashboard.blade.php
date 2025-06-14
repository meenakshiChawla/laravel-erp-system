@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard Summary</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text">₹{{ number_format($totalSales, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
    </div>

    <h4>Low Stock Alerts (<= 5 units)</h4>
    @if ($lowStockProducts->isEmpty())
        <p class="text-muted">No low stock products.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lowStockProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td class="text-danger">{{ $product->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection