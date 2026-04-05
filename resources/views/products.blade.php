@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
      <button onclick="document.getElementById('mobile-filters').classList.toggle('hidden')" class="w-full mb-6 lg:hidden bg-white border border-gray-300 text-gray-800 font-bold py-2.5 rounded flex items-center justify-center gap-2 shadow-sm">
        <img src="{{ asset(\'images/icons/filter.png\') }}" alt="Filter" class="w-4 h-4 opacity-70" />
        Filtrovať produkty
      </button>
      <aside id="mobile-filters" class="w-full lg:w-52 flex-shrink-0 hidden lg:block text-sm mb-6 lg:mb-0">
        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Cena za 1 ks</p>
          <div class="flex items-center gap-6">
            <div class="flex-1 border-b border-gray-400 flex items-baseline pb-1">
              <span class="font-bold text-gray-900 mr-2">od</span>
              <input type="number" value="22" class="w-full text-gray-500 outline-none bg-transparent" />
            </div>
            <div class="flex-1 border-b border-gray-400 flex items-baseline pb-1">
              <span class="font-bold text-gray-900 mr-2">do</span>
              <input type="number" value="270" class="w-full text-gray-500 outline-none bg-transparent" />
            </div>
          </div>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Sezónnosť</p>
          <label class="flex items-center gap-2 mb-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">celoročné</span></label>
          <label class="flex items-center gap-2 mb-2 cursor-pointer"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">zimné</span></label>
          <div class="pl-6 mb-2 space-y-2">
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">s hrotmi</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">bez hrotov</span></label>
          </div>
          <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">letné</span></label>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Šírka (mm)</p>
          <div class="grid grid-cols-3 gap-y-2">
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">195</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">225</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">255</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">205</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">235</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">265</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">215</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">245</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">275</span></label>
          </div>
          <button class="text-primary mt-3 font-medium text-xs hover:underline">Ukázať všetky</button>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Profil (%)</p>
          <div class="grid grid-cols-3 gap-y-2">
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">35</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">50</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">65</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">40</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">55</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">70</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">45</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">60</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">75</span></label>
          </div>
          <button class="text-primary mt-3 font-medium text-xs hover:underline">Ukázať všetky</button>
        </div>

        <div class="mb-8">
          <p class="font-bold text-gray-900 mb-3 text-base">Priemer (")</p>
          <div class="grid grid-cols-3 gap-y-2">
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R10</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R15</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R21</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R10.5</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R16</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R22</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R11</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R17</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R22.5</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R11.5</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R18</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R23</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R12</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R19</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R24</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R12.5</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R19.5</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R26</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R13</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R20</span></label>
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="w-4 h-4 rounded border-gray-300" /><span class="text-gray-700 font-medium">R14</span></label>
          </div>
        </div>
        <button onclick="document.getElementById('mobile-filters').classList.add('hidden')" class="lg:hidden w-full bg-primary text-white font-bold py-3 rounded-lg mt-4">
        Zobraziť výsledky
        </button>
        <button class="hidden lg:block w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 rounded-lg transition-colors">
            Filtrovať
          </button>
      </aside>

      <div class="flex-1 min-w-0">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
          <div class="flex items-center gap-1">
            <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&laquo;</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&lsaquo;</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-primary font-bold rounded text-sm">1</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">2</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">&rsaquo;</button>
            <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">&raquo;</button>
          </div>
          <div class="relative">
            <select class="appearance-none border border-gray-200 rounded px-4 py-1.5 text-xs font-medium text-gray-800 pr-8 outline-none focus:border-primary bg-white cursor-pointer">
              <option>Predvolené</option>
              <option>Cena: od najnižšej</option>
              <option>Cena: od najvyššej</option>
              <option>Najnovšie</option>
            </select>
            <img src="{{ asset(\'images/icons/chevron-down.png\') }}" alt="Šípka dole" class="absolute right-2 top-1/2 -translate-y-1/2 w-3 h-3 pointer-events-none opacity-50" />
          </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-6">
          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <img src="{{ asset(\'images/products/letne1.jpg\') }}" alt="Michelin Pilot Sport 4" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-6xl leading-none">☀</span>
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">michelin Pilot Sport 4</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★★<span class="text-gray-300">★</span></span>
                <span class="text-sm text-primary font-medium ml-1">5 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">172 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>

          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-5xl leading-none">❄</span>
              <img src="{{ asset(\'images/products/zimne2.jpg\') }}" alt="Michelin Pilot Sport 4" class="absolute inset-0 w-full h-full object-cover" />
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">Michelin X-Ice Snow</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★<span class="text-gray-300">★★</span></span>
                <span class="text-sm text-primary font-medium ml-1">2 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">218 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>

          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <img src="{{ asset(\'images/products/letne4.jpg\') }}" alt="Michelin Pilot Sport 4" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-6xl leading-none">☀</span>
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">Continental SportContact</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★<span class="text-gray-300">★★</span></span>
                <span class="text-sm text-primary font-medium ml-1">17 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">99 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>

          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <img src="{{ asset(\'images/products/letne2.jpg\') }}" alt="Michelin Pilot Sport 4" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-6xl leading-none">☀</span>
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">michelin Pilot Sport 4</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★★<span class="text-gray-300">★</span></span>
                <span class="text-sm text-primary font-medium ml-1">5 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">172 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>

          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <img src="{{ asset(\'images/products/zimne1.jpg\') }}" alt="Michelin X-Ice Snow" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-5xl leading-none">❄</span>
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">Michelin X-Ice Snow</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★<span class="text-gray-300">★★</span></span>
                <span class="text-sm text-primary font-medium ml-1">2 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">218 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>

          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <img src="{{ asset(\'images/products/letne5.jpg\') }}" alt="Michelin Pilot Sport 4" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-6xl leading-none">☀</span>
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">Continental SportContact</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★<span class="text-gray-300">★★</span></span>
                <span class="text-sm text-primary font-medium ml-1">17 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">99 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>

          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <img src="{{ asset(\'images/products/letne3.jpg\') }}" alt="Michelin Pilot Sport 4" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-6xl leading-none">☀</span>
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">michelin Pilot Sport 4</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★★<span class="text-gray-300">★</span></span>
                <span class="text-sm text-primary font-medium ml-1">5 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">172 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>

          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <img src="{{ asset(\'images/products/zimne3.jpg\') }}" alt="Michelin Pilot Sport 4" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-5xl leading-none">❄</span>
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">Michelin X-Ice Snow</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★<span class="text-gray-300">★★</span></span>
                <span class="text-sm text-primary font-medium ml-1">2 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">218 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>

          <div class="border border-gray-200 rounded flex flex-col bg-white overflow-hidden group">
            <div class="img-ph w-full aspect-square relative border-b border-gray-200">
              <img src="{{ asset(\'images/products/letne6.jpg\') }}" alt="Michelin Pilot Sport 4" class="absolute inset-0 w-full h-full object-cover" />
              <span class="absolute top-1 right-1 z-10 text-yellow-500 text-6xl leading-none">☀</span>
            </div>
            <div class="p-4 flex flex-col flex-1 text-left">
              <p class="font-bold text-sm mb-2 text-gray-900 group-hover:text-primary transition-colors">Continental SportContact</p>
              <div class="flex items-center gap-1 mb-4">
                <span class="text-yellow-400 text-xl tracking-widest">★★★<span class="text-gray-300">★★</span></span>
                <span class="text-sm text-primary font-medium ml-1">17 recenzií</span>
              </div>
              <div class="mt-auto mb-4 flex items-baseline gap-1">
                <span class="text-gray-500 font-bold text-xs">od</span>
                <span class="font-bold text-base text-gray-900">99 €</span>
              </div>
              <a href="{{ route('product.detail') }}" class="block w-full text-center bg-primary hover:bg-primary-dark text-white font-medium text-xs py-2.5 rounded transition-colors">
                Viac informácií
              </a>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-center gap-1 mt-10">
          <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&laquo;</button>
          <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-300 rounded text-sm font-medium hover:bg-gray-50">&lsaquo;</button>
          <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-primary font-bold rounded text-sm">1</button>
          <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">2</button>
          <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">&rsaquo;</button>
          <button class="w-8 h-8 flex items-center justify-center border border-gray-200 bg-white text-gray-400 rounded text-sm font-medium hover:bg-gray-50 hover:text-primary">&raquo;</button>
        </div>
      </div>
    </div>
  </div>

  <div class="py-10"></div>
@endsection

@push('scripts')
<script>
  function toggleHeaderLoginMenu(button) {
    const menu = button.nextElementSibling;
    if (!menu) return;

    menu.classList.toggle('hidden');
  }

  document.addEventListener('click', function (event) {
    document.querySelectorAll('.header-login-menu').forEach(function (menu) {
      const toggle = menu.previousElementSibling;
      if (!menu.contains(event.target) && (!toggle || !toggle.contains(event.target))) {
        menu.classList.add('hidden');
      }
    });
  });
</script>
@endpush
