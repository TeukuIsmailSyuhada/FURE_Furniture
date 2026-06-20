<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Furniture;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = StockTransaction::with('furniture');

        if ($request->furniture_id) {
            $query->where('furniture_id', $request->furniture_id);
        }

        if ($request->start_date) {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }

        $transactions = $query->latest()->get();
        $furnitures = Furniture::all();

        return view('admin.stock-transactions.index', compact('transactions', 'furnitures'));
    }

    /**
     * Redirect ke halaman index dengan instruksi membuka modal tambah transaksi.
     * Form penambahan transaksi menggunakan modal Bootstrap, bukan halaman terpisah.
     */
    public function create()
    {
        return redirect()->route('stock-transactions.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'furniture_id' => 'required|exists:furniture,id',
            'type' => 'required|in:Masuk,Keluar',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $furniture = Furniture::findOrFail($request->furniture_id);

        if ($request->type == 'Keluar' && $furniture->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi untuk transaksi keluar.');
        }

        StockTransaction::create($request->all());

        if ($request->type == 'Masuk') {
            $furniture->increment('stock', $request->quantity);
        } else {
            $furniture->decrement('stock', $request->quantity);
        }

        return redirect()->route('stock-transactions.index')->with('success', 'Transaksi stok berhasil disimpan.');
    }
}
