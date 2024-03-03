<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CommentPhoto;
use Illuminate\Support\Facades\Auth;

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

    public function updateComment(Request $request, $comment_id)
    {
        $comment = CommentPhoto::find($comment_id);

        if (Auth::user()->id != $comment->user_id) {
            Alert::error('Anda tidak memiliki akses!');
            return redirect()->back();
        }

        $comment->isi_komentar = $request->isi_komentar;
        $comment->update();

        Alert::success('Komentar berhasil diupdate!');
        return redirect()->back();
    }

    public function deleteComment($comment_id)
    {
        $comment = CommentPhoto::find($comment_id)->first();

        if(Auth::user()->id != $comment->user_id) {
            Alert::error('Anda tidak memiliki akses!');
            return redirect()->back();
        }

        $comment->delete();
        Alert::success('Komentar berhasil dihapus!');
        return redirect()->back();
    }
}
