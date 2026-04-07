<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin | PneuShop')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script>tailwind.config = { theme: { extend: { colors: { primary: '#646cfe', 'primary-dark': '#4A4ECC' }, fontFamily: { sans: ['Inter', 'sans-serif'] } } } }</script>
  <style>
    #mob-menu { display: none; }
    #mob-menu.open { display: block; }
  </style>
  @stack('styles')
</head>

<body class="font-sans bg-gray-50 text-gray-900 flex h-screen overflow-hidden">
  <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex">
    <div class="h-16 flex items-center px-6 border-b border-gray-200">
      <img src="{{ asset('images/logo2.jpg') }}" class="h-8">
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('admin.products') }}" class="block {{ Route::is('admin.products') ? 'bg-primary/10 text-primary font-bold' : 'text-gray-600 hover:bg-gray-100 font-semibold' }} px-4 py-3 rounded-lg transition-colors">📦 Produkty</a>
      <a href="{{ route('admin.form') }}" class="block {{ Route::is('admin.form') ? 'bg-primary/10 text-primary font-bold' : 'text-gray-600 hover:bg-gray-100 font-semibold' }} px-4 py-3 rounded-lg transition-colors">➕ Pridať produkt</a>
      <a href="#" class="block text-gray-600 hover:bg-gray-100 font-semibold px-4 py-3 rounded-lg transition-colors">🛒 Objednávky</a>
    </nav>
    <div class="p-4 border-t">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full text-red-500 hover:bg-red-50 font-bold px-4 py-3 rounded-lg text-center transition-colors">Odhlásiť sa</button>
      </form>
    </div>
  </aside>

  <main class="flex-1 flex flex-col h-screen overflow-y-auto">
    <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
      <h1 class="text-xl font-bold">@yield('header_title', 'Dashboard')</h1>
      @yield('header_action')
    </header>

    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>
