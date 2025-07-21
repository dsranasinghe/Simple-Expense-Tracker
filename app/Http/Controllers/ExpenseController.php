<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = Expense::with('category');

        if ($month) {
            $query->whereMonth('date', $month);
        }

        if ($year) {
            $query->whereYear('date', $year);
        }

        $expenses = $query->orderBy('date', 'desc')->get();

        return view('expenses.index', compact('expenses', 'month', 'year'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);

        Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'date' => $request->date,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }

    public function exportPdf()
    {
        $expenses = \App\Models\Expense::with('category')->get();

        $pdf = Pdf::loadView('expenses.pdf', compact('expenses'));
        return $pdf->download('expense-report.pdf');
    }
   
}
