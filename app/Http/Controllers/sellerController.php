<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sellerController extends Controller
{
    // Menampilkan semua kategori untuk halaman admin
    public function adminkategori()
    {
        // Mengambil semua data kategori dari database
        $data['kategori'] = kategori::all();
        return view('admin.usaha.index')->with($data);
    }

    // Menambahkan kategori baru
    public function addkategori(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        // Menyimpan data kategori ke database
        kategori::create($validatedData);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan pesanan dan proses berdasarkan status
    public function index()
    {
        // Mengambil data pesanan dengan status tertentu yang sesuai dengan produk milik seller saat ini
        $data['pesanan'] = pesanan::where('status', 'COD')->orWhere('status', 'payment')
            ->with('cart')
            ->whereHas('cart.produk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Mengambil data proses dengan status tertentu
        $data['proses'] = pesanan::where('status', 'COD1')->orWhere('status', 'payment1')
            ->with('cart')
            ->whereHas('cart.produk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Mengambil data history
        $data['history'] = pesanan::where('status', 'selesai')->orWhere('status', 'refaund')
            ->with('cart')
            ->whereHas('cart.produk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Menggabungkan data pesanan dan proses
        $data['modals'] = $data['pesanan']->concat($data['proses']);

        // Mengirim data ke view seller.home.index
        return view('seller.home.index', $data);
    }

    // Halaman keuangan seller
    public function keuangan()
    {
        $data['pesanan'] = pesanan::where('status', 'selesai')->with('cart')->whereHas('cart.produk', function ($query) {
            $query->where('user_id', Auth::user()->id);
        });

        // Data penjualan selama 1 tahun
        $data['datapenjualan'] = [];
        for ($i = 1; $i <= 12; $i++) {
            $data['datapenjualan'][] = Pesanan::where('status', 'selesai')
                ->whereHas('cart.produk', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->count();
        }
        return view('seller.keuangan.index')->with($data);
    }

    // Menampilkan profil seller berdasarkan ID
    public function profile($id)
    {
        // Mengambil data user beserta relasi seller berdasarkan ID
        $data['user'] = User::with('seller')->find($id);
        $data['id'] = $id;

        // Mengirim data ke view seller.profile.index
        return view('seller.profile.index', $data);
    }

    // Menampilkan halaman produk dengan semua kategori
    public function produk()
    {
        // Mengambil semua kategori
        $data['kategori'] = kategori::all();

        // Mengirim data ke view seller.produk.index
        return view('seller.produk.index')->with($data);
    }

    // Mengubah judul seller
    public function title(Request $request)
    {
        // Mengambil data user beserta relasi seller
        $user = User::where('id', Auth::user()->id)->with('seller')->first();

        // Memperbarui judul seller
        $user->seller->update([
            'title' => $request->title
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah judul');
    }

    // Mengubah atau menghapus background seller
    public function updatebg(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->with('seller')->first();

        // Jika tidak ada file, hapus background lama
        if ($request->file('pinPict') == null) {
            if ($user->seller->pinPict != null) {
                unlink(public_path('file/seller/' . $user->seller->pinPict));
            }
            $user->seller->update(['pinPict' => null]);

            return redirect()->back()->with('success', 'Background berhasil dihapus');
        }

        // Hapus background lama jika ada
        if ($user->seller->pinPict != null) {
            unlink(public_path('file/seller/' . $user->seller->pinPict));
        }

        // Simpan file baru
        $fileName = time() . rand(1, 100) . '.' . $request->file('pinPict')->getClientOriginalExtension();
        $request->file('pinPict')->move(public_path('file/seller'), $fileName);

        // Perbarui background di database
        $user->seller->update(['pinPict' => $fileName]);

        return redirect()->back()->with('success', 'Berhasil memasangkan background');
    }

    // Mengubah atau menghapus sampul seller
    public function updatesampul(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->with('seller')->first();

        // Jika tidak ada file, hapus sampul lama
        if ($request->file('sampul') == null) {
            if ($user->seller->sampul != null) {
                unlink(public_path('file/seller/' . $user->seller->sampul));
            }
            $user->seller->update(['sampul' => null]);

            return redirect()->back()->with('success', 'Background berhasil dihapus');
        }

        // Hapus sampul lama jika ada
        if ($user->seller->sampul != null) {
            unlink(public_path('file/seller/' . $user->seller->sampul));
        }

        // Simpan file baru
        $fileName = time() . rand(1, 100) . '.' . $request->file('sampul')->getClientOriginalExtension();
        $request->file('sampul')->move(public_path('file/seller'), $fileName);

        // Perbarui sampul di database
        $user->seller->update(['sampul' => $fileName]);

        return redirect()->back()->with('success', 'Berhasil memasangkan background');
    }

    // Memproses pesanan berdasarkan ID
    public function proses($id)
    {
        $produk = pesanan::where('id', $id)->first();

        // Jika status mengandung '1', ubah menjadi '2' (selesai)
        if (strpos($produk->status, '1') !== false) {
            $produk->update([
                'status' => str_replace('1', '2', $produk->status),
            ]);
            return redirect()->back()->with('success', 'Produk berhasil terkonfirmasi selesai');
        } else {
            // Tambahkan '1' ke status (proses)
            $produk->update([
                'status' => $produk->status . '1',
            ]);
            return redirect()->back()->with('success', 'Produk berhasil di proses');
        }
    }
}
