<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
              @auth
                <p class="text-center text-5xl bg-gray-100 pt-5">{{Auth::user()->name}}</p>
              @endauth
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script type="text/javascript">
          window.CSRF_TOKEN = '{{ csrf_token() }}';
          @auth
          @isset($tasks)
            window.Tasks = {!!json_encode($tasks, true)!!};
          @endisset
          @isset($property)
            window.Property = {!!json_encode($property, true)!!};
          @endisset
             window.UserId = {!! json_encode(Auth::user(), true) !!};
          @else
             window.UserId =[];
          @endauth
    </body>
</html>
