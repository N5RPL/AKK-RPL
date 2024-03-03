<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Album;

class PhotoController extends Controller
{
    public function index($photo_id)
    {
        $data = Photo::with('user')
            ->with('comments')
            ->withCount('likes')
            ->withExists('likedByUser', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->find($photo_id);
            $albums = Album::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return view('pages.photo', compact('data','albums'));
    }

    public function home()
    {
        $photos = Photo::with('user')->orderBy('created_at', 'desc')->get();
        return view('pages.home', compact('photos'));
    }

    public function postPhoto()
    {
        return view('pages.post_photo');
    }

    public function postPhotoProcess(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'mimes:jpg,png,jpeg', 'max:4096'],
            'judul_foto' => ['required', 'max:255'],
            'deskripsi_foto' => ['required', 'min:3'],
        ]);

        $photo = $request->file('photo');
        $photo_path = $photo->store('photos', ['disk' => 'public']);

        if ($photo_path == null) {
            Alert::error('Foto gagal di-upload!');
            return redirect()->back();
        }
        $photo_post = Photo::create([
            ...$request->only(['judul_foto', 'deskripsi_foto']),
            'user_id' => auth()->user()->id,
            'lokasi_file' => $photo_path
        ]);
        if ($photo_post) {
            Alert::success('Foto berhasil di-upload!');
            return redirect()->route('home');
        } else {
            Alert::error('Foto gagal di-upload!');
            Storage::delete($photo_path);
            return redirect()->back();
        }
    }

    public function updatePhoto(Request $request, $photo_id)
    {
        $photo = Photo::findOrFail($photo_id);

        if (Auth::user()->id != $photo->user_id) {
            Alert::error('Anda tidak memiliki akses!');
            return redirect()->back();
        }

        $photo->judul_foto = $request->judul_foto;
        $photo->deskripsi_foto = $request->deskripsi_foto;
        $photo->album_id = $request->album_id;
        $photo->update();

        Alert::success('Foto berhasil diupdate!');
        return redirect()->back();
    }
    // fungsi untuk menghapus postingan
    public function deletePhoto($photo_id)
    {
        $photo = Photo::findOrFail($photo_id);

        if (Auth::user()->id != $photo->user_id) {
            Alert::error('Anda tidak memiliki akses!');
            return redirect()->back();
        }

        if (file_exists(public_path('storage/' . $photo->lokasi_file))) {
            unlink(public_path('storage/' . $photo->lokasi_file));
        }

        $photo->delete();
        Alert::success('Foto berhasil dihapus!');
        return redirect()->route('home');
    }
}
