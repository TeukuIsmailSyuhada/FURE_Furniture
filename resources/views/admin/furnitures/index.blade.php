@extends('layouts.admin')

@section('title', 'Katalog Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Katalog Furniture</li>
@endsection

@section('content')
<div class="page-header d-flex justify-content-between align-items-end">
    <div>
        <h1 class="page-title">Katalog Furniture</h1>
        <p class="page-subtitle">Daftar lengkap aset furniture yang terdaftar dalam sistem FURE.</p>
    </div>
    <a href="{{ route('furnitures.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i> Furniture Baru
    </a>
</div>

<!-- Filters -->
<div class="card mb-5 border-0 bg-transparent">
    <div class="card-body p-0">
        <form action="{{ route('furnitures.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Pencarian Dataset</label>
                <div class="input-group">
                    <span class="input-group-text border-0 bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control border-0" placeholder="Nama atau kode furniture..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Kategori</label>
                <select name="category_id" class="form-select border-0" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Lokasi</label>
                <select name="location_id" class="form-select border-0" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Kondisi</label>
                <select name="condition" class="form-select border-0" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'] as $con)
                        <option value="{{ $con }}" {{ request('condition') == $con ? 'selected' : '' }}>{{ $con }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <a href="{{ route('furnitures.index') }}" class="btn btn-outline-primary w-100 border-0 bg-white">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Furniture List -->
<div class="row g-4">
    @forelse($furnitures as $furniture)
    <div class="col-md-6 col-xl-3">
        <div class="card h-100 feature-card p-0">
            <div class="position-relative overflow-hidden" style="height: 240px;">
                @if($furniture->image)
                    <img src="{{ asset('storage/' . $furniture->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $furniture->name }}">
                @else
                    <div class="w-100 h-100 bg-fure-bg d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-seam fs-1 text-fure-accent"></i>
                    </div>
                @endif
                <div class="position-absolute top-0 end-0 p-3">
                    <span class="badge {{ $furniture->condition == 'Baik' ? 'bg-success' : ($furniture->condition == 'Dalam Perbaikan' ? 'bg-info' : 'bg-danger') }} rounded-0 px-3 py-2 small fw-bold">
                        {{ strtoupper($furniture->condition) }}
                    </span>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="tiny fw-bold text-uppercase ls-wide text-fure-primary-light">{{ $furniture->category->name }}</span>
                    <span class="tiny fw-bold text-muted">{{ $furniture->code }}</span>
                </div>
                <h5 class="playfair fw-bold mb-3">{{ $furniture->name }}</h5>
                <p class="text-muted small mb-4"><i class="bi bi-geo-alt me-1"></i> {{ $furniture->location->name }}</p>
                
                <div class="d-flex justify-content-between align-items-end border-top pt-3">
                    <div>
                        <div class="tiny text-muted fw-bold text-uppercase ls-wide">Status Stok</div>
                        <div class="fw-bold fs-5 {{ $furniture->stock <= $furniture->minimum_stock ? 'text-danger' : 'text-dark' }}">{{ $furniture->stock }} unit</div>
                    </div>
                    <a href="{{ route('furnitures.show', $furniture->id) }}" class="btn btn-primary p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <div class="py-5">
            <i class="bi bi-search fs-1 text-muted opacity-25 mb-3 d-block"></i>
            <h4 class="playfair">Dataset Tidak Ditemukan</h4>
            <p class="text-muted">Coba ubah kriteria filter atau kata kunci pencarian Anda.</p>
        </div>
    </div>
    @endforelse
</div>

<div class="mt-5 pt-2 border-top">
    {{ $furnitures->links() }}
</div>
@endsection
