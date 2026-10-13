
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --tf2-red: #a8462f;
            --tf2-red-dark: #713021;
            --tf2-brown: #594536;
            --tf2-gold: #c4a779;
            --tf2-cream: #e4d5bd;
            --tf2-bg: #211f1b;
            --tf2-panel: #302b25;
            --tf2-panel-light: #3c352d;
            --tf2-border: #55483a;
            --tf2-text: #d6c8b3;
            --tf2-muted: #928474;
        }

        body {
            margin: 0;
            padding: 35px 25px;
            font-family: "Arial Narrow", "Trebuchet MS", Arial, sans-serif;
            color: var(--tf2-text);
            background:
                radial-gradient(ellipse at top, #42372c 0%, transparent 65%),
                var(--tf2-bg);
            min-height: 100vh;
        }

        /* Main content */

        .container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        /* Main title */

        h1 {
            color: var(--tf2-cream);
            font-size: clamp(30px, 5vw, 48px);
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 5px solid var(--tf2-red);
            padding-bottom: 15px;
            margin-bottom: 10px;
            text-shadow: 2px 3px 0 #171411;
        }

        .container > p {
            color: var(--tf2-muted);
            text-transform: uppercase;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 35px;
        }

        /* Inventory panels */

        .card {
            background:
                linear-gradient(145deg, #37312a, #26231f 70%);
            border: 1px solid var(--tf2-border);
            border-top: 3px solid #685441;
            border-radius: 5px;
            padding: 25px;
            margin-bottom: 28px;
            box-shadow:
                0 5px 12px #00000050,
                inset 0 1px 0 #ffffff0a;
        }

        /* Section titles */

        h2 {
            color: var(--tf2-cream);
            background: linear-gradient(
                90deg,
                var(--tf2-red-dark),
                #53372b
            );
            border-left: 6px solid var(--tf2-gold);
            margin: -25px -25px 25px;
            padding: 16px 22px;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 1px 2px #000;
        }

        /* Form layout */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: var(--tf2-gold);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Input fields */

        input {
            width: 100%;
            min-width: 0;
            padding: 13px 14px;
            background: #1d1b18;
            border: 1px solid #665747;
            border-radius: 3px;
            color: var(--tf2-cream);
            font-size: 15px;
            outline: none;
            box-shadow: inset 0 2px 5px #00000050;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input::placeholder {
            color: #82776a;
        }

        input:focus {
            border-color: var(--tf2-gold);
            box-shadow: 0 0 0 2px #c4a77925;
        }

        /* Buttons */

        button {
            display: inline-block;
            margin-top: 24px;
            padding: 14px 25px;
            background: linear-gradient(
                180deg,
                #b65338,
                #873823
            );
            color: #f0dfc5;
            border: 1px solid #c46b4c;
            border-bottom: 4px solid #632b1c;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 900;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            text-shadow: 1px 1px #542419;
            transition: filter 0.2s, transform 0.2s;
        }

        button:hover {
            filter: brightness(1.2);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(1px);
            border-bottom-width: 2px;
        }

        /* Success and validation messages */

        .success {
            padding: 14px;
            margin-bottom: 20px;
            background: #35422d;
            border: 1px solid #69794d;
            border-left: 5px solid #91a66c;
            color: #d4e4b7;
            border-radius: 3px;
        }

        .error {
            color: #e58b72;
            font-size: 13px;
            margin-top: 7px;
        }

        .card > .error {
            background: #422923;
            border: 1px solid #784235;
            padding: 12px 16px;
            margin-bottom: 18px;
        }

        .error ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        /* Inventory table */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 6px;
            font-size: 14px;
        }

        thead th {
            padding: 15px 13px;
            background: #40382f;
            color: var(--tf2-gold);
            border-top: 1px solid #645343;
            border-bottom: 2px solid var(--tf2-red);
            text-align: left;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        thead th:first-child {
            border-radius: 3px 0 0 3px;
        }

        thead th:last-child {
            border-radius: 0 3px 3px 0;
        }

        tbody tr {
            background: #27241f;
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: #42372c;
        }

        tbody td {
            padding: 17px 13px;
            border-top: 1px solid #40382f;
            border-bottom: 1px solid #40382f;
        }

        tbody td:first-child {
            border-left: 3px solid #675441;
            color: var(--tf2-gold);
            font-weight: bold;
        }

        tbody td:last-child {
            border-right: 1px solid #40382f;
        }

        .empty {
            color: var(--tf2-muted);
            text-align: center;
            padding: 30px;
        }

        /* Responsive design */

        @media (max-width: 700px) {
            body {
                padding: 20px 12px;
            }

            .card {
                padding: 18px;
            }

            h2 {
                margin: -18px -18px 20px;
                font-size: 19px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 17px;
            }

            table {
                min-width: 600px;
            }

            h1 {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Stock Manager</h1>
        <p>Add stock items and monitor your inventory.</p>

        <div class="card">
            <h2>Add New Item</h2>

            @if (session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error">
                    <strong>Please correct the following errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('items.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div>
                        <label for="item_name">Item Name</label>
                        <input
                            type="text"
                            id="item_name"
                            name="item_name"
                            value="{{ old('item_name') }}"
                            placeholder="e.g. Jufufu Plush"
                            required
                        >
                        @error('item_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="sku">SKU</label>
                        <input
                            type="text"
                            id="sku"
                            name="sku"
                            value="{{ old('sku') }}"
                            placeholder="e.g. JF-2026"
                            required
                        >
                        @error('sku')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="quantity">Quantity</label>
                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            value="{{ old('quantity', 0) }}"
                            min="0"
                            required
                        >
                        @error('quantity')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_price">Unit Price</label>
                        <input
                            type="number"
                            id="unit_price"
                            name="unit_price"
                            value="{{ old('unit_price') }}"
                            min="0"
                            step="0.01"
                            placeholder="e.g. 2600.00"
                            required
                        >
                        @error('unit_price')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit">Add Item</button>
            </form>
        </div>

        <div class="card">
            <h2>Inventory List</h2>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>SKU</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    {{ number_format($item->unit_price, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">
                                    No items added yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
