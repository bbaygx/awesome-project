<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div>
        @include('layouts.navbar')


        <div class="max-w-7xl flex w-full items-center justify-between p-6 lg:p-8">
            <div class="flex max-w-xl flex-col ">
                <h1 class="text-3xl font-bold py-4">
                    Hai, Selamat Datang di Layanan Pengaduan Sekolah! <br></h1>
                <span class="text-base">Laporkan masalah atau saran dengan percaya diri. Bersama-sama, kita bisa membuat
                    sekolah menjadi tempat yang lebih baik untuk semua!</span>

                <div class="flex gap-5 py-4 font-bold">

                    <button class="btn btn-primary">
                        <a href="{{ url('lapor') }}">Buat Laporan</a>
                    </button>
                    <button class=" dark:text-white flex items-center gap-2">Pelajari lebih lanjut
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="w-[26rem] hidden md:block">
                <img src="{{ asset('assets/lapor.jpg') }}" class="object-cover w-full h-full" alt="Lapor!">
            </div>
        </div>
    </div>
</body>

</html>
