<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Furniture::with(['category', 'location']);

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->location_id) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->condition) {
            $query->where('condition', $request->condition);
        }

        if ($request->status_stok == 'Habis') {
            $query->where('stock', 0);
        } elseif ($request->status_stok == 'Menipis') {
            $query->whereColumn('stock', '<=', 'minimum_stock')->where('stock', '>', 0);
        }

        $furnitures = $query->latest()->get();
        $categories = Category::all();
        $locations = Location::all();

        return view('admin.reports.index', compact('furnitures', 'categories', 'locations'));
    }

    public function print(Request $request)
    {
        $query = Furniture::with(['category', 'location']);

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->location_id) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->condition) {
            $query->where('condition', $request->condition);
        }

        if ($request->status_stok == 'Habis') {
            $query->where('stock', 0);
        } elseif ($request->status_stok == 'Menipis') {
            $query->whereColumn('stock', '<=', 'minimum_stock')->where('stock', '>', 0);
        }

        $furnitures = $query->latest()->get();

        return view('admin.reports.print', compact('furnitures'));
    }
}
