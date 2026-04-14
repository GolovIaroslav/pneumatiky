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
    #mob-menu { display: none; }
    #mob-menu.open { display: block; }

    /* Hide number input spinners (arrows) */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>
<body class="font-sans bg-white text-gray-900 text-sm">

    @include('partials.header')

    @yield('content')

    @include('partials.footer')
    
    <script>
      function toggleHeaderLoginMenu(button) {
        const menu = button.nextElementSibling;
        if (!menu) return;
        menu.classList.toggle('hidden');
      }

      document.addEventListener('click', function (event) {
        // Clear login menu
        document.querySelectorAll('.header-login-menu').forEach(function (menu) {
          const toggle = menu.previousElementSibling;
          if (!menu.contains(event.target) && (!toggle || !toggle.contains(event.target))) {
            menu.classList.add('hidden');
          }
        });

        // Password visibility toggle
        const toggleBtn = event.target.closest('.password-toggle');
        if (toggleBtn) {
          const input = toggleBtn.previousElementSibling;
          if (input && (input.tagName === 'INPUT')) {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
          }
        }
      });
    </script>

    @stack('scripts')
</body>
</html>
