<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use App\Models\Category;
use App\Models\Location;
use App\Models\ConditionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FurnitureController extends Controller
{
    public function index(Request $request)
    {
        $query = Furniture::with(['category', 'location']);

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->location_id) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->condition) {
            $query->where('condition', $request->condition);
        }

        $furnitures = $query->latest()->get();
        $categories = Category::all();
        $locations = Location::all();

        return view('admin.furnitures.index', compact('furnitures', 'categories', 'locations'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.furnitures.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:furniture',
            'name' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'condition' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('furnitures', 'public');
        }

        Furniture::create($data);

        return redirect()->route('furnitures.index')->with('success', 'Furniture berhasil ditambahkan.');
    }

    public function show(Furniture $furniture)
    {
        $furniture->load(['category', 'location', 'stockTransactions', 'conditionLogs']);
        return view('admin.furnitures.show', compact('furniture'));
    }

    public function edit(Furniture $furniture)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('admin.furnitures.edit', compact('furniture', 'categories', 'locations'));
    }

    public function update(Request $request, Furniture $furniture)
    {
        $request->validate([
            'code' => 'required|unique:furniture,code,' . $furniture->id,
            'name' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'condition' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($furniture->image) {
                Storage::disk('public')->delete($furniture->image);
            }
            $data['image'] = $request->file('image')->store('furnitures', 'public');
        }

        // Handle condition change history
        if ($furniture->condition != $request->condition) {
            ConditionLog::create([
                'furniture_id' => $furniture->id,
                'old_condition' => $furniture->condition,
                'new_condition' => $request->condition,
                'note' => 'Perubahan melalui menu edit furniture',
                'changed_at' => now(),
            ]);
        }

        $furniture->update($data);

        return redirect()->route('furnitures.index')->with('success', 'Furniture berhasil diperbarui.');
    }

    public function destroy(Furniture $furniture)
    {
        if ($furniture->image) {
            Storage::disk('public')->delete($furniture->image);
        }
        $furniture->delete();
        return redirect()->route('furnitures.index')->with('success', 'Furniture berhasil dihapus.');
    }

    public function updateCondition(Request $request, Furniture $furniture)
    {
        $request->validate([
            'condition' => 'required',
            'note' => 'nullable|string',
        ]);

        $oldCondition = $furniture->condition;
        $furniture->condition = $request->condition;
        $furniture->save();

        ConditionLog::create([
            'furniture_id' => $furniture->id,
            'old_condition' => $oldCondition,
            'new_condition' => $request->condition,
            'note' => $request->note,
            'changed_at' => now(),
        ]);

        return back()->with('success', 'Kondisi furniture berhasil diubah.');
    }
}
