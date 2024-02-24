<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        $photos = Photo::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('pages.profile', compact('photos', 'user'));
    }

    public function people($user_id) {
        if(!User::find($user_id)) {
            return redirect()->route('home');
        }
        $user = User::find($user_id)->select('id', 'nama', 'avatar', 'created_at')->first();
        $photos = Photo::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return view('pages.profile', compact('photos', 'user'));
    }
}
