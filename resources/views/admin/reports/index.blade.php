@extends('layouts.admin')

@section('title', 'Laporan Aset Inventaris')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Laporan Sistem</li>
@endsection

@section('content')
<div class="page-header d-flex justify-content-between align-items-end">
    <div>
        <h1 class="page-title">Laporan Aset</h1>
        <p class="page-subtitle">Analisis mendalam dan kompilasi data inventaris furniture untuk keperluan audit.</p>
    </div>
    @if(isset($furnitures) && $furnitures->count() > 0)
    <a href="{{ route('reports.print', request()->all()) }}" target="_blank" class="btn btn-primary">
        <i class="bi bi-printer me-2"></i> Ekspor PDF / Cetak
    </a>
    @endif
</div>

<div class="card mb-5">
    <div class="card-header bg-white p-4 border-0">
        <h5 class="playfair mb-0">Parameter Laporan</h5>
    </div>
    <div class="card-body p-4 pt-0">
        <form action="{{ route('reports.index') }}" method="GET" class="row g-4">
            <div class="col-md-3">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Filter Kategori</label>
                <select name="category_id" class="form-select border-0 bg-fure-bg py-3" onchange="this.form.submit()">
                    <option value="">Seluruh Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Titik Lokasi</label>
                <select name="location_id" class="form-select border-0 bg-fure-bg py-3" onchange="this.form.submit()">
                    <option value="">Seluruh Lokasi</option>
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Kondisi Aset</label>
                <select name="condition" class="form-select border-0 bg-fure-bg py-3" onchange="this.form.submit()">
                    <option value="">Seluruh Kondisi</option>
                    @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'] as $con)
                        <option value="{{ $con }}" {{ request('condition') == $con ? 'selected' : '' }}>{{ $con }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Status Stok</label>
                <select name="status_stok" class="form-select border-0 bg-fure-bg py-3" onchange="this.form.submit()">
                    <option value="">Seluruh Status</option>
                    <option value="Habis" {{ request('status_stok') == 'Habis' ? 'selected' : '' }}>Stok Habis</option>
                    <option value="Menipis" {{ request('status_stok') == 'Menipis' ? 'selected' : '' }}>Stok Menipis</option>
                </select>
            </div>
        </form>
    </div>
</div>

@if(isset($furnitures))
<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width: 120px;">KODE UNIT</th>
                    <th>IDENTITAS ASET</th>
                    <th class="d-none d-lg-table-cell">LOKASI</th>
                    <th>KONDISI</th>
                    <th>STOK</th>
                    <th class="text-end">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($furnitures as $f)
                <tr>
                    <td class="text-fure-primary-light tiny fw-bold ls-wide">{{ $f->code }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ $f->name }}</div>
                        <div class="tiny text-muted fw-bold text-uppercase ls-wide">{{ $f->category->name }}</div>
                    </td>
                    <td class="d-none d-lg-table-cell small text-muted">
                        <i class="bi bi-geo-alt me-1"></i> {{ $f->location->name }}
                    </td>
                    <td>
                        @php
                            $condClass = 'text-success';
                            if($f->condition == 'Rusak Berat' || $f->condition == 'Dalam Perbaikan') $condClass = 'text-danger';
                            elseif($f->condition == 'Rusak Ringan') $condClass = 'text-warning';
                        @endphp
                        <span class="fw-bold small {{ $condClass }}">{{ strtoupper($f->condition) }}</span>
                    </td>
                    <td class="fw-bold text-dark">{{ $f->stock }} <small class="text-muted fw-normal">Unit</small></td>
                    <td class="text-end">
                        @if($f->stock == 0)
                            <span class="badge border border-danger text-danger bg-white rounded-0 px-2 py-1 small">STOK HABIS</span>
                        @elseif($f->stock <= $f->minimum_stock)
                            <span class="badge border border-warning text-warning bg-white rounded-0 px-2 py-1 small">PEMASOKAN ULANG</span>
                        @else
                            <span class="badge border border-success text-success bg-white rounded-0 px-2 py-1 small">AMAN</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-file-earmark-x fs-1 text-muted opacity-25 d-block mb-3"></i>
                        <p class="text-muted">Tidak ada data aset yang sesuai dengan kriteria filter.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
