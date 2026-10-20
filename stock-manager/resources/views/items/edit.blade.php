<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item | Stock Manager</title>
    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --tf2-red: #a8462f;
            --tf2-red-dark: #713021;
            --tf2-gold: #c4a779;
            --tf2-cream: #e4d5bd;
            --tf2-bg: #211f1b;
            --tf2-text: #d6c8b3;
            --tf2-muted: #928474;
        }

        body {
            margin: 0;
            padding: 35px 25px;
            color: var(--tf2-text);
            background: radial-gradient(ellipse at top, #42372c 0%, transparent 65%), var(--tf2-bg);
            font-family: "Arial Narrow", "Trebuchet MS", Arial, sans-serif;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 760px;
            margin: auto;
        }

        h1 {
            color: var(--tf2-cream);
            font-size: 38px;
            font-weight: 900;
            text-transform: uppercase;
            border-bottom: 5px solid var(--tf2-red);
            padding-bottom: 15px;
            text-shadow: 2px 3px 0 #171411;
        }

        .card {
            padding: 25px;
            background: linear-gradient(145deg, #37312a, #26231f 70%);
            border: 1px solid #55483a;
            border-top: 3px solid #685441;
            border-radius: 5px;
            box-shadow: 0 5px 12px #00000050;
        }

        h2 {
            color: var(--tf2-cream);
            background: linear-gradient(90deg, var(--tf2-red-dark), #53372b);
            border-left: 6px solid var(--tf2-gold);
            margin: -25px -25px 25px;
            padding: 16px 22px;
            font-size: 22px;
            text-transform: uppercase;
            text-shadow: 1px 2px #000;
        }

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
            text-transform: uppercase;
        }

        input {
            width: 100%;
            min-width: 0;
            padding: 13px 14px;
            background: #1d1b18;
            border: 1px solid #665747;
            border-radius: 3px;
            color: var(--tf2-cream);
            font-size: 15px;
        }

        input:focus {
            outline: 2px solid var(--tf2-gold);
            outline-offset: 1px;
        }

        .error {
            margin: 7px 0 0;
            color: #e58b72;
            font-size: 13px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 24px;
        }

        button {
            padding: 14px 25px;
            background: linear-gradient(180deg, #b65338, #873823);
            border: 1px solid #c46b4c;
            border-bottom: 4px solid #632b1c;
            border-radius: 4px;
            color: #f0dfc5;
            font-size: 15px;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
        }

        a {
            color: var(--tf2-gold);
        }

        .success {
            padding: 14px;
            margin-bottom: 20px;
            background: #35422d;
            border: 1px solid #69794d;
            color: #d4e4b7;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .card {
                padding: 18px;
            }

            h1 {
                font-size: 30px;
            }

            h2 {
                margin: -18px -18px 20px;
                font-size: 19px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 17px;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <h1>Stock Manager</h1>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <section class="card">
            <h2>Edit Item</h2>

            <form method="POST" action="{{ route('items.update', $item) }}">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div>
                        <label for="item_name">Item Name</label>
                        <input
                            type="text"
                            id="item_name"
                            name="item_name"
                            value="{{ old('item_name', $item->item_name) }}"
                            required
                        >
                        @error('item_name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sku">SKU</label>
                        <input
                            type="text"
                            id="sku"
                            name="sku"
                            value="{{ old('sku', $item->sku) }}"
                            required
                        >
                        @error('sku')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="quantity">Quantity</label>
                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            value="{{ old('quantity', $item->quantity) }}"
                            min="0"
                            required
                        >
                        @error('quantity')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_price">Unit Price</label>
                        <input
                            type="number"
                            id="unit_price"
                            name="unit_price"
                            value="{{ old('unit_price', $item->unit_price) }}"
                            min="0"
                            step="0.01"
                            required
                        >
                        @error('unit_price')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="actions">
                    <button type="submit">Update Item</button>
                    <a href="{{ route('items.index') }}">Cancel</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>