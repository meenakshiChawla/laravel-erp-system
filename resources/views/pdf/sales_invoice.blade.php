<h2>Sales Invoice #{{ $order->id }}</h2>
<ul>
@foreach ($order->items as $item)
    <li>{{ $item->product->name }} - {{ $item->quantity }} x ₹{{ $item->price }}</li>
@endforeach
</ul>
<p>Total: ₹{{ $order->total }}</p>
