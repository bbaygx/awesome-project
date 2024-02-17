<?php

namespace App\Http\Controllers\UserPost;

use App\Http\Controllers\Controller;
use App\Models\UserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserPostStoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Validasi request
        $this->validateRequest($request);

        // Simpan lampiran
        $lampiranPath = $this->storeLampiran($request);

        // Ambil user ID
        $user_id = $this->getUserId();

        // Parsing tanggal kejadian
        $tanggal_kejadian = $this->parseTanggalKejadian($request->tanggal_kejadian);

        // Buat laporan pengguna
        $this->createUserPost($request, $lampiranPath, $user_id, $tanggal_kejadian);

        // Redirect kembali
        return redirect()->back();
    }

    // Validasi request
    private function validateRequest(Request $request)
    {
        $request->validate([
            'lampiran' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Tentukan aturan validasi untuk file gambar
            // Tambahkan aturan validasi untuk input lainnya
        ]);
    }

    // Simpan lampiran
    private function storeLampiran(Request $request)
    {
        if ($request->hasFile('lampiran') && $request->file('lampiran')->isValid()) {
            // Simpan file ke storage dengan nama asli
            return $request->file('lampiran')->storeAs('public/lampiran', $request->file('lampiran')->getClientOriginalName());
        }

        return null;
    }
    // Ambil user ID
    private function getUserId()
    {
        // Gunakan Auth facade untuk mendapatkan user ID jika sudah login
        return Auth::id();
    }

    // Parsing tanggal kejadian
    private function parseTanggalKejadian($tanggal_kejadian)
    {
        // Tidak perlu lagi melakukan parsing karena sudah berupa datetime dari form
        return date('Y-m-d H:i:s', strtotime($tanggal_kejadian));
    }

    // Buat laporan pengguna
    private function createUserPost(Request $request, $lampiranPath, $user_id, $tanggal_kejadian)
    {
        // Buat instance UserPost dan simpan ke database
        UserPost::create([
            'user_id' => $user_id,
            'judul_laporan' => $request->judul_laporan,
            'isi_laporan' => $request->isi_laporan,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'kategori_laporan' => $request->kategori_laporan,
            'tanggal_kejadian' => $tanggal_kejadian,
            'lampiran' => $lampiranPath
        ]);
    }


    public function showDataLapor()
    {
        $laporan = UserPost::all();

        return view('lapor.index', ['laporan' => $laporan]);
    }

    public function show($filename)
    {
        $file = Storage::disk('public')->get('lampiran/' . $filename);
        return response($file, 200)->header('Content-Type', 'image/jpeg');
    }
}
