@extends('layouts.admin')

@section('title', 'Laporan Data Furniture')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Laporan Data</h2>
    <p class="text-muted">Generate laporan inventaris furniture berdasarkan kriteria tertentu.</p>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold"><i class="bi bi-filter me-2"></i>Filter Laporan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('reports.index') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Kategori</label>
                <select name="category_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Lokasi</label>
                <select name="location_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Lokasi</option>
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Kondisi</label>
                <select name="condition" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kondisi</option>
                    @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'] as $con)
                        <option value="{{ $con }}" {{ request('condition') == $con ? 'selected' : '' }}>{{ $con }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Status Stok</label>
                <select name="status_stok" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="Habis" {{ request('status_stok') == 'Habis' ? 'selected' : '' }}>Stok Habis</option>
                    <option value="Menipis" {{ request('status_stok') == 'Menipis' ? 'selected' : '' }}>Stok Menipis</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary w-100 d-none">Tampilkan</button>
            </div>
        </form>
    </div>
</div>

@if(isset($furnitures))
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Hasil Laporan</h5>
        <a href="{{ route('reports.print', request()->all()) }}" target="_blank" class="btn btn-primary btn-sm px-3">
            <i class="bi bi-printer me-2"></i> Cetak Laporan (PDF/Print)
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4">Kode</th>
                        <th>Nama Furniture</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Kondisi</th>
                        <th>Stok</th>
                        <th class="px-4">Status Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($furnitures as $f)
                    <tr>
                        <td class="px-4 fw-bold small">{{ $f->code }}</td>
                        <td>{{ $f->name }}</td>
                        <td>{{ $f->category->name }}</td>
                        <td>{{ $f->location->name }}</td>
                        <td>{{ $f->condition }}</td>
                        <td class="fw-bold">{{ $f->stock }}</td>
                        <td class="px-4">
                            @if($f->stock == 0)
                                <span class="badge bg-danger">Stok Habis</span>
                            @elseif($f->stock <= $f->minimum_stock)
                                <span class="badge bg-warning text-dark">Stok Menipis</span>
                            @else
                                <span class="badge bg-success">Stok Aman</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Tidak ada data yang sesuai dengan filter.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
