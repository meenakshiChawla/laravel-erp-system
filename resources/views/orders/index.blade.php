@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sales Orders</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Order Number</th>
                <th>Total Amount</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-sm btn-secondary" target="_self">PDF</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
