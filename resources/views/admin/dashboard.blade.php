@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h2 class="fw-bold text-dark mb-1">Dashboard</h2>
        <p class="text-muted">Selamat datang kembali! Berikut ringkasan inventaris FURE hari ini.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('furnitures.create') }}" class="btn btn-primary d-flex align-items-center">
            <i class="bi bi-plus-circle me-2"></i> Furniture Baru
        </a>
        <a href="{{ route('stock-transactions.index') }}" class="btn btn-secondary d-flex align-items-center shadow-sm">
            <i class="bi bi-arrow-down-up me-2"></i> Update Stok
        </a>
    </div>
</div>

<!-- Stats cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-primary-subtle p-3 rounded-3 text-primary">
                        <i class="bi bi-chair fs-4"></i>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small fw-bold text-uppercase">Furniture</div>
                        <div class="h2 fw-bold mb-0">{{ $total_furniture }}</div>
                    </div>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-success-subtle p-3 rounded-3 text-success">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small fw-bold text-uppercase">Total Stok</div>
                        <div class="h2 fw-bold mb-0">{{ $total_stock }}</div>
                    </div>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-success" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-warning-subtle p-3 rounded-3 text-warning">
                        <i class="bi bi-exclamation-triangle fs-4"></i>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small fw-bold text-uppercase">Stok Menipis</div>
                        <div class="h2 fw-bold mb-0 text-warning">{{ $low_stock }}</div>
                    </div>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-warning" style="width: {{ $total_furniture > 0 ? ($low_stock/$total_furniture)*100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-danger-subtle p-3 rounded-3 text-danger">
                        <i class="bi bi-tools fs-4"></i>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small fw-bold text-uppercase">Perlu Cek</div>
                        <div class="h2 fw-bold mb-0 text-danger">{{ $broken_items }}</div>
                    </div>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-danger" style="width: {{ $total_furniture > 0 ? ($broken_items/$total_furniture)*100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Latest Furniture -->
    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Furniture Terbaru</h5>
                <a href="{{ route('furnitures.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4">Nama</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th class="text-end px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latest_furniture as $item)
                            <tr>
                                <td class="px-4">
                                    <div class="fw-bold">{{ $item->name }}</div>
                                    <div class="small text-muted">{{ $item->code }}</div>
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    @if($item->stock <= $item->minimum_stock)
                                        <span class="badge bg-warning text-dark">Menipis ({{ $item->stock }})</span>
                                    @else
                                        <span class="badge bg-success">{{ $item->stock }}</span>
                                    @endif
                                </td>
                                <td class="text-end px-4">
                                    <a href="{{ route('furnitures.show', $item->id) }}" class="btn btn-sm btn-light">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data furniture.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Transactions -->
    <div class="col-lg-5">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Riwayat Stok Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($latest_transactions as $trx)
                    <li class="list-group-item px-4 py-3 border-0 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div>
                                <span class="fw-bold text-dark d-block mb-1">{{ Str::limit($trx->furniture->name, 25) }}</span>
                                <span class="badge {{ $trx->type == 'Masuk' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded-pill px-3">
                                    <i class="bi {{ $trx->type == 'Masuk' ? 'bi-plus' : 'bi-dash' }} me-1"></i> Stok {{ $trx->type }}
                                </span>
                            </div>
                            <div class="text-end">
                                <div class="h5 fw-bold mb-0 {{ $trx->type == 'Masuk' ? 'text-success' : 'text-danger' }}">
                                    {{ $trx->type == 'Masuk' ? '+' : '-' }}{{ $trx->quantity }}
                                </div>
                                <div class="small text-muted">{{ $trx->transaction_date }}</div>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item text-center py-5 border-0">
                        <div class="mb-3">
                            <i class="bi bi-clock-history text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                        <h6 class="fw-bold text-dark">Belum Ada Riwayat</h6>
                        <p class="text-muted small mx-auto" style="max-width: 200px;">Data riwayat stok masuk dan keluar akan tampil di sini setelah Anda mengupdate stok.</p>
                        <a href="{{ route('stock-transactions.index') }}" class="btn btn-sm btn-outline-primary mt-2">Buat Catatan Riwayat</a>
                    </li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer bg-white text-center py-3">
                <a href="{{ route('stock-transactions.index') }}" class="small text-decoration-none">Lihat Semua Riwayat</a>
            </div>
        </div>
    </div>
</div>
@endsection
