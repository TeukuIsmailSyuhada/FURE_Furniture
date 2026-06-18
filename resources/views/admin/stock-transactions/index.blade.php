@extends('layouts.admin')

@section('title', 'Logistik & Pergerakan')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Logistik Stok</li>
@endsection

@section('content')
<div class="page-header d-flex justify-content-between align-items-end">
    <div>
        <h1 class="page-title">Pergerakan Stok</h1>
        <p class="page-subtitle">Log komprehensif mengenai arus masuk dan keluar aset furniture dalam sistem.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
        <i class="bi bi-plus-lg me-2"></i> Input Transaksi
    </button>
</div>

<!-- Filters -->
<div class="card mb-5 border-0 bg-transparent">
    <div class="card-body p-0">
        <form action="{{ route('stock-transactions.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Filter Furniture</label>
                <select name="furniture_id" class="form-select border-0 bg-white" onchange="this.form.submit()">
                    <option value="">Seluruh Koleksi</option>
                    @foreach($furnitures as $f)
                        <option value="{{ $f->id }}" {{ request('furniture_id') == $f->id ? 'selected' : '' }}>{{ $f->name }} ({{ $f->code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Rentang Mulai</label>
                <input type="date" name="start_date" class="form-control border-0 bg-white" value="{{ request('start_date') }}" onchange="this.form.submit()">
            </div>
            <div class="col-md-3">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Rentang Akhir</label>
                <input type="date" name="end_date" class="form-control border-0 bg-white" value="{{ request('end_date') }}" onchange="this.form.submit()">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <a href="{{ route('stock-transactions.index') }}" class="btn btn-outline-primary w-100 border-0 bg-white">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width: 150px;">TANGGAL LOG</th>
                    <th>IDENTITAS ASET</th>
                    <th>TIPE ARUS</th>
                    <th>KUANTITAS</th>
                    <th>CATATAN OPERASIONAL</th>
                    <th class="text-end">TIMESTAMP</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td><span class="fw-bold text-dark">{{ $trx->transaction_date }}</span></td>
                    <td>
                        <div class="fw-bold text-dark">{{ $trx->furniture->name }}</div>
                        <div class="tiny text-muted fw-bold text-uppercase ls-wide">{{ $trx->furniture->code }}</div>
                    </td>
                    <td>
                        @if($trx->type == 'Masuk')
                            <span class="badge border border-success text-success bg-white rounded-0 px-3 py-1 tiny fw-bold">STOCK-IN</span>
                        @else
                            <span class="badge border border-danger text-danger bg-white rounded-0 px-3 py-1 tiny fw-bold">STOCK-OUT</span>
                        @endif
                    </td>
                    <td class="fw-bold fs-5 {{ $trx->type == 'Masuk' ? 'text-success' : 'text-danger' }}">
                        {{ $trx->type == 'Masuk' ? '+' : '-' }}{{ $trx->quantity }}
                    </td>
                    <td><span class="text-muted small italic">{{ $trx->note ?: 'N/A' }}</span></td>
                    <td class="text-end text-muted tiny">{{ $trx->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-clock-history fs-1 text-muted opacity-25 d-block mb-3"></i>
                        <p class="text-muted">Log pergerakan stok masih kosong.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Transaction -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('stock-transactions.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4 pb-0">
                    <h4 class="playfair mb-0">Registrasi Arus Stok</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Aset Furniture</label>
                        <select name="furniture_id" class="form-select border-0 bg-fure-bg py-3" required>
                            <option value="">Pilih Aset...</option>
                            @foreach($furnitures as $f)
                                <option value="{{ $f->id }}">{{ $f->name }} (Status: {{ $f->stock }} Unit)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Tipe Perubahan</label>
                            <select name="type" class="form-select border-0 bg-fure-bg py-3" required>
                                <option value="Masuk">Stok Masuk (+)</option>
                                <option value="Keluar">Stok Keluar (-)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Jumlah Unit</label>
                            <input type="number" name="quantity" class="form-control border-0 bg-fure-bg py-3" min="1" value="1" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Tanggal Transaksi</label>
                        <input type="date" name="transaction_date" class="form-control border-0 bg-fure-bg py-3" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Catatan Operasional</label>
                        <textarea name="note" class="form-control border-0 bg-fure-bg py-3" rows="3" placeholder="Contoh: Pengadaan triwulan ke-2 atau distribusi ke gudang B..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Logistik</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
