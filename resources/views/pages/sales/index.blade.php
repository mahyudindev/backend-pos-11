@extends('layouts.app')

@section('title', 'Orders')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        .table-responsive {
            overflow-x: auto;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Orders</h1>
                <div class="section-header-button">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Orders</a></div>
                    <div class="breadcrumb-item">All Orders</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Orders</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <form method="GET" action="{{ route('orders.index') }}">
                                            <div class="form-row align-items-end">
                                                <div class="col">
                                                    <label for="start_date">Start Date:</label>
                                                    <input type="date" id="start_date" name="start_date"
                                                        class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label for="end_date">End Date:</label>
                                                    <input type="date" id="end_date" name="end_date"
                                                        class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label for="cashier_name">Cashier Name:</label>
                                                    <input type="text" id="cashier_name" name="cashier_name"
                                                        class="form-control" placeholder="Cashier Name">
                                                </div>
                                                <div class="col">
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <form method="GET" action="{{ route('orders.index') }}">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Search"
                                                    name="name">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive mt-4">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Total</th>
                                            <th>Total Item</th>
                                            <th>Nama Kasir</th>
                                            <th>Waktu Transaksi</th>
                                        </tr>
                                        @php $count = 1 @endphp
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ 'Rp ' . ($order->total == intval($order->total) ? number_format($order->total, 0, ',', '.') : number_format($order->total, 2, ',', '.')) }}
                                                </td>
                                                <td>{{ $order->total_item }}</td>
                                                <td>{{ $order->nama_kasir }}</td>
                                                <td>{{ $order->transaction_time }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5>Total Amount: Rp {{ number_format($totalAmount, 0, ',', '.') }}</h5>
                                                <h5>Total Items: {{ $totalItems }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
