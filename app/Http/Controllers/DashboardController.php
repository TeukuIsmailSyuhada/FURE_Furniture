<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Furniture;
use App\Models\Category;
use App\Models\Location;
use App\Models\StockTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_furniture' => Furniture::count(),
            'total_categories' => Category::count(),
            'total_locations' => Location::count(),
            'total_stock' => Furniture::sum('stock'),
            'low_stock' => Furniture::whereColumn('stock', '<=', 'minimum_stock')->where('stock', '>', 0)->count(),
            'out_of_stock' => Furniture::where('stock', 0)->count(),
            'broken_items' => Furniture::whereIn('condition', ['Rusak Ringan', 'Rusak Berat'])->count(),
            'latest_furniture' => Furniture::with(['category', 'location'])->latest()->take(5)->get(),
            'latest_transactions' => StockTransaction::with('furniture')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
