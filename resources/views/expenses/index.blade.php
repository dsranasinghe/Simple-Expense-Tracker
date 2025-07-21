@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 900px;
        margin: 30px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #343a40;
        text-align: center;
        margin-bottom: 30px;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    form label {
        font-weight: 600;
        margin-right: 5px;
    }

    form input {
        padding: 6px 10px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        width: 100px;
    }

    form button {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #0056b3;
    }

    .actions {
        text-align: center;
        margin-bottom: 20px;
    }

    .actions a {
        margin: 0 10px;
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .actions a:hover {
        color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 15px;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    th {
        background-color: #343a40;
        color: white;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    .total {
        text-align: right;
        font-weight: bold;
        font-size: 18px;
        color: #343a40;
        margin-top: 25px;
    }
</style>

<div class="container">
    <h2>Expense Tracker</h2>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('expenses.index') }}">
        <label for="month">Month:</label>
        <input type="number" name="month" min="1" max="12" value="{{ request('month') }}">

        <label for="year">Year:</label>
        <input type="number" name="year" min="2000" value="{{ request('year') }}">

        <button type="submit">Filter</button>
    </form>

    <div class="actions">
        <a href="{{ route('expenses.create') }}">➕ Add New Expense</a>
        <a href="{{ route('expenses.export.pdf') }}">📄 Export to PDF</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Category</th>
                <th>Amount (Rs)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($expenses as $expense)
                <tr>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->title }}</td>
                    <td>{{ $expense->category->name ?? '-' }}</td>
                    <td>{{ number_format($expense->amount, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: gray;">No expenses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total: Rs {{ number_format($expenses->sum('amount'), 2) }}
    </div>
</div>
@endsection
