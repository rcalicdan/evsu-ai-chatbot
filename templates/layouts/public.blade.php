<!DOCTYPE html>
<html lang="en" class="bg-slate-50 scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EVSU Virtual Campus Companion')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        evsu: {
                            maroon: '#800000',
                            maroonlight: '#9e1b1b',
                            maroonglow: '#b91c1c',
                            gold: '#fbbf24',
                            goldlight: '#fef08a',
                            golddark: '#d97706'
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex flex-col min-h-screen text-slate-800 antialiased selection:bg-evsu-gold selection:text-slate-900">
    
    @include('partials.public-navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.public-footer')

</body>
</html>