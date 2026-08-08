<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Http\Request;

class AdminBudgetController extends Controller
{
    public function index(Request $request)
    {
        $query = Budget::query();

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $budgets = $query->orderBy('year', 'desc')->orderBy('type', 'asc')->paginate(15);
        $years = Budget::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('admin.budgets.index', compact('budgets', 'years'));
    }

    public function create()
    {
        return view('admin.budgets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'type' => 'required|string|in:pendapatan,belanja,pembiayaan',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        Budget::create($validated);

        return redirect()->route('admin.budgets.index')->with('success', 'Data Dana Desa / APBDes berhasil ditambahkan!');
    }

    public function edit(Budget $budget)
    {
        return view('admin.budgets.edit', compact('budget'));
    }

    public function update(Request $request, Budget $budget)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'type' => 'required|string|in:pendapatan,belanja,pembiayaan',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $budget->update($validated);

        return redirect()->route('admin.budgets.index')->with('success', 'Data Dana Desa / APBDes berhasil diperbarui!');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect()->route('admin.budgets.index')->with('success', 'Data Dana Desa / APBDes berhasil dihapus!');
    }
}
