<?php

namespace App\Http\Controllers;

use App\Models\ConditionLog;
use App\Models\Furniture;
use Illuminate\Http\Request;

/**
 * ConditionLogController
 *
 * Mengelola log perubahan kondisi furniture.
 * Log dibuat secara otomatis oleh FurnitureController saat kondisi diubah.
 * Controller ini hanya menyediakan endpoint read-only untuk keperluan masa depan.
 */
class ConditionLogController extends Controller
{
    /**
     * Tampilkan daftar semua log kondisi furniture.
     * Saat ini log hanya bisa dilihat di halaman detail furniture (furnitures.show).
     */
    public function index()
    {
        // Redirect ke halaman furniture karena log kondisi
        // ditampilkan dalam konteks per-furniture, bukan secara global
        return redirect()->route('furnitures.index')
            ->with('info', 'Log kondisi dapat dilihat pada halaman detail setiap furniture.');
    }

    /**
     * Simpan log kondisi baru secara manual (jika diperlukan di masa depan).
     */
    public function store(Request $request)
    {
        $request->validate([
            'furniture_id' => 'required|exists:furniture,id',
            'old_condition' => 'required|string',
            'new_condition' => 'required|string',
            'note'          => 'nullable|string',
        ]);

        ConditionLog::create([
            'furniture_id'  => $request->furniture_id,
            'old_condition' => $request->old_condition,
            'new_condition' => $request->new_condition,
            'note'          => $request->note,
            'changed_at'    => now(),
        ]);

        return back()->with('success', 'Log kondisi berhasil disimpan.');
    }
}
