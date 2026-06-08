@extends('layouts.admin')

@section('title', 'Tambah Furniture')

@section('content')
<div class="mb-4">
    <a href="{{ route('furnitures.index') }}" class="text-decoration-none text-muted small">← Kembali ke Daftar Furniture</a>
    <h2 class="fw-bold mt-2">Tambah Furniture Baru</h2>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('furnitures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Informasi Barang</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kode Furniture</label>
                            <input type="text" name="code" class="form-control" placeholder="FUR-00X" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Furniture</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Barang" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Lokasi Simpan</label>
                            <select name="location_id" class="form-select" required>
                                <option value="">Pilih Lokasi</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->name }}</option>
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
                            <input type="text" name="material" class="form-control" placeholder="Contoh: Kayu Jati">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Warna</label>
                            <input type="text" name="color" class="form-control" placeholder="Contoh: Coklat">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Ukuran</label>
                            <input type="text" name="size" class="form-control" placeholder="100x50x40 cm">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Berat</label>
                            <input type="text" name="weight" class="form-control" placeholder="5 kg">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Kondisi</label>
                            <select name="condition" class="form-select" required>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                                <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
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
                            <label class="form-label fw-bold">Stok Awal</label>
                            <input type="number" name="stock" class="form-control" value="0" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Stok Minimum (Peringatan)</label>
                            <input type="number" name="minimum_stock" class="form-control" value="5" min="0" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Gambar Furniture</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <div class="form-text small">Upload foto furniture yang jelas (Maks 2MB).</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Deskripsi Tambahan</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <button type="submit" class="btn btn-primary px-5 py-2">Simpan Data Furniture</button>
                <a href="{{ route('furnitures.index') }}" class="btn btn-light px-4 py-2 ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
