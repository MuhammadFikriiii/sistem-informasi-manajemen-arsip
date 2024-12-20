@extends('layouts.app')

@section('content')
    @include('layouts.sidebar')
    <div class="">
        <div class="bg-blue-600 py-14">
            <div class="flex items-center">
                <span class="material-icons text-4xl text-white"></span>
                <div class="absolute right-8 flex items-center gap-4">
                    <h2 class="text-4xl font-bold ml-3 text-white ">Admin |</h2>
                    <div class="bg-black rounded-full h-14 w-14"></div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="text-center text-2xl font-bold sm:text-3xl mb-6 mt-14 flex mx-auto justify-center gap-x-3 text-blue-600">
            <i class="fas fa-book text-4xl text-blue-600 "></i>
            <h1>Edit Peminjaman</h1>
        </div>
        <hr class="border-2 border-gray-500 w-[600px] mx-auto">


        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" class=" p-10 ">
            @csrf
            @method('PUT')
            <main class="p-10 ">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <div class="mb-3">
                        <label for="arsip_id" class="form-label">Pilih Arsip</label>
                        <select name="arsip_id" id="arsip_id"
                            class="form-select w-full p-3 rounded-lg border-gray-500 border" onchange="updateFileInfo()">
                            <option value="">Pilih Arsip</option>
                            @foreach ($arsips as $arsip)
                                <option value="{{ $arsip->id }}" data-file="{{ $arsip->file }}"
                                    {{ $peminjaman->arsip_id == $arsip->id ? 'selected' : '' }}>
                                    {{ $arsip->nama_usaha }} - NPWP: {{ $arsip->npwp }}, Kategori:
                                    {{ $arsip->kategori->nama_kategori }}, bulan: {{ $arsip->bulan }}, tahun:
                                    {{ $arsip->tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                        <input type="text" class="form-control w-full p-3 rounded-lg border-gray-500 border"
                            id="nama_peminjam" name="nama_peminjam"
                            value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="keperluan" class="form-label">Keperluan</label>
                        <textarea class="form-control w-full px-3 pt-3z rounded-lg border-gray-500 border" id="keperluan" name="keperluan"
                            rows="3" required>{{ old('keperluan', $peminjaman->keperluan) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tgl_minjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control w-full p-3 rounded-lg border-gray-500 border"
                            id="tgl_minjam" name="tgl_minjam" value="{{ old('tgl_minjam', $peminjaman->tgl_minjam) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control w-full p-3 rounded-lg border-gray-500 border"
                            id="tgl_kembali" name="tgl_kembali" value="{{ old('tgl_kembali', $peminjaman->tgl_kembali) }}">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status"
                            class="form-select w-full p-3 rounded-lg border-gray-500 border" required>
                            <option value="Dipinjam" {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam
                            </option>
                            <option value="Dikembalikan" {{ $peminjaman->status == 'Dikembalikan' ? 'selected' : '' }}>
                                Dikembalikan</option>
                            <option value="Terlambat" {{ $peminjaman->status == 'Terlambat' ? 'selected' : '' }}>Terlambat
                            </option>
                        </select>
                    </div>



                </div>
                <div class="mt-12">
                    <button type="submit"
                        class="btn btn-primary bg-green-500 px-8 py-3 rounded-lg text-white text-xl hover:bg-green-600 font-bold transform transition-transform duration-300 hover:scale-110">Simpan</button>
                    <button
                        class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary ">Kembali</a> </button>
                </div>
            </main>
        </form>
    </div>
@endsection
