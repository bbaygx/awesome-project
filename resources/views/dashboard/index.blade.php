<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __('!') }} --}}
                </div>
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Laporan</th>
                                <th>Isi Laporan</th>
                                <th>Lokasi Laporan</th>
                                <th>Kategori Laporan</th>
                                <th>Tanggal Kejadian</th>
                                <th>Lampiran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            @foreach ($laporan as $lapor)
                                <tr>
                                    <th class="flex justify-center">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        <div class="flex items-center gap-3">

                                            <div>
                                                <div class="font-bold">{{ $lapor->judul_laporan }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>

                                        <button class="btn badge badge-info btn-xs"
                                            onclick="my_modal_{{ $loop->index }}.showModal()">Lihat</button>
                                        <br />

                                        <!-- Modal dengan ID unik sesuai dengan loop index -->
                                        <dialog id="my_modal_{{ $loop->index }}" class="modal">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-lg">Isi Laporan</h3>
                                                <p class="py-4">{{ $lapor->isi_laporan }}</p>
                                                <div class="modal-action">
                                                    <form method="dialog">
                                                        <!-- if there is a button in form, it will close the modal -->
                                                        <button class="btn">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </dialog>
                                    </td>
                                    <td>Kantin Sekolah</td>
                                    <td>Pelecehan Seksual</td>
                                    <td>2024/06/16</td>
                                    <th>
                                        <button class="btn badge badge-warning btn-xs"
                                            onclick="my_modalLampiran_{{ $loop->index }}.showModal()">Lihat</button>

                                        <!-- Modal dengan ID unik sesuai dengan loop index -->
                                        <dialog id="my_modalLampiran_{{ $loop->index }}" class="modal">
                                            <div class="modal-box rounded-md w-11/12 max-w-4xl">
                                                <h3 class="font-bold text-lg">Lampiran Gambar</h3>
                                                @if ($lapor->lampiran)
                                                    <img src="{{ route('lampiran', ['filename' => basename($lapor->lampiran)]) }}"
                                                        alt="Nama Gambar" class="py-4 rounded-lg">
                                                @endif
                                                <div class="modal-action">
                                                    <form method="dialog">
                                                        <!-- if there is a button in form, it will close the modal -->
                                                        <button class="btn">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </dialog>
                                    </th>
                                    <th>
                                        <!-- Tombol Edit -->
                                        <form action="{{ route('dashboard.edit', $lapor->id) }}" method="GET"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn badge badge-info btn-xs">Edit</button>
                                        </form>
                                        <!-- Tombol Delete -->
                                        <form action="{{ route('dashboard.delete', $lapor->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn badge badge-error btn-xs"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">Delete</button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach


                        </tbody>
                        <!-- foot -->
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Judul Laporan</th>
                                <th>Isi Laporan</th>
                                <th>Lokasi Laporan</th>
                                <th>Kategori Laporan</th>
                                <th>Tanggal Kejadian</th>
                                <th>Lampiran</th>
                                <th></th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
