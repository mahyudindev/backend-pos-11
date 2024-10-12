<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Delete all existing records
        DB::table('orders')->delete();

        // Create orders for today
        // for ($i = 0; $i < 1; $i++) {
        //     Order::create([
        //         'payment_amount' => rand(100000, 200000),
        //         'total' => rand(100000, 200000),
        //         'payment_method' => 'cash',
        //         'total_item' => rand(1, 10),
        //         'id_kasir' => 1,
        //         'nama_kasir' => 'H.Odeng',
        //         'transaction_time' => Carbon::now(), // Use Carbon::now() for the current time
        //     ]);
        // }

        // Create orders for three days ago
        // $threeDaysAgo = Carbon::now()->subDays(3);
        // for ($i = 0; $i < 1; $i++) {
        //     Order::create([
        //         'payment_amount' => rand(50000, 100000),
        //         'total' => rand(50000, 100000),
        //         'payment_method' => 'cash',
        //         'total_item' => rand(1, 10),
        //         'id_kasir' => 1,
        //         'nama_kasir' => 'H.Odeng',
        //         'transaction_time' => $threeDaysAgo,
        //     ]);
        // }
    }
}
