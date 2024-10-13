<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen"> <!-- Kontainer utama dengan tinggi penuh -->
        <aside class="w-64 bg-gradient-to-b from-blue-500 to-blue-700 text-white p-6">
            <h2 class="text-2xl font-bold mb-8">Manajemen Arsip</h2>
            <hr>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="/arsip" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                            <span class="material-icons">archive</span>
                            <span class="ml-2">Arsip</span>
                        </a>
                    </li>
                    <li>
                        <a href="/kategori" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                            <span class="material-icons">category</span>
                            <span class="ml-2">Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="/users" class="flex items-center p-3 rounded-lg hover:bg-blue-600 transition duration-150">
                            <span class="material-icons">person</span>
                            <span class="ml-2">User</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <section class="py-4 flex-grow"> <!-- Penambahan padding untuk section -->
            <div class="max-w-10xl rounded-lg p-8">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-6">Daftar User</h2>
                        <div class="flex justify-between items-center mb-4">
                            <a href="/user/create" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">Tambah User</a>
                        </div>
                        <table class="min-w-full bg-white border-collapse">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-3 px-4 border-b border-gray-300 text-left">Nama User</th>
                                    <th class="py-3 px-4 border-b border-gray-300 text-left">Email</th>
                                    <th class="py-3 px-4 border-b border-gray-300 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="hover:bg-gray-100 transition duration-300">
                                    <td class="py-2 px-4 border-b border-gray-300">{{ $user->nama_user }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300">{{ $user->email }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300 flex space-x-2">
                                        <a href="/user/{{ $user->id_user }}/edit" class="text-blue-600 hover:text-blue-800 transition duration-300">Edit</a>
                                        |
                                        <form action="/user/{{ $user->id_user }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition duration-300">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">
                        {{ $users->links() }} <!-- Menambahkan pagination -->
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>
</html>