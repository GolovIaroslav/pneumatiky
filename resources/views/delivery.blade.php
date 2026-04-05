@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-6 py-10 min-h-[60vh]">

		<div class="flex flex-wrap items-center justify-center gap-4 mb-10 text-center text-lg">
			<a href="{{ route('cart') }}">
				<span class="text-gray-400">Košík</span>
			</a>
			<span class="text-gray-400 font-bold">&#8594;</span>
			<a href="{{ route('transport') }}">
				<span class="text-gray-400">Doprava a spôsob platby</span>
			</a>
			<span class="text-gray-400 font-bold">&#8594;</span>
			<span class="text-gray-900 font-bold">Dodacie údaje</span>
			<span class="text-gray-400 font-bold">&#8594;</span>
      		<span class="text-gray-400">Súhrn objednávky</span>
		</div>

		<div class="max-w-3xl mx-auto">
			<h1 class="text-2xl font-bold mb-8 text-left">Dodacie údaje</h1>

			<form action="#" method="post" class="space-y-8">
				<section>
					<h2 class="text-lg font-semibold text-left mb-4">Osobné údaje</h2>
					<div class="space-y-4">
						<div>
							<label for="meno" class="block text-left text-sm font-medium text-gray-700 mb-2">Meno</label>
							<input type="text" id="meno" name="meno" class="w-full md:w-64 border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
						</div>
						<div>
							<label for="priezvisko" class="block text-left text-sm font-medium text-gray-700 mb-2">Priezvisko</label>
							<input type="text" id="priezvisko" name="priezvisko" class="w-full md:w-64 border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
						</div>
						<div>
							<label for="email" class="block text-left text-sm font-medium text-gray-700 mb-2">E-mail</label>
							<input type="email" id="email" name="email" class="w-full md:w-96 border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
						</div>
						<div>
							<label for="telefon" class="block text-left text-sm font-medium text-gray-700 mb-2">Telefón</label>
							<input type="tel" id="telefon" name="telefon" class="w-full md:w-64 border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
						</div>
					</div>
				</section>

				<section>
					<h2 class="text-lg font-semibold text-left mb-4">Adresné údaje</h2>
					<div class="space-y-4">
						<div>
							<label for="ulica" class="block text-left text-sm font-medium text-gray-700 mb-2">Ulica a číslo</label>
							<input type="text" id="ulica" name="ulica" class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
						</div>
						<div>
							<label for="mesto" class="block text-left text-sm font-medium text-gray-700 mb-2">Mesto</label>
							<input type="text" id="mesto" name="mesto" class="w-full md:w-96 border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
						</div>
						<div>
							<label for="psc" class="block text-left text-sm font-medium text-gray-700 mb-2">PSČ</label>
							<input type="text" id="psc" name="psc" class="w-full md:w-32 border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary" />
						</div>
					</div>
				</section>

				<section>
					<h2 class="text-lg font-semibold text-left mb-4">Poznámka pre odosielateľa</h2>
					<div>
						<label for="poznamka" class="block text-left text-sm font-medium text-gray-700 mb-2">Poznámka</label>
						<textarea id="poznamka" name="poznamka" rows="5" class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary"></textarea>
					</div>
				</section>

				<div class="pt-2 flex items-center justify-between gap-4">
					<a href="{{ route('transport') }}" class="px-8 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-full transition-colors">Späť</a>
					<a href="{{ route('summary') }}" class="px-8 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-full transition-colors">Pokračovať na súhrn</a>
				</div>
			</form>
		</div>

	</main>
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
