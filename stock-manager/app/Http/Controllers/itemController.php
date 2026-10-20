<?php

namespace App\Http\Controllers;

use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class itemController extends Controller
{
    public function index()
    {
        $items = item::latest()->get();

        return view('items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:50', 'unique:items,sku'],
            'quantity' => ['required', 'integer', 'min:0'],
            'unit_price' => ['required', 'numeric', 'min:0'],
        ]);

        item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, item $item)
    {
        $validated = $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:50', Rule::unique('items', 'sku')->ignore($item->id)],
            'quantity' => ['required', 'integer', 'min:0'],
            'unit_price' => ['required', 'numeric', 'min:0'],
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(item $item)
    {
        $item->delete();

        return redirect()->route('items.index');
    }
}
