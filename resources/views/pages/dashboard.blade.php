@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <!-- Konten penjualan -->
        <section class="section">
            <div class="section-header">
                <h1>POS SOTO TANGKAR</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Today Sales</h4>
                            </div>
                            <div class="card-body">
                                <h5>Rp.{{ number_format($todaySales, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Weekly Sales</h4>
                            </div>
                            <div class="card-body">
                                <h5>Rp.{{ number_format($weeklySales, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Monthly Sales</h4>
                            </div>
                            <div class="card-body">
                                <h5>Rp.{{ number_format($monthlySales, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Produk yang terjual hari ini -->
        <section class="section">
            <div class="section-header">
                <h2>Daily Sold Items</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product</th>
                                            <th>Total Quantity Sold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dailySoldItems as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->total_quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Paginate Links -->
                            <div class="d-flex justify-content-center">
                                {{ $dailySoldItems->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Item terlaris -->
        <section class="section">
            <div class="section-header">
                <h2>Best Selling Items</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product</th>
                                            <th>Total Quantity Sold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bestSellingItems as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->total_quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
