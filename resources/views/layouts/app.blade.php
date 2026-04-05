<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PneuShop – Pneumatiky pre každé auto</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#646cfe',
            'primary-dark': '#4A4ECC',
          },
          fontFamily: { sans: ['Inter', 'sans-serif'] }
        }
      }
    }
  </script>
  <style>
    .img-ph {
      background: #e5e7eb;
      position: relative;
      overflow: hidden;
    }
    .img-ph::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        linear-gradient(to bottom right, transparent calc(50% - 0.5px), #9ca3af calc(50% - 0.5px), #9ca3af calc(50% + 0.5px), transparent calc(50% + 0.5px)),
        linear-gradient(to top right, transparent calc(50% - 0.5px), #9ca3af calc(50% - 0.5px), #9ca3af calc(50% + 0.5px), transparent calc(50% + 0.5px));
    }
    #mob-menu { display: none; }
    #mob-menu.open { display: block; }
  </style>
</head>
<body class="font-sans bg-white text-gray-900 text-sm">

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
