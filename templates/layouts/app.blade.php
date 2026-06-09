<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EVSU Virtual Campus Companion')</title>

    <!-- Tailwind CSS Play CDN -->
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
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Marked.js CDN for compiling Markdown -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }

        .markdown-content p {
            margin-bottom: 0.75rem;
            line-height: 1.625;
        }

        .markdown-content p:last-child {
            margin-bottom: 0;
        }

        .markdown-content ul {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 0.75rem;
            margin-top: 0.25rem;
        }

        .markdown-content ol {
            list-style-type: decimal;
            margin-left: 1.5rem;
            margin-bottom: 0.75rem;
            margin-top: 0.25rem;
        }

        .markdown-content li {
            margin-bottom: 0.35rem;
            line-height: 1.5;
        }

        .markdown-content li::marker {
            color: #800000;
            font-weight: bold;
        }

        .markdown-content strong {
            font-weight: 700;
            color: #1e293b;
        }
    </style>
</head>

<body class="h-full overflow-hidden text-slate-800 antialiased" x-data="chatApp()" x-init="init()" x-cloak>

    <div class="flex h-full overflow-hidden">

        <!-- Mobile Sidebar Overlay Backdrop -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-sm lg:hidden"
            x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <!-- Include Sidebar Partial -->
        @include('partials.sidebar')

        <!-- Main Content Area Frame -->
        <main class="flex-1 flex flex-col h-full bg-slate-50 overflow-hidden relative">

            <!-- Include Header Partial -->
            @include('partials.header')

            <!-- Render home.blade.php content -->
            @yield('content')

        </main>
    </div>

    <!-- Include Alpine.js State Scripts Partial -->
    @include('partials.scripts')

</body>

</html>
