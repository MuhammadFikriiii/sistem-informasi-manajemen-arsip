@extends('layouts.app')

@section('content')
  

    <div class="flex ">

        <!--include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-10 bg-gray-100 ">

             <div class="max-w-10xl mx-50 bg-white shadow-xl rounded-lg p-20">
            <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Edit Kategori</h1>

            <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-3 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                </div>
                <button id="edit" type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">Simpan</button>
            </form>

            
        </div>
            	
           
    </div>
   
@endsection