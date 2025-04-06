<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $auth_user = Auth::getUser()->id;
        // $user = User::Where('id', $auth_user)->get();
        // // dd($user);
        // $profile = Profile::Where('user_id', $auth_user)->get(); //where('user_id',$user)->get();
        // dd($profile);
        $products = Product::latest()->paginate(7);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'generic_name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            $validated['picture'] = $request->file('picture')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'generic_name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            // Delete the old picture if it exists
            if ($product->picture) {
                Storage::disk('public')->delete($product->picture);
            }
            $validated['picture'] = $request->file('picture')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete the picture if it exists
        if ($product->picture) {
            Storage::disk('public')->delete($product->picture);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
