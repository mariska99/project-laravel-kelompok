<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function data()
    {
        $produks = Produk::query();

        return DataTables::of($produks)
            ->addIndexColumn()
            ->addColumn('harga_tiket', function ($row) {
                return 'Rp ' . number_format($row->harga_tiket, 0, ',', '.');
            })
            ->addColumn('jam_buka', function ($row) {
                return \Carbon\Carbon::parse($row->jam_buka)->format('H:i');
            })
            ->addColumn('jam_tutup', function ($row) {
                return \Carbon\Carbon::parse($row->jam_tutup)->format('H:i');
            })
            ->addColumn('gambar', function ($row) {
                return $row->gambar
                    ? '<img src="' . asset('storage/' . $row->gambar) . '" height="80">'
                    : 'Tidak ada';
            })
            ->addColumn('aksi', function ($row) {
                return '
                <a href="' . route('produk.edit', $row->id) . '" class="btn btn-sm btn-warning">Edit</a>
                <form action="' . route('produk.destroy', $row->id) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Hapus?\')">Hapus</button>
                </form>
            ';
            })
            ->rawColumns(['gambar', 'aksi']) // agar gambar dan tombol tidak di-escape
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('produk.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lokasi' => 'required',
            'description' => 'required',
            'harga_tiket' => 'required|integer',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('produk', 'public'); // simpan ke storage/app/public/produk
            $data['gambar'] = $gambar;
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses hanya untuk admin.');
        }
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'lokasi' => 'required',
            'description' => 'required',
            'harga_tiket' => 'required|integer',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        $data = $request->only(['name', 'lokasi', 'description', 'harga_tiket', 'jam_buka', 'jam_tutup', 'status']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            // Upload gambar baru
            $path = $request->file('gambar')->store('produk', 'public');
            $data['gambar'] = $path;
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus gambar jika ada
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        // Hapus produk dari database
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
