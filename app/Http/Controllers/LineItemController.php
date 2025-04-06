<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\LineItem_;
use Illuminate\Http\Request;

class LineItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lineItems = LineItem::latest()->paginate(7);
        return view('lineitems.index', ['lineItems' => $lineItems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LineItem $lineItem_)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LineItem $lineItem_)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LineItem $lineItem_)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LineItem $lineItem_)
    {
        //
    }
}
