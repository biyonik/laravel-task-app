<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        .btn {
            @apply text-slate-500 rounded-md my-3 px-2 py-1 text-center font-medium shadow-md ring-1 ring-slate-700/10 hover:shadow-lg hover:bg-slate-50;
        }

        .link {
            @apply font-medium text-gray-700 underline decoration-pink-500;
        }

        label {
            @apply block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2;
        }

        input[type="text"], textarea {
            @apply shadow-sm appearance-none leading-tight block w-full bg-gray-200 text-slate-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white;
        }

    </style>
    {{-- blade-formatter-enable --}}
    <title>@yield('title')</title>
    @yield('styles')
</head>
<body class="container mx-auto mt-10 mb-10 max-w-6xl">
<h1 class="text-4xl text-teal-600 font-bold mb-4">@yield('title')</h1>
<div x-data="{flash: true}">
    @if (session('success'))
        <div x-show="flash"
             class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
             role="alert">
            <strong class="font-bold">Success!</strong>
            <div>
                {{session('success')}}
            </div>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute top-0 right-0 mr-4 mt-4 cursor-pointer"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" @click="flash = false">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </span>
        </div>
    @endif
    @yield('content')
</div>
</body>
</html>
