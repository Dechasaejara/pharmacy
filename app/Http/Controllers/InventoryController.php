<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Pharmacy;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Auth::user()->profile;
        $query = Inventory::query();
        if ($profile->role === 'pharmacist') {
            $query->where('pharmacy_id', $profile->pharmacy->id);
        }
        $inventories = $query->with('pharmacy', 'product')->latest()->paginate(7);
        return view('inventories.index', ['inventories' => $inventories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pharmacies = Pharmacy::all(); 
        $products = Product::all(); 

        return view('inventories.create', compact('pharmacies', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // 'pharmacy_id' => 'required|exists:pharmacies,id',
                'product_id' => 'required|exists:products,id',
                'batch_number' => 'nullable|string|max:255',
                'manufacturer' => 'nullable|string|max:255',
                'expiry_date' => 'nullable|date',
                'quantity' => 'required|integer|min:0',
                'unit_price' => 'required|numeric|min:0',
                'tax' => 'nullable|numeric|min:0',
                'storage_location' => 'nullable|string|max:255',
                'is_active' => 'required|boolean',
            ]);
            $profile = Auth::user()->profile;
            Inventory::create($validated);

            return redirect()->route('inventories.index')->with('success', 'Inventory added successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Error creating inventory: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create inventory. Are you sure not duplicating inventory item?');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        $pharmacies = Pharmacy::all(); // Fetch all pharmacies
        $products = Product::all(); // Fetch all products

        return view('inventories.edit', compact('inventory', 'pharmacies', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            // 'pharmacy_id' => 'required|exists:pharmacies,id',
            'product_id' => 'required|exists:products,id',
            'batch_number' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'storage_location' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $inventory->update($validated);

        return redirect()->route('inventories.index')->with('success', 'Inventory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventory deleted successfully.');
    }
}
