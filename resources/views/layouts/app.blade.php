<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ?? setting('restaurant_name', 'Restaurant Reservation') }}</title>
    
    <meta name="description" content="{{ $description ?? setting('site_description', 'Reservasi meja restoran Anda dengan mudah dan cepat') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-body antialiased bg-ivory text-bark-900">
    
    <!-- Navbar -->
    @include('partials.navbar')
    
    <!-- Page Content -->
    <main class="min-h-screen">
        @if(isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Toast Notifications -->
    @include('partials.toast')
    
    <!-- Livewire Scripts -->
    @livewireScripts
    
    <!-- Additional Scripts -->
    @stack('scripts')
    
    <!-- Toast Manager Script -->
    <script>
        function toastManager() {
            return {
                toasts: [],
                nextId: 1,
                
                addToast(detail) {
                    const toast = {
                        id: this.nextId++,
                        message: detail.message,
                        type: detail.type || 'info',
                        show: true
                    };
                    
                    this.toasts.push(toast);
                    setTimeout(() => this.removeToast(toast.id), 5000);
                },
                
                removeToast(id) {
                    const index = this.toasts.findIndex(t => t.id === id);
                    if (index > -1) {
                        this.toasts[index].show = false;
                        setTimeout(() => this.toasts.splice(index, 1), 300);
                    }
                }
            }
        }
        
        // Show flash messages as toast
        @if(session('success'))
            window.dispatchEvent(new CustomEvent('alert', {
                detail: { message: '{{ session('success') }}', type: 'success' }
            }));
        @endif
        
        @if(session('error'))
            window.dispatchEvent(new CustomEvent('alert', {
                detail: { message: '{{ session('error') }}', type: 'error' }
            }));
        @endif
    </script>
</body>
</html>
