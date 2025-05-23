<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Producten</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-indigo-600">Mijn Producten</h1>
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
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl transition">
                        Uitloggen
                    </button>
                </form>
                @if (auth()->user()->admin)
                    <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl transition">
                        Product toevoegen
                    </a>
                @endif
            @endauth
        </div>
    </header>

    <!-- Producten lijst -->
    <main class="p-6 max-w-7xl mx-auto">
        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($ProductItems as $product)
                <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col justify-between space-y-4">
                    <div>
                        <h2 class="text-2xl font-bold text-indigo-700 mb-1">{{ $product->productnaam }}</h2>
                        <p class="text-gray-600 text-sm mb-2">{{ $product->beschrijving }}</p>
                        <p class="text-lg font-semibold text-green-600">€{{ number_format($product->prijs, 2, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('products.show', $product) }}"
                            class="text-blue-600 hover:underline text-sm">Details</a>

                        @auth
                            @if (auth()->user()->admin)
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="text-yellow-500 hover:underline text-sm">Bewerken</a>

                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')"
                                            class="text-red-500 hover:underline text-sm">
                                            Verwijderen
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </main>

</body>

</html>
