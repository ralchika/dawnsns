<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class FollowsController extends Controller
{
    //

    public function followList(){
        $users = DB::table('users')
        ->join('follows', 'users.id', '=', 'follows.follow')
        ->where('follows.follower',Auth::id())
        ->select('users.id', 'users.username', 'users.images', 'users.created_at')
            ->get();
        // dd($users);
        return view('follows.followList',['users'=>$users]);
    }

    public function followerList(){
        $users = DB::table('users')
        ->join('follows', 'users.id', '=', 'follows.follower')
        ->where('follows.follow',Auth::id())
        ->select('users.id', 'users.username', 'users.images', 'users.created_at')
            ->get();
        // dd($users);
        return view('follows.followerList',['users'=>$users]);
    }
}
