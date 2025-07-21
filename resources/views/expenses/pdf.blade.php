<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expense Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
        }
        .total {
            margin-top: 16px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>Expense Report</h2>

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
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->title }}</td>
                    <td>{{ $expense->category->name ?? '-' }}</td>
                    <td>{{ number_format($expense->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: Rs {{ number_format($expenses->sum('amount'), 2) }}</p>
</body>
</html>
