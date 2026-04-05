<header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-6">
      <div class="flex items-center justify-between h-14">
        <a href="{{ route('home') }}" class="flex-shrink-0">
          <img src="{{ asset(\'images/logo2.jpg\') }}" alt="PneuShop logo" class="h-8 w-auto object-contain" />
        </a>
        <div class="hidden md:block w-full max-w-md mx-auto">
          <div class="flex border border-gray-300 rounded-lg overflow-hidden">
            <input type="text" placeholder="Sem napíšte hľadané slovo" class="flex-1 px-4 py-1.5 text-sm outline-none bg-white placeholder-gray-400" />
            <button class="px-3 bg-white hover:bg-gray-50 border-l border-gray-300">
              <img src="{{ asset(\'images/icons/search.png\') }}" alt="Hladat" class="w-4 h-4" />
            </button>
          </div>
        </div>
        <div class="flex-1 md:hidden"></div>
        <div class="flex items-center gap-4 flex-shrink-0">
          <button class="md:hidden">
            <img src="{{ asset(\'images/icons/search.png\') }}" alt="Hladat" class="w-5 h-5" />
          </button>
          <div class="relative">
            <button type="button" class="header-login-toggle" aria-label="Účet" onclick="toggleHeaderLoginMenu(this)">
              <img src="{{ asset(\'images/icons/login.png\') }}" alt="Prihlasenie" class="w-6 h-6 hover:opacity-80 transition-opacity" />
            </button>
            <div class="header-login-menu hidden absolute right-0 mt-2 w-36 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
              <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-t-lg">Prihlásenie</a>
              <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-b-lg">Registrácia</a>
            </div>
          </div>
          <a href="{{ route('cart') }}" class="relative">
            <img src="{{ asset(\'images/icons/cart.png\') }}" alt="Kosik" class="w-6 h-6 hover:opacity-80 transition-opacity" />
            <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center leading-none font-medium">0</span>
          </a>
          <button class="lg:hidden" onclick="document.getElementById('mob-menu').classList.toggle('open')">
            <img src="{{ asset(\'images/icons/menu.png\') }}" alt="Menu" class="w-6 h-6" />
          </button>
        </div>
      </div>
    </div>
    <nav class="max-w-6xl mx-auto px-6 mt-4 hidden lg:block">
      <div class="bg-primary rounded-xl overflow-hidden shadow-sm">
        <ul class="flex items-center justify-between px-8 py-3.5 text-white text-sm font-medium w-full">
          <li><a href="{{ route('home') }}" class="hover:underline transition-colors">Domov</a></li>
          <li><a href="{{ route('products') }}" class="hover:underline transition-colors">Všetky pneu</a></li>
          <li><a href="{{ route('products', ['cat' => 'winter']) }}" class="hover:underline transition-colors">Zimné pneu</a></li>
          <li><a href="{{ route('products', ['cat' => 'summer']) }}" class="hover:underline transition-colors">Letné pneu</a></li>
          <li><a href="{{ route('products', ['cat' => 'moto']) }}" class="hover:underline transition-colors">Moto pneu</a></li>
          <li><a href="{{ route('products', ['cat' => 'tractor']) }}" class="hover:underline transition-colors">Traktorové pneu</a></li>
          <li><a href="{{ route('products', ['cat' => 'bicycle']) }}" class="hover:underline transition-colors">Cyklo pneu</a></li>
        </ul>
      </div>
    </nav>
    <div id="mob-menu" class="lg:hidden bg-primary text-white text-sm font-medium mt-2 pb-2">
      <ul>
        <li><a href="{{ route('home') }}" class="block px-5 py-2.5 border-b border-blue-400 hover:bg-primary-dark">Domov</a></li>
        <li><a href="{{ route('products') }}" class="block px-5 py-2.5 border-b border-blue-400 hover:bg-primary-dark">Všetky pneu</a></li>
        <li><a href="{{ route('products', ['cat' => 'winter']) }}" class="block px-5 py-2.5 border-b border-blue-400 hover:bg-primary-dark">Zimné pneu</a></li>
        <li><a href="{{ route('products', ['cat' => 'summer']) }}" class="block px-5 py-2.5 border-b border-blue-400 hover:bg-primary-dark">Letné pneu</a></li>
        <li><a href="{{ route('products', ['cat' => 'moto']) }}" class="block px-5 py-2.5 border-b border-blue-400 hover:bg-primary-dark">Moto pneu</a></li>
        <li><a href="{{ route('products', ['cat' => 'tractor']) }}" class="block px-5 py-2.5 border-b border-blue-400 hover:bg-primary-dark">Traktorové pneu</a></li>
        <li><a href="{{ route('products', ['cat' => 'bicycle']) }}" class="block px-5 py-2.5 hover:bg-primary-dark">Cyklo pneu</a></li>
      </ul>
    </div>
  </header>