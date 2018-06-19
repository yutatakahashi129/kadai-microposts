<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request, $micropostId)
    {
        \Auth::user()->favorite($micropostId);
        return redirect()->back();
    }

    public function destroy($micropostId)
    {
        \Auth::user()->unfavorite($micropostId);
        return redirect()->back();
    }
}
