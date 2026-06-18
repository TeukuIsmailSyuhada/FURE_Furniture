@extends('layouts.admin')

@section('title', 'Kategori Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Master Kategori</li>
@endsection

@section('content')
<div class="page-header d-flex justify-content-between align-items-end">
    <div>
        <h1 class="page-title">Kategori Aset</h1>
        <p class="page-subtitle">Kelola klasifikasi furniture untuk mempermudah organisasi dan pencarian dataset.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="bi bi-plus-lg me-2"></i> Kategori Baru
    </button>
</div>

<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width: 80px;">NO.</th>
                    <th>NAMA KLASIFIKASI</th>
                    <th>SLUG SISTEM</th>
                    <th>DESKRIPSI</th>
                    <th class="text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td class="text-muted tiny fw-bold">#{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                    <td><span class="fw-bold text-dark text-uppercase ls-wide" style="font-size: 0.85rem;">{{ $category->name }}</span></td>
                    <td><span class="badge bg-fure-bg text-fure-primary rounded-0 px-2 py-1 small fw-normal">{{ $category->slug }}</span></td>
                    <td class="text-muted small">{{ Str::limit($category->description, 80) }}</td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-outline-primary p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                                <i class="bi bi-pencil-square" style="font-size: 0.8rem;"></i>
                            </button>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Data yang terkait mungkin akan terpengaruh.')">
                                    <i class="bi bi-trash" style="font-size: 0.8rem;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg">
                            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header border-0 p-4 pb-0">
                                    <h4 class="playfair mb-0">Modifier Kategori</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="mb-4">
                                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Nama Kategori</label>
                                        <input type="text" name="name" class="form-control border-0 bg-fure-bg py-3" value="{{ $category->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Deskripsi Klasifikasi</label>
                                        <textarea name="description" class="form-control border-0 bg-fure-bg py-3" rows="4">{{ $category->description }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 p-4 pt-0">
                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary px-4">Perbarui Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-tags fs-1 text-muted opacity-25 d-block mb-3"></i>
                        <p class="text-muted">Database kategori masih kosong.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4 pb-0">
                    <h4 class="playfair mb-0">Registrasi Kategori</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-4">Tambahkan klasifikasi baru untuk mempermudah pelacakan aset furniture Anda.</p>
                    <div class="mb-4">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Nama Kategori</label>
                        <input type="text" name="name" class="form-control border-0 bg-fure-bg py-3" placeholder="Contoh: Executive Desk" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Deskripsi Klasifikasi</label>
                        <textarea name="description" class="form-control border-0 bg-fure-bg py-3" rows="4" placeholder="Berikan deskripsi singkat tentang kategori ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
