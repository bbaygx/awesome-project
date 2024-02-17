<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Form</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div>
        @include('layouts.navbar')

        <div class="container px-3">
            <div class="flex justify-around">
                <div class="">
                    <div class="my-12">
                        <h1 class="text-2xl font-semibold flex gap-2 items-center">
                            <i class="fa-regular fa-file-lines"></i>
                            Edit Laporan
                        </h1>
                        <form action="{{ route('dashboard.update', $post->id) }}" method="POST"
                            class="form-lapor flex gap-5 my-4" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="">
                                <label class="form-control w-full max-w-xs" for="judul_laporan">
                                    <div class="label">
                                        <span class="label-text">Judul Laporan</span>
                                    </div>
                                    <input type="text" placeholder="Judul Laporan" name="judul_laporan"
                                        class="input input-bordered w-full max-w-xs"
                                        value="{{ $post->judul_laporan }}" />
                                </label>
                                <label class="form-control w-full max-w-xs" for="isi_laporan">
                                    <div class="label">
                                        <span class="label-text">Isi Laporan</span>
                                    </div>
                                    <textarea class="textarea textarea-bordered" placeholder="Isi laporan" name="isi_laporan">{{ $post->isi_laporan }}</textarea>

                                </label>

                                <label class="form-control w-full max-w-xs" for="lokasi_kejadian">
                                    <div class="label">
                                        <span class="label-text">Lokasi Kejadian</span>
                                    </div>
                                    <select class="select select-bordered" id="lokasiKejadian" name="lokasi_kejadian">
                                        <option disabled value="{{ $post->judul_laporan }} ">Pilih Lokasi Kejadian
                                        </option>
                                        <option>Kantin Sekolah</option>
                                        <option>Ruang Kelas</option>
                                        <option>Lapangan Sekolah</option>
                                        <option>Parkiran Sekolah</option>
                                        <option>Lab Sekolah</option>
                                        <option>Lainnya</option>
                                    </select>
                                </label>
                                <button class="btn btn-primary my-6" type="submit">Kirim Laporan
                                    <i class="fa-regular fa-paper-plane"></i>
                                </button>
                            </div>
                            <div class="">

                                <label class="form-control w-full max-w-xs" for="kategori_laporan">
                                    <div class="label">
                                        <span class="label-text">Kategori Laporan</span>
                                    </div>
                                    <select class="select select-bordered" id="kategoriLaporan" name="kategori_laporan">
                                        <option disabled value="{{ $post->judul_laporan }}">Pilih Kategori Laporan
                                        </option>
                                        <option>Laporan Prestasi Akademik</option>
                                        <option>Laporan Kehadiran</option>
                                        <option>Laporan Kedisiplinan</option>
                                        <option>Laporan Kesehatan</option>
                                        <option>Laporan Sarana dan Prasarana Sekolah</option>
                                        <option>Laporan Kegiatan Ekstrakurikuler</option>
                                        <option>Laporan Pertemuan Orang Tua dan Guru</option>
                                        <option>Laporan Evaluasi Pengajaran</option>
                                        <option>Laporan Keuangan</option>
                                        <option>Laporan Keamanan</option>
                                        <option>Laporan Pencurian</option>
                                    </select>
                                </label>
                                <label class="form-control w-full max-w-xs" for="tanggal_kejadian">
                                    <div class="label">
                                        <span class="label-text">Tanggal Kejadian</span>
                                    </div>
                                    <div class="relative max-w-sm">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input datepicker datepicker-autohide type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Select date" name="tanggal_kejadian"
                                            value="{{ $post->judul_laporan }}">
                                    </div>
                                </label>
                                <label class="form-control w-full max-w-xs" for="lampiran">
                                    <div class="label">
                                        <span class="label-text">Upload Lampiran Foto</span>
                                    </div>
                                    <input type="file" class="file-input file-input-bordered w-full max-w-xs"
                                        name="lampiran" value="{{ $post->lampiran }}" />
                                    @if ($post->lampiran)
                                        <span class="text-xs text-gray-500">File terlampir: {{ $post->lampiran }}</span>
                                    @endif

                                </label>
                            </div>


                        </form>
                    </div>
                </div>
                <div class="py-12">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</body>

</html>
