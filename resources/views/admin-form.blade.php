@extends('layouts.app')

@section('content')
<div class="p-8 max-w-5xl">
            <form class="bg-white border border-gray-200 rounded-xl shadow-sm p-8 space-y-8">
                <div>
                    <h2 class="text-lg font-bold border-b pb-2 mb-4">Základné informácie</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Názov produktu</label>
                            <input type="text"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Cena (€)</label>
                            <input type="number" step="0.01"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Skladom (ks)</label>
                            <input type="number"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Opis produktu</label>
                            <textarea rows="4"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"></textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-bold border-b pb-2 mb-4">Kategorizácia a Parametre</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold mb-2">Hlavná kategória</label>
                            <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white">
                                <option>Osobné autá</option>
                                <option>Nákladné autá</option>
                                <option>Moto</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Podkategória</label>
                            <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white">
                                <option>Pneumatiky</option>
                                <option>Disky</option>
                                <option>Príslušenstvo</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Sezónnosť</label>
                            <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white">
                                <option>Letné</option>
                                <option>Zimné</option>
                                <option>Celoročné</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Šírka (mm)</label>
                            <select
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                <option>135</option>
                                <option>145</option>
                                <option>155</option>
                                <option>165</option>
                                <option>175</option>
                                <option>185</option>
                                <option selected>195</option>
                                <option>205</option>
                                <option>215</option>
                                <option>225</option>
                                <option>235</option>
                                <option>245</option>
                                <option>255</option>
                                <option>265</option>
                                <option>275</option>
                                <option>285</option>
                                <option>295</option>
                                <option>305</option>
                                <option>315</option>
                                <option>325</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Profil (%)</label>
                            <select
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                <option>25</option>
                                <option>30</option>
                                <option>35</option>
                                <option>40</option>
                                <option>45</option>
                                <option>50</option>
                                <option selected>55</option>
                                <option>60</option>
                                <option>65</option>
                                <option>70</option>
                                <option>75</option>
                                <option>80</option>
                                <option>85</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Priemer (")</label>
                            <select
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                <option>R12</option>
                                <option>R13</option>
                                <option>R14</option>
                                <option selected>R15</option>
                                <option>R16</option>
                                <option>R17</option>
                                <option>R18</option>
                                <option>R19</option>
                                <option>R20</option>
                                <option>R21</option>
                                <option>R22</option>
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="w-5 h-5 accent-primary rounded">
                                <span class="font-bold">Pneumatika s hrotmi</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-bold border-b pb-2 mb-4">Fotografie (min. 2)</h2>
                    <input type="file" multiple
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-gray-300 rounded-lg p-2 cursor-pointer">
                </div>

                <div class="pt-6 border-t flex justify-end gap-4">
                    <a href="{{ route('admin.products') }}"
                        class="px-6 py-3 text-gray-500 font-bold hover:bg-gray-100 rounded-lg transition-colors">Zrušiť</a>
                    <button type="submit"
                        class="bg-primary hover:bg-primary-dark text-white font-bold px-10 py-3 rounded-lg shadow-lg shadow-primary/20 hover:shadow-primary/40 -translate-y-0 hover:-translate-y-0.5 transition-all duration-200">
                        Uložiť produkt
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('scripts')
E html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Pridať produkt | PneuShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#646cfe', 'primary-dark': '#4A4ECC' }, fontFamily: { sans: ['Inter', 'sans-serif'] } } } }</script>
</head>

<body class="font-sans bg-gray-50 text-gray-900 flex h-screen overflow-hidden">
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex">
        <div class="h-16 flex items-center px-6 border-b border-gray-200">
            <img src="{{ asset(\'images/logo2.jpg\') }}" class="h-8">
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.products') }}"
                class="block text-gray-600 hover:bg-gray-100 font-semibold px-4 py-3 rounded-lg transition-colors">📦
                Produkty</a>
            <a href="{{ route('admin.form') }}"
                class="block bg-primary/10 text-primary font-bold px-4 py-3 rounded-lg transition-colors">➕ Pridať
                produkt</a>
            <a href="#"
                class="block text-gray-600 hover:bg-gray-100 font-semibold px-4 py-3 rounded-lg transition-colors">🛒
                Objednávky</a>
        </nav>
        <div class="p-4 border-t">
            <a href="{{ route('home') }}"
                class="block text-red-500 hover:bg-red-50 font-bold px-4 py-3 rounded-lg text-center transition-colors">Odhlásiť
                sa</a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <h1 class="text-xl font-bold">Pridať / Upraviť produkt</h1>
            <a href="{{ route('admin.products') }}" class="text-sm font-bold text-gray-400 hover:text-primary transition-colors">←
                Späť na zoznam</a>
        </header>

        <div class="p-8 max-w-5xl">
            <form class="bg-white border border-gray-200 rounded-xl shadow-sm p-8 space-y-8">
                <div>
                    <h2 class="text-lg font-bold border-b pb-2 mb-4">Základné informácie</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Názov produktu</label>
                            <input type="text"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Cena (€)</label>
                            <input type="number" step="0.01"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Skladom (ks)</label>
                            <input type="number"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold mb-2 text-gray-700">Opis produktu</label>
                            <textarea rows="4"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"></textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-bold border-b pb-2 mb-4">Kategorizácia a Parametre</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold mb-2">Hlavná kategória</label>
                            <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white">
                                <option>Osobné autá</option>
                                <option>Nákladné autá</option>
                                <option>Moto</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Podkategória</label>
                            <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white">
                                <option>Pneumatiky</option>
                                <option>Disky</option>
                                <option>Príslušenstvo</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">Sezónnosť</label>
                            <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white">
                                <option>Letné</option>
                                <option>Zimné</option>
                                <option>Celoročné</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Šírka (mm)</label>
                            <select
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                <option>135</option>
                                <option>145</option>
                                <option>155</option>
                                <option>165</option>
                                <option>175</option>
                                <option>185</option>
                                <option selected>195</option>
                                <option>205</option>
                                <option>215</option>
                                <option>225</option>
                                <option>235</option>
                                <option>245</option>
                                <option>255</option>
                                <option>265</option>
                                <option>275</option>
                                <option>285</option>
                                <option>295</option>
                                <option>305</option>
                                <option>315</option>
                                <option>325</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Profil (%)</label>
                            <select
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                <option>25</option>
                                <option>30</option>
                                <option>35</option>
                                <option>40</option>
                                <option>45</option>
                                <option>50</option>
                                <option selected>55</option>
                                <option>60</option>
                                <option>65</option>
                                <option>70</option>
                                <option>75</option>
                                <option>80</option>
                                <option>85</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 text-gray-700">Priemer (")</label>
                            <select
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                                <option>R12</option>
                                <option>R13</option>
                                <option>R14</option>
                                <option selected>R15</option>
                                <option>R16</option>
                                <option>R17</option>
                                <option>R18</option>
                                <option>R19</option>
                                <option>R20</option>
                                <option>R21</option>
                                <option>R22</option>
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="w-5 h-5 accent-primary rounded">
                                <span class="font-bold">Pneumatika s hrotmi</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-bold border-b pb-2 mb-4">Fotografie (min. 2)</h2>
                    <input type="file" multiple
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-gray-300 rounded-lg p-2 cursor-pointer">
                </div>

                <div class="pt-6 border-t flex justify-end gap-4">
                    <a href="{{ route('admin.products') }}"
                        class="px-6 py-3 text-gray-500 font-bold hover:bg-gray-100 rounded-lg transition-colors">Zrušiť</a>
                    <button type="submit"
                        class="bg-primary hover:bg-primary-dark text-white font-bold px-10 py-3 rounded-lg shadow-lg shadow-primary/20 hover:shadow-primary/40 -translate-y-0 hover:-translate-y-0.5 transition-all duration-200">
                        Uložiť produkt
                    </button>
                </div>
            </form>
        </div>
    </main>
@endpush
