@extends('layouts.admin')

@section('title', 'Lokasi Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Master Lokasi</li>
@endsection

@section('content')
<div class="page-header d-flex justify-content-between align-items-end">
    <div>
        <h1 class="page-title">Lokasi Aset</h1>
        <p class="page-subtitle">Kelola titik distribusi dan penyimpanan furniture di seluruh area operasional.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLocationModal">
        <i class="bi bi-plus-lg me-2"></i> Lokasi Baru
    </button>
</div>

<div class="card overflow-hidden">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width: 80px;">NO.</th>
                    <th>IDENTITAS LOKASI</th>
                    <th>DESKRIPSI OPERASIONAL</th>
                    <th class="text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($locations as $location)
                <tr>
                    <td class="text-muted tiny fw-bold">#{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt text-fure-primary me-2"></i>
                            <span class="fw-bold text-dark text-uppercase ls-wide" style="font-size: 0.85rem;">{{ $location->name }}</span>
                        </div>
                    </td>
                    <td class="text-muted small">{{ $location->description ?: 'Tidak ada deskripsi operasional.' }}</td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-outline-primary p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" data-bs-toggle="modal" data-bs-target="#editLocationModal{{ $location->id }}">
                                <i class="bi bi-pencil-square" style="font-size: 0.8rem;"></i>
                            </button>
                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" onclick="return confirm('Hapus lokasi ini? Data terkait mungkin akan terpengaruh.')">
                                    <i class="bi bi-trash" style="font-size: 0.8rem;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editLocationModal{{ $location->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg">
                            <form action="{{ route('locations.update', $location->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header border-0 p-4 pb-0">
                                    <h4 class="playfair mb-0">Modifier Lokasi</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="mb-4">
                                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Nama Lokasi</label>
                                        <input type="text" name="name" class="form-control border-0 bg-fure-bg py-3" value="{{ $location->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Deskripsi Lokasi</label>
                                        <textarea name="description" class="form-control border-0 bg-fure-bg py-3" rows="4">{{ $location->description }}</textarea>
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
                    <td colspan="4" class="text-center py-5">
                        <i class="bi bi-geo-alt fs-1 text-muted opacity-25 d-block mb-3"></i>
                        <p class="text-muted">Belum ada data koordinat lokasi.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('locations.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 p-4 pb-0">
                    <h4 class="playfair mb-0">Registrasi Lokasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-4">Daftarkan area atau unit ruangan baru untuk penempatan furniture.</p>
                    <div class="mb-4">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Nama Lokasi</label>
                        <input type="text" name="name" class="form-control border-0 bg-fure-bg py-3" placeholder="Contoh: Gallery West Wing" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label tiny fw-bold text-uppercase ls-wide text-muted">Deskripsi Lokasi</label>
                        <textarea name="description" class="form-control border-0 bg-fure-bg py-3" rows="4" placeholder="Berikan detail lokasi atau petunjuk arah..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4">Simpan Lokasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
