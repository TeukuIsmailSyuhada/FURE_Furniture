@extends('layouts.admin')

@section('title', 'Detail Aset')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('furnitures.index') }}">Katalog</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Unit</li>
@endsection

@section('content')
<div class="page-header d-flex justify-content-between align-items-end">
    <div>
        <h1 class="page-title">{{ $furniture->name }}</h1>
        <p class="page-subtitle">Terdaftar pada sistem dengan kode identifikasi <span class="text-fure-primary fw-bold">{{ $furniture->code }}</span>.</p>
    </div>
    <div class="d-flex gap-3">
        <a href="{{ route('furnitures.edit', $furniture->id) }}" class="btn btn-outline-primary">
            <i class="bi bi-pencil-square me-2"></i> Edit Data
        </a>
        <form action="{{ route('furnitures.destroy', $furniture->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus aset ini dari database?')">
                <i class="bi bi-trash me-2"></i> Hapus Aset
            </button>
        </form>
    </div>
</div>

<div class="row g-5 mb-5">
    <!-- Image & Essential Info -->
    <div class="col-lg-5">
        <div class="card h-100 p-0 overflow-hidden">
            <div class="position-relative">
                @if($furniture->image)
                    <img src="{{ asset('storage/' . $furniture->image) }}" class="w-100 object-fit-cover" style="height: 500px;">
                @else
                    <div class="w-100 bg-fure-bg d-flex align-items-center justify-content-center" style="height: 500px;">
                        <i class="bi bi-image fs-1 text-fure-accent opacity-50"></i>
                    </div>
                @endif
                <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-white bg-opacity-75 backdrop-blur">
                    <span class="tiny fw-bold text-uppercase ls-wide text-muted d-block mb-1">Status Peredaran</span>
                    <span class="badge border border-fure-primary text-fure-primary bg-white rounded-0 px-3 py-2 fw-bold">{{ strtoupper($furniture->status) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Specs & Details -->
    <div class="col-lg-7">
        <div class="card p-4 mb-4">
            <h4 class="playfair mb-4">Spesifikasi Teknis</h4>
            <div class="row g-4">
                <div class="col-sm-6 border-bottom pb-3">
                    <div class="tiny fw-bold text-uppercase ls-wide text-muted mb-1">Kategori Klasifikasi</div>
                    <div class="fw-bold text-dark fs-5">{{ $furniture->category->name }}</div>
                </div>
                <div class="col-sm-6 border-bottom pb-3">
                    <div class="tiny fw-bold text-uppercase ls-wide text-muted mb-1">Koordinat Lokasi</div>
                    <div class="fw-bold text-dark fs-5">{{ $furniture->location->name }}</div>
                </div>
                <div class="col-sm-6 border-bottom pb-3">
                    <div class="tiny fw-bold text-uppercase ls-wide text-muted mb-1">Konsturksi Material</div>
                    <div class="fw-bold text-dark">{{ $furniture->material ?: 'N/A' }}</div>
                </div>
                <div class="col-sm-6 border-bottom pb-3">
                    <div class="tiny fw-bold text-uppercase ls-wide text-muted mb-1">Varian Warna</div>
                    <div class="fw-bold text-dark">{{ $furniture->color ?: 'N/A' }}</div>
                </div>
                <div class="col-sm-6 border-bottom pb-3">
                    <div class="tiny fw-bold text-uppercase ls-wide text-muted mb-1">Dimensi Fisik</div>
                    <div class="fw-bold text-dark">{{ $furniture->size ?: 'N/A' }}</div>
                </div>
                <div class="col-sm-6 border-bottom pb-3">
                    <div class="tiny fw-bold text-uppercase ls-wide text-muted mb-1">Bobot Unit</div>
                    <div class="fw-bold text-dark">{{ $furniture->weight ?: 'N/A' }}</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="tiny fw-bold text-uppercase ls-wide text-muted mb-2">Deskripsi Tambahan</div>
                <p class="text-muted small mb-0">{{ $furniture->description ?: 'Tidak ada deskripsi tambahan yang tercatat untuk unit ini.' }}</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 p-4 border-fure">
                    <h5 class="playfair mb-3">Status Inventori</h5>
                    <div class="d-flex align-items-center mb-0">
                        <div class="h2 playfair fw-bold mb-0 me-3 text-fure-primary">{{ $furniture->stock }}</div>
                        <div>
                            <div class="tiny fw-bold text-uppercase ls-wide text-muted">UNIT TERSEDIA</div>
                            @if($furniture->stock <= $furniture->minimum_stock)
                                <span class="text-danger small fw-bold">⚠ STOK LIMIT</span>
                            @else
                                <span class="text-success small fw-bold">✓ STOK AMAN</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 p-4">
                    <h5 class="playfair mb-3">Integritas Aset</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-fure-bg p-2 text-fure-primary me-3">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>
                        <div>
                            <div class="tiny fw-bold text-uppercase ls-wide text-muted">KONDISI UNIT</div>
                            <div class="fw-bold text-dark">{{ strtoupper($furniture->condition) }}</div>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary w-100 py-2 tiny fw-bold ls-wide" data-bs-toggle="modal" data-bs-target="#changeConditionModal">UPDATE KONDISI</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-5">
    <div class="col-lg-6">
        <h5 class="playfair mb-4">Logistik Stok</h5>
        <div class="card overflow-hidden">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>TANGGAL</th>
                        <th>ARUS</th>
                        <th>QTY</th>
                        <th>OPERASIONAL</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($furniture->stockTransactions()->latest()->get() as $trx)
                    <tr>
                        <td class="tiny text-muted">{{ $trx->transaction_date }}</td>
                        <td>
                            <span class="badge rounded-0 py-1 px-2 tiny {{ $trx->type == 'Masuk' ? 'bg-success' : 'bg-danger' }}">
                                {{ strtoupper($trx->type) }}
                            </span>
                        </td>
                        <td class="fw-bold text-dark">{{ $trx->quantity }}</td>
                        <td class="tiny text-muted italic">{{ Str::limit($trx->note, 30) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted small">Nirkala data logistik.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <h5 class="playfair mb-4">Log Kondisi</h5>
        <div class="card overflow-hidden">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>WAKTU</th>
                        <th>PERUBAHAN STATUS</th>
                        <th>CATATAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($furniture->conditionLogs()->latest()->get() as $log)
                    <tr>
                        <td class="tiny text-muted">{{ $log->changed_at }}</td>
                        <td class="small">
                            <span class="text-muted">{{ $log->old_condition }}</span>
                            <i class="bi bi-arrow-right mx-1 opacity-50"></i>
                            <span class="fw-bold text-dark">{{ $log->new_condition }}</span>
                        </td>
                        <td class="tiny text-muted italic">{{ Str::limit($log->note, 30) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted small">Nirkala data integrasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Update Kondisi -->
<div class="modal fade" id="changeConditionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('furnitures.update-condition', $furniture->id) }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4 pb-0">
                    <h4 class="playfair mb-0">Modifier Kondisi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Level Kondisi Baru</label>
                        <select name="condition" class="form-select border-0 bg-fure-bg py-3" required>
                            @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'] as $con)
                                <option value="{{ $con }}" {{ $furniture->condition == $con ? 'selected' : '' }}>{{ $con }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Justifikasi Perubahan</label>
                        <textarea name="note" class="form-control border-0 bg-fure-bg py-3" rows="3" placeholder="Jelaskan alasan perubahan kondisi..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
