<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>{{ $product->productnaam }}</title>
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
                        Add Product
                    </a>
                @endif
            @endauth
        </div>
    </header>

    <!-- Product Details -->
    <main class="p-6 max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-6 text-center">
            <h1 class="text-3xl font-bold text-indigo-600 mb-4">{{ $product->productnaam }}</h1>
            <h2 class="text-xl text-gray-700">Prijs: <span class="font-semibold">€ {{ number_format($product->prijs, 2, ',', '.') }}</span></h2>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('products.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-xl transition">
                Terug naar overzicht
            </a>

            @auth
                @if (auth()->user()->admin)
                    <a href="{{ route('products.edit', $product) }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl transition ml-2">
                        Bewerk
                    </a>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline ml-2"
                        onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition">
                            Verwijder
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </main>

</body>

</html>
