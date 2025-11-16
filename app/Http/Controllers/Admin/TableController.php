<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::orderBy('name')->paginate(20)->withQueryString();
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables',
            'capacity' => 'required|integer|min:1|max:20',
            'position_x' => 'nullable|integer',
            'position_y' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Table::create($validated);

        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil ditambahkan');
    }

    public function show(Table $meja)
    {
        $meja->load('reservations');
        return view('admin.tables.show', ['table' => $meja]);
    }

    public function edit(Table $meja)
    {
        return view('admin.tables.edit', ['table' => $meja]);
    }

    public function update(Request $request, Table $meja)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tables,name,' . $meja->id,
            'capacity' => 'required|integer|min:1|max:20',
            'position_x' => 'nullable|integer',
            'position_y' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $meja->update($validated);

        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil diupdate');
    }

    public function destroy(Table $meja)
    {
        // Check if table has active reservations
        $hasActiveReservations = $meja->reservations()
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('reservation_date', '>=', now())
            ->exists();

        if ($hasActiveReservations) {
            return redirect()->back()
                ->with('error', 'Meja tidak dapat dihapus karena memiliki reservasi aktif');
        }

        $meja->delete();

        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil dihapus');
    }
}
