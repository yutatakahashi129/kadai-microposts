<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MicropostsController extends Controller
{
     public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return view('welcome');
        }
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
    
     public function destroy($id)
    {
        $micropost = \App\Micropost::find($id);

        if (\Auth::user()->id === $micropost->user_id) {
            $micropost->delete();
        }

        return redirect()->back();
    }
    
}


