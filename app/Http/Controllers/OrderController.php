<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve filter values from request or session
        $startDate = $request->input('start_date') ?: Session::get('start_date');
        $endDate = $request->input('end_date') ?: Session::get('end_date');
        $cashierName = $request->input('cashier_name');

        // Update session with the latest filter values
        if ($startDate) {
            Session::put('start_date', $startDate);
        }
        if ($endDate) {
            Session::put('end_date', $endDate);
        }

        // Create a new query
        $query = Order::query();

        // Apply date filter if provided
        if ($startDate && $endDate) {
            $query->whereBetween('transaction_time', [$startDate, $endDate]);
        }

        // Apply cashier name filter if provided
        if ($cashierName) {
            $query->where('nama_kasir', 'like', '%' . $cashierName . '%');
        }

        // Paginate the results
        $orders = $query->paginate(100);

        // Calculate total amount and total items for the current page
        $totalAmount = $orders->sum('total');
        $totalItems = $orders->sum('total_item');

        return view('pages.sales.index', compact('orders', 'totalAmount', 'totalItems', 'startDate', 'endDate', 'cashierName'));
    }

    public function create()
    {
        $products = Product::all();
        $order = Session::get('order', []);
        return view('pages.sales.create', compact('products', 'order'));
    }

    public function addToOrder(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $order = Session::get('order', []);
        if (isset($order[$productId])) {
            $order[$productId]['quantity']++;
        } else {
            $order[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1
            ];
        }

        Session::put('order', $order);

        return redirect()->route('orders.create')->with('success', 'Product added to order.');
    }

    public function removeFromOrder(Request $request)
    {
        $productId = $request->input('product_id');
        $order = Session::get('order', []);

        if (isset($order[$productId])) {
            if ($order[$productId]['quantity'] > 1) {
                $order[$productId]['quantity']--;
            } else {
                unset($order[$productId]);
            }
            Session::put('order', $order);
        }

        return redirect()->route('orders.create')->with('success', 'Product removed from order.');
    }
}
