<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
{
    // Penjualan hari ini
    $todaySales = Order::whereDate('transaction_time', Carbon::today())->sum('total');

    // Penjualan minggu ini
    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();
    $weeklySales = Order::whereBetween('transaction_time', [$startOfWeek, $endOfWeek])->sum('total');

    // Penjualan bulan ini (termasuk penjualan hari ini)
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();
    $monthlySales = Order::where('transaction_time', '>=', $startOfMonth)
                    ->where('transaction_time', '<=', Carbon::now()) // Menggunakan Carbon::now() untuk memastikan transaksi hari ini juga termasuk
                    ->sum('total');

    // Item terlaris
    $bestSellingItems = OrderItem::select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
                    ->groupBy('product_id')
                    ->orderByDesc('total_quantity')
                    ->take(10) // Ambil 10 item terlaris
                    ->get();

    // Produk yang terjual hari ini
    $dailySoldItems = OrderItem::whereDate('created_at', Carbon::today())
                        ->select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
                        ->groupBy('product_id')
                        ->paginate(50);

    return view('pages.dashboard', compact('todaySales', 'weeklySales', 'monthlySales', 'bestSellingItems', 'dailySoldItems'));
}

}
