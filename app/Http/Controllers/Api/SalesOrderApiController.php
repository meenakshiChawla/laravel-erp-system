<?php

// app/Http/Controllers/Api/SalesOrderApiController.php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalesOrderApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            //'customer_name' => 'required|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // 🔎 Check stock for each product
        foreach ($request->products as $item) {
            $product = Product::find($item['product_id']);

            if ($product->quantity < $item['quantity']) {
                return response()->json([
                    'message' => "Not enough stock for product: {$product->name}",
                ], 422);
            }
        }

        // ✅ Passed validation, proceed to create order
        DB::beginTransaction();

        try {
            $order = new SalesOrder();
            $order->user_id = auth()->id();
            //$order->customer_name = $request->customer_name;
            $order->order_number = 'SO-' . time(); // or auto-generate
            $order->total_amount = 0;
            $order->save();

            $total = 0;

            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                // create order item
                $order->products()->attach($product->id, [
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                    //'total_amount' => $subtotal
                ]);

                // reduce stock
                $product->decrement('quantity', $item['quantity']);
            }

            $order->total_amount = $total;
            $order->save();

            DB::commit();

            return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

   public function show($id)
    {
        $order = SalesOrder::with('products')->findOrFail($id);

        $details = $order->products->map(function ($product) {
            return [
                'product_name' => $product->name,
                'quantity' => $product->pivot->quantity,
                'price' => $product->pivot->price,
                'subtotal' => $product->pivot->quantity * $product->pivot->price,
            ];
        });

        return response()->json([
            'customer_name' => $order->customer_name,
            'order_number' => $order->order_number,
            'total' => $order->total_amount,
            'items' => $details,
        ]);
    }
}
