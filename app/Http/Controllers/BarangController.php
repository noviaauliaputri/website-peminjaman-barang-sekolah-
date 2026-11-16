<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Tampilan Kelola Barang untuk Admin
    public function index()
    {
        $barangs = Barang::latest()->get();
        return view('admin.barang', compact('barangs'));
    }

    // Simpan Barang Baru dari Admin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'stok_total'  => 'required|numeric|min:1',
        ]);

        $validated['dipinjam'] = 0;

        Barang::create($validated);

        return redirect()->route('admin.barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Update / Edit Barang dari Admin
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'stok_total'  => 'required|numeric|min:' . $barang->dipinjam,
        ]);

        $barang->update($validated);

        return redirect()->route('admin.barang')->with('success', 'Data barang berhasil diperbarui!');
    }

    // Hapus Barang dari Admin
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('admin.barang')->with('success', 'Barang berhasil dihapus!');
    }
}