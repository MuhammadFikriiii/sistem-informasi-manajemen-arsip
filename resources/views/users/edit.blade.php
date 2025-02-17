<!-- resources/views/users/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="flex h-screen bg-white">
        @include('layouts.sidebar')

        <main class="flex-1 ">
            <div class="bg-blue-600 py-14">
                <div class="flex items-center">
                    <span class="material-icons text-4xl text-white"></span>
                    <div class="absolute right-8 flex items-center gap-4">
                        <h2 class="text-4xl font-bold ml-3 text-white ">
                            {{ Auth::user()->nama_user ?? 'User' }} |
                        </h2>
                        <div class="bg-white rounded-full h-14 w-14 overflow-hidden flex justify-center items-center"><i class="fas fa-user text-4xl text-white "></i></div>
                    </div>
                </div>
            </div>
            <div
                class="text-center text-2xl font-bold  sm:text-3xl mb-9 flex mx-auto justify-center gap-x-3 text-blue-600 mt-10">
                <i class="fas fa-user text-4xl text-blue-600 "></i>
                <h1>Edit User</h1>
            </div>
            <hr class="border-2 border-gray-500 w-[600px] mx-auto">
            <div class="p-14">
                <form action="{{ route('users.update', $user->NIP) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_user" class="block text-gray-700 font-bold mb-2">Nama:</label>
                        <input type="text" id="nama_user" name="nama_user"
                            value="{{ old('nama_user', $user->nama_user) }}" required
                            class="block w-full p-3 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 transition-colors">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
                        <input type="password" id="password" name="password"
                            class="block w-full p-3 border border-gray-500 rounded-lg focus:outline-none focus:ring focus:ring-blue-200 transition-colors"
                            placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>  
                    
                    {{-- input pilih admin or user --}}
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                        <div class="flex items-center border border-gray-500 rounded-lg px-4 text-lg">
                            {{-- admin --}}
                            <label class="flex items-center cursor-pointer w-full justify-center">
                                <input type="radio" id="role-admin" name="role" value="1" class="hidden peer" 
                                {{ $user->role == 1 ? 'checked' : '' }} />
                                <span
                                    class="text-gray-700 peer-checked:text-white peer-checked:bg-gray-500 peer-checked:rounded-lg px-3 py-2 m-1 h-10 flex items-center font-bold hover:bg-blue-100 transition rounded-lg">
                                    Admin
                                </span>
                            </label>

                            {{-- garis tengah --}}
                            <div class="border-l border-gray-500 h-10"></div>

                            {{-- user --}}
                            <label class="flex items-center cursor-pointer w-full justify-center">
                                <input type="radio" id="role-user" name="role" value="2" class="hidden peer" 
                                {{ $user->role == 2 ? 'checked' : '' }} />
                                <span
                                    class="text-gray-700 peer-checked:text-white peer-checked:bg-gray-500 peer-checked:rounded-lg px-3 py-2 m-1 h-10 flex items-center font-bold hover:bg-blue-100 transition rounded-lg">
                                    User
                                </span>
                            </label>
                        </div>                            
                    </div>

                    <div class="flex mt-12">
                        <button type="submit"
                            class="bg-green-500 px-6 py-3 rounded-lg text-white text-xl hover:bg-green-600 font-bold transform transition-transform duration-300 hover:scale-110 mr-4">Simpan</button>
                        <button
                            class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 text-center text-xl font-semibold transform transition-transform duration-300 hover:scale-110">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary ">Kembali</a> </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
