<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Learner Progress')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="hidden md:flex flex-col w-64 bg-gray-900 text-white">
            <div class="px-6 py-8">
                <h1 class="text-2xl font-bold">School System</h1>
            </div>
            
            <nav class="flex-1 px-6 py-8 space-y-4">
                <a href="{{ route('welcome') }}" class="block px-4 py-3 rounded-lg transition {{ Route::currentRouteName() === 'welcome' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l4-4m0 0l4 4m-4-4V5"></path>
                        </svg>
                        Home
                    </span>
                </a>
                <a href="{{ route('learner-progress.index') }}" class="block px-4 py-3 rounded-lg transition {{ Route::currentRouteName() === 'learner-progress.index' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Learner Progress
                    </span>
                </a>
            </nav>
            
            <div class="px-6 py-4 border-t border-gray-700">
                <p class="text-xs text-gray-400">© 2026 Learner Progress</p>
            </div>
        </div>

        <!-- Mobile menu button and main content -->
        <div class="flex-1 flex flex-col">
            <!-- Mobile header -->
            <div class="md:hidden bg-gray-900 text-white px-4 py-4 flex items-center justify-between">
                <h1 class="text-xl font-bold">Learner Dashboard</h1>
                <button onclick="toggleMobileMenu()" class="text-gray-300 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div id="mobileMenu" class="hidden md:hidden bg-gray-800 text-white px-4 py-4 space-y-2 border-b border-gray-700">
                <a href="{{ route('welcome') }}" class="block px-4 py-3 rounded-lg transition {{ Route::currentRouteName() === 'welcome' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l4-4m0 0l4 4m-4-4V5"></path>
                        </svg>
                        Home
                    </span>
                </a>
                <a href="{{ route('learner-progress.index') }}" class="block px-4 py-3 rounded-lg transition {{ Route::currentRouteName() === 'learner-progress.index' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Learner Progress
                    </span>
                </a>
            </div>

            <!-- Main content -->
            <div class="flex-1 overflow-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                    <ul class="mt-2 list-disc list-inside space-y-1 text-sm text-red-700">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
