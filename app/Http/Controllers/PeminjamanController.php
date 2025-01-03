<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Arsip;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function create()
    {
        $arsips = Arsip::with('kategori')->get(); // Ambil semua arsip tanpa filter
        $arsipsGrouped = $arsips->groupBy('npwp'); // Kelompokkan berdasarkan NPWP jika perlu
        return view('peminjaman.create', compact('arsipsGrouped'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'arsip_id' => 'required|exists:arsips,id',
            'nama_peminjam' => 'required|string',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'nullable|date',
            'status' => 'required|string',
        ]);

        // Periksa apakah arsip sudah dipinjam atau terlambat dikembalikan
        $arsipDipinjam = Peminjaman::where('arsip_id', $request->arsip_id)
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->exists();

        if ($arsipDipinjam) {
            // Notifikasi arsip sudah dipinjam, tetap di halaman create
            return redirect()->back()->withErrors(['arsip_id' => 'Arsip ini sedang dipinjam atau belum dikembalikan.']);
        }

        // Simpan data peminjaman jika arsip tersedia
        $peminjaman = new Peminjaman();
        $peminjaman->arsip_id = $request->arsip_id;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->tgl_minjam = $request->tgl_minjam;
        $peminjaman->tgl_kembali = $request->tgl_kembali;
        $peminjaman->status = $request->status;

        // Ambil file arsip berdasarkan arsip_id
        $arsip = Arsip::find($request->arsip_id);
        if ($arsip) {
            $peminjaman->file_path = $arsip->file_path;
        }

        $peminjaman->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disimpan.');
    }

    // Menampilkan peminjaman aktif
    public function index()
{
    $peminjamans = Peminjaman::whereIn('status', ['Dipinjam', 'Terlambat'])->paginate(10);
    return view('peminjaman.index', compact('peminjamans'));
}

    // Menampilkan riwayat peminjaman yang sudah dikembalikan
    public function history()
{
    // Use paginate instead of get to retrieve paginated results
    $peminjamans = Peminjaman::where('status', 'Dikembalikan')->paginate(10); // Adjust the number 10 as needed
    
    return view('history.index', compact('peminjamans'));
}


    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Ambil semua arsip dan kelompokkan berdasarkan NPWP
        $arsips = Arsip::all();
        $arsipsGrouped = $arsips->groupBy('npwp'); // Mengelompokkan arsip berdasarkan NPWP

        // Kirimkan ke view
        return view('peminjaman.edit', compact('peminjaman', 'arsipsGrouped', 'arsips'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'npwp' => 'required|string', // Validasi npwp
            'arsip_id' => 'required|integer', // Validasi arsip_id
            'nama_peminjam' => 'required|string',
            'keperluan' => 'required|string',
            'tgl_minjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'status' => 'required|string',
        ]);

        // Cari data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Cari arsip berdasarkan npwp yang dipilih
        $arsip = Arsip::where('npwp', $request->npwp)->first();
        
        // Jika arsip tidak ditemukan, kembalikan error
        if (!$arsip) {
            return redirect()->back()->withErrors(['npwp' => 'NPWP tidak ditemukan dalam arsip.']);
        }

        // Perbarui data peminjaman
        $peminjaman->update([
            'arsip_id' => $request->arsip_id, // Gunakan arsip_id yang dipilih
            'nama_peminjam' => $request->nama_peminjam,
            'keperluan' => $request->keperluan,
            'tgl_minjam' => $request->tgl_minjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => $request->status,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cari data peminjaman berdasarkan id
        $peminjaman = Peminjaman::findOrFail($id);

        // Hapus data peminjaman
        $peminjaman->delete();

        // Redirect kembali ke halaman daftar peminjaman dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success_delete', 'Data peminjaman berhasil dihapus.');
    }
}