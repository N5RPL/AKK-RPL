<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CommentPhoto;

class CommentController extends Controller
{
    public function post(Request $request) {
        $request->validate([
            'photo_id' => ['required', 'exists:photos,id'],
            'isi_komentar' => ['required', 'min:3']
        ]);

        $comment = CommentPhoto::create([
            'user_id' => auth()->user()->id,
            'photo_id' => $request->photo_id,
            'isi_komentar' => $request->isi_komentar,
        ]);

        if($comment) {
            Alert::success('Komentar berhasil di-posting!');
            return redirect()->back();
        } else {
            Alert::error('Komentar gagal di-posting!');
            return redirect()->back();
        }
    }

}
