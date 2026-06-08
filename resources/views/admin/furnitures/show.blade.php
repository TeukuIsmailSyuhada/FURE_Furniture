@extends('layouts.admin')

@section('title', 'Detail Furniture')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('furnitures.index') }}" class="text-decoration-none text-muted small">← Kembali ke Daftar Furniture</a>
        <h2 class="fw-bold mt-2">{{ $furniture->name }}</h2>
    </div>
    <div>
        <a href="{{ route('furnitures.edit', $furniture->id) }}" class="btn btn-outline-primary px-4 me-2">Edit</a>
        <form action="{{ route('furnitures.destroy', $furniture->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger px-4" onclick="return confirm('Hapus data ini?')">Hapus</button>
        </form>
    </div>
</div>

<div class="row g-4 mb-5">
    <!-- Image & Essential Info -->
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 mb-4 h-100 p-0 overflow-hidden">
            @if($furniture->image)
                <img src="{{ asset('storage/' . $furniture->image) }}" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                </div>
            @endif
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-bold small">KODE: {{ $furniture->code }}</span>
                    <span class="badge bg-primary px-3 py-2">{{ $furniture->status }}</span>
                </div>
                <h4 class="fw-bold mb-3">{{ $furniture->name }}</h4>
                <p class="text-muted">{{ $furniture->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>
    </div>

    <!-- Specs & Details -->
    <div class="col-lg-7">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Spesifikasi & Informasi</h5>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Kategori</div>
                        <div class="fw-bold">{{ $furniture->category->name }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Lokasi Penyimpanan</div>
                        <div class="fw-bold">{{ $furniture->location->name }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Material</div>
                        <div class="fw-bold">{{ $furniture->material ?? '-' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Warna</div>
                        <div class="fw-bold">{{ $furniture->color ?? '-' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Ukuran</div>
                        <div class="fw-bold">{{ $furniture->size ?? '-' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small mb-1">Berat</div>
                        <div class="fw-bold">{{ $furniture->weight ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Status Inventaris</h5>
                        <div class="d-flex align-items-center mb-3">
                            <div class="h1 fw-bold mb-0 me-3">{{ $furniture->stock }}</div>
                            <div>
                                <div class="small fw-bold">UNIT TERSEDIA</div>
                                @if($furniture->stock <= $furniture->minimum_stock)
                                    <span class="text-warning small"><i class="bi bi-exclamation-triangle-fill"></i> Stok Menipis</span>
                                @else
                                    <span class="text-success small"><i class="bi bi-check-circle-fill"></i> Stok Aman</span>
                                @endif
                            </div>
                        </div>
                        <div class="small text-muted">Batas Minimum: {{ $furniture->minimum_stock }} unit</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Kondisi Barang</h5>
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-3 bg-light rounded me-3">
                                <i class="bi bi-tools fs-3 text-primary"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">KONDISI SAAT INI</div>
                                <div class="fw-bold text-primary">{{ $furniture->condition }}</div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#changeConditionModal">Ubah Kondisi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Stock History -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Riwayat Transaksi Stok</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4">Tanggal</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th class="px-4">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($furniture->stockTransactions as $trx)
                            <tr>
                                <td class="px-4 small text-muted">{{ $trx->transaction_date }}</td>
                                <td>
                                    @if($trx->type == 'Masuk')
                                        <span class="badge bg-success-subtle text-success">Masuk</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">Keluar</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $trx->quantity }}</td>
                                <td class="px-4 small text-muted">{{ $trx->note }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted small">Belum ada riwayat transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Condition History -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Riwayat Perubahan Kondisi</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4">Waktu</th>
                                <th>Dari → Menjadi</th>
                                <th class="px-4">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($furniture->conditionLogs as $log)
                            <tr>
                                <td class="px-4 small text-muted">{{ $log->changed_at }}</td>
                                <td>
                                    <span class="small">{{ $log->old_condition }}</span>
                                    <i class="bi bi-arrow-right mx-1"></i>
                                    <span class="fw-bold small">{{ $log->new_condition }}</span>
                                </td>
                                <td class="px-4 small text-muted">{{ $log->note }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted small">Belum ada riwayat kondisi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Kondisi -->
<div class="modal fade" id="changeConditionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('furnitures.update-condition', $furniture->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Perbarui Kondisi Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kondisi Baru</label>
                        <select name="condition" class="form-select" required>
                            @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'] as $con)
                                <option value="{{ $con }}" {{ $furniture->condition == $con ? 'selected' : '' }}>{{ $con }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan Perubahan</label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Contoh: Barang terjatuh saat dipindahkan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Kondisi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
