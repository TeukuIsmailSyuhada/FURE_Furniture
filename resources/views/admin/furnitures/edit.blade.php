@extends('layouts.admin')

@section('title', 'Edit Furniture')

@section('content')
<div class="mb-4">
    <a href="{{ route('furnitures.index') }}" class="text-decoration-none text-muted small">← Kembali ke Daftar Furniture</a>
    <h2 class="fw-bold mt-2">Edit Furniture: {{ $furniture->name }}</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('furnitures.update', $furniture->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Informasi Barang</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kode Furniture</label>
                            <input type="text" name="code" class="form-control" value="{{ $furniture->code }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Furniture</label>
                            <input type="text" name="name" class="form-control" value="{{ $furniture->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $furniture->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Lokasi Simpan</label>
                            <select name="location_id" class="form-select" required>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ $furniture->location_id == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Spesifikasi & Kondisi</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Material</label>
                            <input type="text" name="material" class="form-control" value="{{ $furniture->material }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Warna</label>
                            <input type="text" name="color" class="form-control" value="{{ $furniture->color }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Ukuran</label>
                            <input type="text" name="size" class="form-control" value="{{ $furniture->size }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Berat</label>
                            <input type="text" name="weight" class="form-control" value="{{ $furniture->weight }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Kondisi</label>
                            <select name="condition" class="form-select" required>
                                @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'] as $con)
                                    <option value="{{ $con }}" {{ $furniture->condition == $con ? 'selected' : '' }}>{{ $con }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Aktif" {{ $furniture->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ $furniture->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Stok & Media</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Stok Saat Ini (Hanya Lihat)</label>
                            <input type="number" name="stock" class="form-control bg-light" value="{{ $furniture->stock }}" readonly>
                            <div class="form-text small">Gunakan menu <strong>Stok Barang</strong> untuk menambah/mengurangi stok.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Stok Minimum (Peringatan)</label>
                            <input type="number" name="minimum_stock" class="form-control" value="{{ $furniture->minimum_stock }}" min="0" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Ganti Gambar Furniture</label>
                            @if($furniture->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $furniture->image) }}" class="rounded shadow-sm" style="width: 150px; height: 100px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Deskripsi Tambahan</label>
                            <textarea name="description" class="form-control" rows="4">{{ $furniture->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <button type="submit" class="btn btn-primary px-5 py-2">Perbarui Data</button>
                <a href="{{ route('furnitures.index') }}" class="btn btn-light px-4 py-2 ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
