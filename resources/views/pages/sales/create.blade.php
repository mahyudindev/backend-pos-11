@extends('layouts.app')

@section('title', 'Create Order')

@push('style')
    <!-- CSS Libraries -->
    <style>
        .product-card {
            margin-bottom: 20px;
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
        }

        .order-sidebar {
            position: fixed;
            right: 0;
            top: 0;
            height: 100%;
            background-color: white;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            overflow-y: auto;
        }
    </style>
@endpush

@section('main')
    <div class="container-fluid">
        <div class="row">
            <!-- Daftar produk -->
            <div class="col-md-9">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="card product-card">
                                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <form action="{{ route('orders.addToOrder') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar untuk transaksi -->
            <div class="col-md-3 order-sidebar">
                <h4>Orders #</h4>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary">Dine In</button>
                    <button type="button" class="btn btn-secondary">To Go</button>
                </div>
                <ul class="list-group mt-3">
                    @foreach ($order as $productId => $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                    style="width: 50px; height: 50px;">
                                <span>{{ $item['name'] }}</span>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-danger"
                                    onclick="document.getElementById('remove-form-{{ $productId }}').submit();">-</button>
                                <span>{{ $item['quantity'] }}</span>
                                <button class="btn btn-sm btn-success"
                                    onclick="document.getElementById('add-form-{{ $productId }}').submit();">+</button>
                                <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                            </div>
                            <form id="add-form-{{ $productId }}" action="{{ route('orders.addToOrder') }}"
                                method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}">
                            </form>
                            <form id="remove-form-{{ $productId }}" action="{{ route('orders.removeFromOrder') }}"
                                method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}">
                            </form>
                        </li>
                    @endforeach
                </ul>
                <a href="#" class="btn btn-primary mt-3">Lanjutkan Pembayaran</a>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- Page Specific JS File -->
@endpush
