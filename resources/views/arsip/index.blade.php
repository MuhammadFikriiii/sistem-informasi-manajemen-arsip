@extends('layouts.app')

@section('content')
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <div class="flex ">

        <!--include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-10 bg-gray-100 ">
            <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent text-center h-20 ">Sistem Informasi Management Arsip</h2>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Data Arsip</h1>
            

            <!-- Tombol Tambah Arsip -->

            <a href="{{ route('arsip.create') }}"
                class="mb-6 inline-block px-5 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700"> <i class="fa-solid fa-plus mr-2 font-bold text-lg"></i>
            <span class="">Tambah Arsip</span></a>

            <form class="flex gap-16 lg:gap-20 " method="GET" action="{{ route('arsip.index') }}">
                {{-- cari Npwp --}}
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NPWP"
                        class=" border-2 rounded-lg mb-8 border-gray-400 py-1 text-sm pl-4">
                </div>
                {{-- Cari Bulan --}}
                <div class="">
                    <label for="bulan" class="">Bulan:</label>
                    <select name="bulan" id="bulan" class="border-2 border-gray-400 rounded-lg pl-4  py-1 ">
                        <option value="">Pilih Bulan</option>
                        <option value="Januari" {{ request('bulan') == 'Januari' ? 'selected' : '' }}>Januari</option>
                        <option value="Februari" {{ request('bulan') == 'Februari' ? 'selected' : '' }}>Februari</option>
                        <option value="Maret" {{ request('bulan') == 'Maret' ? 'selected' : '' }}>Maret</option>
                        <option value="April" {{ request('bulan') == 'April' ? 'selected' : '' }}>April</option>
                        <option value="Mei" {{ request('bulan') == 'Mei' ? 'selected' : '' }}>Mei</option>
                        <option value="Juni" {{ request('bulan') == 'Juni' ? 'selected' : '' }}>Juni</option>
                        <option value="Juli" {{ request('bulan') == 'Juli' ? 'selected' : '' }}>Juli</option>
                        <option value="Agustus" {{ request('bulan') == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                        <option value="September" {{ request('bulan') == 'September' ? 'selected' : '' }}>September
                        </option>
                        <option value="Oktober" {{ request('bulan') == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                        <option value="November" {{ request('bulan') == 'November' ? 'selected' : '' }}>November</option>
                        <option value="Desember" {{ request('bulan') == 'Desember' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>

                {{-- Cari Tahun --}}
                <div>
                    <label for="tahun">Tahun:</label>
                    <input class="border-gray-400 border-2 rounded-lg px-4 py-1" type="text" name="tahun" id="tahun"
                        value="{{ request('tahun') }}" placeholder="Ketik Tahun" maxlength="4"
                        title="Masukkan angka tahun" pattern="\d*" />
                    <button type="submit" class="bg-blue-600 px-3 h-9 rounded-lg text-white font-semibold"><span
                            class="mr-2">Cari</span> <i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                {{-- Reset --}}
                <div class="bg-red-600 px-3 py-1 rounded-lg text-white font-semibold h-9">
                    <a href="{{ route('arsip.index') }}">Reset</a>
                </div>
            </form>


            <div class="overflow-x-auto bg-white shadow-md rounded-lg ">
                <table class="min-w-full table-auto divide-y divide-gray-300">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">NPWP</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Kategori</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Nama Usaha</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Alamat Usaha</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Nama Pemilik</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Alamat Pemilik</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Tahun</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">Bulan</th>
                            <th class="px-5 py-3 text-left text-xs font text-gray-700">File</th>
                            <th class="px-5 py-3 text-center text-xs font text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($arsips as $arsip)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->npwp }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">
                                    {{ $arsip->kategori->nama_kategori ?? 'Tidak ada kategori' }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->nama_usaha }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->alamat_usaha }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->nama_pemilik }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->alamat_pemilik }}
                                </td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->tahun }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">{{ $arsip->bulan }}</td>
                                <td class="px-4 py-3 text-left text-xs font text-black-500">
                                    @if ($arsip->file_path)
                                        <div
                                            class="bg-green-500 w-16 py-3 rounded-lg font-bold  flex items-center justify-center">
                                            <a href="{{ asset('storage/' . $arsip->file_path) }}"
                                                class="text-white hover:underline" target="_blank">Lihat File</a>
                                        </div>
                                    @else
                                        <span class="text-gray-500">Tidak ada file</span>
                                    @endif
                                </td>

                                <td class=" ">
                                    <div class="flex items-center px-2   py-3 justify-center space-x-2 ">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('arsip.show', $arsip->id) }}"
                                            class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg">Detail</a>

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('arsip.edit', $arsip->id) }}"
                                            class="px-4 py-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg">Edit</a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg">Hapus</button>
                                        </form>
                                    </div>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $arsips->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
