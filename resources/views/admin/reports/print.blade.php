<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Furniture - FURE</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body { background: white; font-family: 'Times New Roman', serif; }
        .table th { background-color: #f8f9fa !important; }
        @media print {
            .no-print { display: none; }
            .card { border: none; shadow: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-0">FURE</h1>
            <p class="text-muted">Manajemen Furniture Rapi & Efisien</p>
            <hr>
            <h3 class="mt-4">LAPORAN DATA FURNITURE</h3>
            <p>Dicetak pada: {{ date('d F Y, H:i') }}</p>
        </div>

        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Kode</th>
                    <th>Nama Furniture</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Kondisi</th>
                    <th class="text-center">Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($furnitures as $f)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="fw-bold">{{ $f->code }}</td>
                    <td>{{ $f->name }}</td>
                    <td>{{ $f->category->name }}</td>
                    <td>{{ $f->location->name }}</td>
                    <td>{{ $f->condition }}</td>
                    <td class="text-center fw-bold">{{ $f->stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5 text-end pe-5">
            <p class="mb-5">Mengetahui,</p>
            <br><br>
            <p class="fw-bold">____________________</p>
            <p>Admin FURE</p>
        </div>
    </div>

    <div class="no-print text-center py-4 bg-light border-top fixed-bottom">
        <button onclick="window.print()" class="btn btn-primary px-4">Cetak Sekarang</button>
        <button onclick="window.close()" class="btn btn-light px-4 ms-2">Tutup</button>
    </div>
</body>
</html>
