<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesOrderController extends Controller
{
    public function index()
    {
        $orders = SalesOrder::with('products')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        $productData = [];
        $products = $request->input('products', []);
        if (empty($request->products)) {
            return back()->with('error', 'Please select at least one product.');
        }
        foreach ($request->products as $item) {
            $product = Product::findOrFail($item['id']);
            $quantity = $item['quantity'];

            if ($product->quantity < $quantity) {
                return back()->with('error', "Not enough stock for product: $product->name");
            }

            $total += $product->price * $quantity;
            $productData[$product->id] = [
                'quantity' => $quantity,
                'price' => $product->price
            ];
            $product->decrement('quantity', $quantity);
        }

        $order = SalesOrder::create([
            'order_number' => Str::uuid(),
            'user_id' => Auth::id(),
            'total_amount' => $total,
        ]);

        $order->products()->attach($productData);

        return redirect()->route('orders.show', $order->id)->with('success', 'Order created successfully.');
    }

    public function show($id)
    {
        $order = SalesOrder::with('products')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function exportPDF($id)
    {
        $order = SalesOrder::with('products')->findOrFail($id);
        $pdf = PDF::loadView('orders.invoice', compact('order'));
        return $pdf->download("invoice_{$order->order_number}.pdf");
    }
}