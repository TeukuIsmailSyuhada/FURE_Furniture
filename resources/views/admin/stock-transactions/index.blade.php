@extends('layouts.admin')

@section('title', 'Riwayat Stok')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Riwayat Stok Barang</h2>
        <p class="text-muted">Pantau dan kelola catatan masuk/keluar stok furniture.</p>
    </div>
    <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
        <i class="bi bi-plus-lg me-2"></i> Tambah Catatan Stok
    </button>
</div>

<!-- Filters -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('stock-transactions.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label small fw-bold">Pilih Furniture</label>
                <select name="furniture_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Furniture</option>
                    @foreach($furnitures as $f)
                        <option value="{{ $f->id }}" {{ request('furniture_id') == $f->id ? 'selected' : '' }}>{{ $f->name }} ({{ $f->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" onchange="this.form.submit()">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" onchange="this.form.submit()">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary w-100 d-none">Filter</button>
                <a href="{{ route('stock-transactions.index') }}" class="btn btn-light w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4">Tanggal</th>
                        <th>Furniture</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Catatan</th>
                        <th class="px-4">Waktu Input</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr>
                        <td class="px-4">
                            <div class="fw-bold">{{ $trx->transaction_date }}</div>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $trx->furniture->name }}</div>
                            <div class="small text-muted">{{ $trx->furniture->code }}</div>
                        </td>
                        <td>
                            @if($trx->type == 'Masuk')
                                <span class="badge bg-success-subtle text-success">Masuk</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">Keluar</span>
                            @endif
                        </td>
                        <td class="fw-bold fs-5">
                            {{ $trx->type == 'Masuk' ? '+' : '-' }}{{ $trx->quantity }}
                        </td>
                        <td><span class="text-muted small">{{ $trx->note ?? '-' }}</span></td>
                        <td class="px-4 small text-muted">{{ $trx->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data riwayat stok.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Transaction -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('stock-transactions.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Catatan Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Furniture</label>
                        <select name="furniture_id" class="form-select" required>
                            <option value="">Pilih Furniture...</option>
                            @foreach($furnitures as $f)
                                <option value="{{ $f->id }}">{{ $f->name }} (Stok: {{ $f->stock }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tipe Perubahan</label>
                            <select name="type" class="form-select" required>
                                <option value="Masuk">Stok Masuk</option>
                                <option value="Keluar">Stok Keluar</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Perubahan</label>
                        <input type="date" name="transaction_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Catatan</label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Contoh: Pengadaan barang baru atau Barang rusak..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
