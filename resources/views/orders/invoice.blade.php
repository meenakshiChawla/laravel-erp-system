<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body { font-family: Arial; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>
    <h2>Invoice - Order #{{ $order->order_number }}</h2>
    <p>Date: {{ $order->created_at->format('d-m-Y') }}</p>
    <p>Total: ₹{{ $order->total_amount }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th><th>Qty</th><th>Unit Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>₹{{ $product->pivot->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
