<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Bewerk Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-indigo-600">Mijn Producten</h1>
        <div class="space-x-4">
            @guest
                <a href="{{ route('login') }}"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-xl transition">
                    Login
                </a>
            @endguest

            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition">
                        Uitloggen
                    </button>
                </form>
                @if (auth()->user()->admin)
                    <a href="{{ route('products.create') }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl transition">
                        Nieuw Product
                    </a>
                @endif
            @endauth
        </div>
    </header>

    <!-- Edit Form -->
    <main class="p-6 max-w-xl mx-auto">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Product Bewerken</h2>

            <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="productnaam" class="block text-sm font-medium text-gray-700">Productnaam</label>
                    <input type="text" name="productnaam" id="productnaam" value="{{ old('productnaam', $product->productnaam) }}"
                        class="w-full mt-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-400">
                </div>

                <div>
                    <label for="prijs" class="block text-sm font-medium text-gray-700">Prijs (€)</label>
                    <input type="number" name="prijs" id="prijs" step="0.01" value="{{ old('prijs', $product->prijs) }}"
                        class="w-full mt-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-400">
                </div>

                <div>
                    <label for="beschrijving" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                    <input type="text" name="beschrijving" id="beschrijving" value="{{ old('beschrijving', $product->beschrijving) }}"
                        class="w-full mt-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-400">
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('products.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl transition">
                        Annuleren
                    </a>
                    <button type="submit"
                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-xl transition">
                        Opslaan
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
