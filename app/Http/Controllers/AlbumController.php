<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
class AlbumController extends Controller
{
    public function index($user_id) {
        if(!User::find($user_id)) {
            return redirect()->route('home');
        }

        $albums = Album::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return view('pages.album', compact('albums'));
    }

    public function data_album($album_id)
    {
        $photos = Photo::where('album_id', $album_id)->orderBy('created_at', 'desc')->get();
        return view('pages.data_album', compact('photos'));
    }

    public function create_album()
    {
        return view('pages.create_album');
    }


    public function postAlbumProcess(Request $request)
    {
        $request->validate([
            'nama_album' => ['required', 'max:255'],
            'deskripsi' => ['required', 'max:255'],
        ]);


        $create_album = Album::create([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi,
            'user_id' => Auth::user()->id
        ]);

        if($create_album) {
            Alert::success('Buat Album berhasil!');
            return redirect()->back();
        } else {
            Alert::error('Album gagal dibuat!');
            return redirect()->back();
        }

    }
    public function deleteAlbum($album_id)
    {
        $album = Album::find($album_id);

        if(Auth::user()->id != $album->user_id) {
            Alert::error('Anda tidak memiliki akses!');
            return redirect()->back();
        }

        $album->delete();
        Alert::success('Album berhasil dihapus!');
        return redirect()->back();
    }
}
