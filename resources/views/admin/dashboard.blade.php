@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Overview</li>
@endsection

@section('content')
<div class="page-header d-flex justify-content-between align-items-end">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Selamat datang kembali di pusat kendali FURE. Monitor performa aset Anda secara real-time.</p>
    </div>
    <div class="d-flex gap-3">
        <a href="{{ route('furnitures.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> Tambah Aset
        </a>
        <a href="{{ route('reports.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-download me-2"></i> Unduh Laporan
        </a>
    </div>
</div>

<!-- Stats cards -->
<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 p-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-fure-primary text-white p-3">
                        <i class="bi bi-chair fs-4"></i>
                    </div>
                    <div class="text-end">
                        <span class="text-muted small fw-bold text-uppercase ls-wide">Koleksi Aset</span>
                        <h2 class="playfair fw-bold mb-0 mt-1">{{ $total_furniture }}</h2>
                    </div>
                </div>
                <div class="d-flex align-items-center small text-muted">
                    <i class="bi bi-arrow-up-right text-success me-1"></i>
                    <span>Total unit terdaftar</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 p-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-fure-primary text-white p-3">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <div class="text-end">
                        <span class="text-muted small fw-bold text-uppercase ls-wide">Akumulasi Stok</span>
                        <h2 class="playfair fw-bold mb-0 mt-1">{{ $total_stock }}</h2>
                    </div>
                </div>
                <div class="d-flex align-items-center small text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    <span>Tersedia di seluruh gudang</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 p-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-fure-primary text-white p-3">
                        <i class="bi bi-exclamation-square fs-4"></i>
                    </div>
                    <div class="text-end">
                        <span class="text-muted small fw-bold text-uppercase ls-wide">Peringatan Stok</span>
                        <h2 class="playfair fw-bold mb-0 mt-1 {{ $low_stock > 0 ? 'text-danger' : '' }}">{{ $low_stock }}</h2>
                    </div>
                </div>
                <div class="d-flex align-items-center small text-muted">
                    <i class="bi bi-shield-exclamation text-warning me-1"></i>
                    <span>Perlu segera dipasok ulang</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 p-2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="bg-fure-primary text-white p-3">
                        <i class="bi bi-tools fs-4"></i>
                    </div>
                    <div class="text-end">
                        <span class="text-muted small fw-bold text-uppercase ls-wide">Dalam Perbaikan</span>
                        <h2 class="playfair fw-bold mb-0 mt-1">{{ $broken_items }}</h2>
                    </div>
                </div>
                <div class="d-flex align-items-center small text-muted">
                    <i class="bi bi-wrench text-danger me-1"></i>
                    <span>Unit non-operasional</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-5">
    <!-- Latest Furniture -->
    <div class="col-xl-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="playfair mb-0">Aset Terbaru</h4>
            <a href="{{ route('furnitures.index') }}" class="text-decoration-none text-fure-primary small fw-bold text-uppercase ls-wide">Katalog Lengkap <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>IDENTITAS FURNITURE</th>
                            <th>KATEGORI</th>
                            <th>STATUS STOK</th>
                            <th class="text-end">NAVIGASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latest_furniture as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-fure-bg p-2 text-fure-primary me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-box"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $item->name }}</div>
                                        <div class="tiny text-muted fw-bold" style="font-size: 10px;">{{ $item->code }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-uppercase small fw-bold text-muted">{{ $item->category->name }}</span>
                            </td>
                            <td>
                                @if($item->stock <= $item->minimum_stock)
                                    <span class="badge border border-danger text-danger bg-white rounded-0 px-2 py-1 small">LIMIT: {{ $item->stock }}</span>
                                @else
                                    <span class="fw-bold text-dark">{{ $item->stock }} Unit</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('furnitures.show', $item->id) }}" class="btn btn-sm btn-outline-primary py-1 px-3" style="font-size: 0.75rem;">DETAIL</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <p class="text-muted mb-0">Hening di sini. Tambahkan aset pertama Anda.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Latest Transactions -->
    <div class="col-xl-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="playfair mb-0">Log Pergerakan</h4>
        </div>
        <div class="card h-100">
            <div class="card-body p-0">
                <div class="list-group list-group-flush rounded-0">
                    @forelse($latest_transactions as $trx)
                    <div class="list-group-item p-4 border-0 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="text-uppercase tiny fw-bold ls-wide {{ $trx->type == 'Masuk' ? 'text-success' : 'text-danger' }}">
                                <i class="bi {{ $trx->type == 'Masuk' ? 'bi-arrow-down-left' : 'bi-arrow-up-right' }} me-1"></i> Stok {{ $trx->type }}
                            </span>
                            <span class="tiny text-muted">{{ $trx->transaction_date }}</span>
                        </div>
                        <h6 class="fw-bold mb-1">{{ Str::limit($trx->furniture->name, 35) }}</h6>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-muted small">Kuantitas:</span>
                            <span class="badge {{ $trx->type == 'Masuk' ? 'bg-success' : 'bg-danger' }} rounded-0 px-3 py-1">
                                {{ $trx->type == 'Masuk' ? '+' : '-' }} {{ $trx->quantity }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="p-5 text-center">
                        <i class="bi bi-clock-history text-muted fs-1 opacity-25"></i>
                        <p class="mt-3 text-muted small">Belum ada aktivitas tercatat.</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @if($latest_transactions->count() > 0)
            <div class="card-footer bg-white border-0 p-4 text-center">
                <a href="{{ route('stock-transactions.index') }}" class="btn btn-outline-primary w-100">Audit Selengkapnya</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
