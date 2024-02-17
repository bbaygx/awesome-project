<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardStoreController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function showDashboard()
    {
        $laporan = UserPost::all();

        return view('dashboard.index', ['laporan' => $laporan]);
    }

    public function deletePost($id)
    {
        $post = UserPost::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully');
    }

    /**
     * Show the edit form for a user post.
     */
    public function showEditForm($id)
    {
        $post = UserPost::findOrFail($id);

        return view('dashboard.edit', ['post' => $post]);
    }

    /**
     * Update a user post.
     */
    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'judul_laporan' => 'required',
            'isi_laporan' => 'required',
            'kategori_laporan' => 'required',
            'tanggal_kejadian' => 'required|date',
            'lampiran' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = UserPost::findOrFail($id);
        $post->judul_laporan = $request->judul_laporan;
        $post->isi_laporan = $request->isi_laporan;
        $post->kategori_laporan = $request->kategori_laporan;
        $post->tanggal_kejadian = Carbon::createFromFormat('d/m/Y', $request->tanggal_kejadian)->format('Y-m-d');

        // Handling file upload for lampiran field
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('public/lampiran');
            $post->lampiran = $lampiranPath;
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post updated successfully');
    }
}
