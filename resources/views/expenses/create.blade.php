@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 600px;
        margin: 30px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #343a40;
        text-align: center;
        margin-bottom: 25px;
    }

    .error-messages {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
    }

    form div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
        color: #495057;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        background-color: #f8f9fa;
        font-size: 15px;
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: #007bff;
        background-color: #ffffff;
    }

    button {
        display: inline-block;
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #218838;
    }

    a {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    a:hover {
        color: #0056b3;
    }
</style>

<div class="container">
    <h2>Add New Expense</h2>

    @if($errors->any())
        <div class="error-messages">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label for="amount">Amount (Rs):</label>
            <input type="number" name="amount" step="0.01" value="{{ old('amount') }}" required>
        </div>

        <div>
            <label for="category_id">Category:</label>
            <select name="category_id" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="date">Date:</label>
            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
        </div>

        <button type="submit">💾 Save Expense</button>
    </form>

    <a href="{{ route('expenses.index') }}">⬅ Back to Expenses</a>
</div>
@endsection
