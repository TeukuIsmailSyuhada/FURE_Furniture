@extends('layouts.admin')

@section('title', 'Data Furniture')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Data Furniture</h2>
        <p class="text-muted">Kelola inventaris barang furniture Anda.</p>
    </div>
    <a href="{{ route('furnitures.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-plus-lg me-2"></i> Tambah Furniture
    </a>
</div>

<!-- Filters -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('furnitures.index') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Cari Nama/Kode</label>
                <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold">Kategori</label>
                <select name="category_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
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
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-secondary me-2 d-none">Filter</button>
                <a href="{{ route('furnitures.index') }}" class="btn btn-light">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Furniture List -->
<div class="row g-4">
    @forelse($furnitures as $furniture)
    <div class="col-md-4 col-lg-3">
        <div class="card h-100 furniture-card">
            @if($furniture->image)
                <img src="{{ asset('storage/' . $furniture->image) }}" class="card-img-top" alt="{{ $furniture->name }}">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                </div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="badge bg-light text-primary border">{{ $furniture->category->name }}</span>
                    @php
                        $badgeClass = 'bg-success';
                        $badgeText = 'Stok Aman';
                        if ($furniture->stock == 0) {
                            $badgeClass = 'bg-danger';
                            $badgeText = 'Stok Habis';
                        } elseif ($furniture->stock <= $furniture->minimum_stock) {
                            $badgeClass = 'bg-warning text-dark';
                            $badgeText = 'Stok Menipis';
                        }
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ $badgeText }}</span>
                </div>
                <h5 class="fw-bold mb-1">{{ $furniture->name }}</h5>
                <p class="text-muted small mb-3">{{ $furniture->code }} • {{ $furniture->location->name }}</p>
                
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-muted">Stok</div>
                        <div class="fw-bold">{{ $furniture->stock }} unit</div>
                    </div>
                    <div>
                        <div class="small text-muted">Kondisi</div>
                        <div class="fw-bold small">{{ $furniture->condition }}</div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pb-3">
                <div class="d-grid gap-2">
                    <a href="{{ route('furnitures.show', $furniture->id) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <p class="text-muted">Hasil pencarian tidak ditemukan.</p>
    </div>
    @endforelse
</div>
@endsection
