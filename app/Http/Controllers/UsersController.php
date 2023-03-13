<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile(){
        $user = DB::table('users')
            ->where('id', Auth::id())
            ->first();

        return view('users.profile',['user'=>$user]);
    }
    // public function upload(Request $request){

    // }

    public function search(Request $request){
        $followings = DB::table('follows')
        ->where('follower',Auth::id())
        ->get();
        if(request('search')){
            $keyword = $request->search;
            $users = DB::table('users')
            ->where('username','like',"%".$keyword."%")
            ->get();
        }else{
            $users = DB::table('users')
            ->where('id','<>',Auth::id())
            ->select('id','username')
            ->get();
            $keyword = null;
        }

        return view('users.search',['users'=>$users,'followings' => $followings,'keyword' => $keyword]);
    }

    public function addFollow(Request $request){

        $follow_id = $request->input('follow_id');

        DB::table('follows')
            ->insert([
            'follow' => $follow_id,
            'follower' => Auth::id()
        ]);
        return back();
    }

    public function deleFollow(Request $request){
        $follower_id = $request->input('follower_id');

         DB::table('follows')
            ->where([
            'follow' => $follower_id,
            'follower' => Auth::id()
        ])->delete();
        return back();
    }

    public function otherProfile($id){
        $followings = DB::table('follows')
        ->where('follower',Auth::id())
        ->get();

        $user = DB::table('users')
            ->where('id', $id)
            ->first();

        $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->where('posts.user_id',$id)
        ->select('users.images','users.username','posts.posts','posts.created_at as created_at')
        ->get();
        return view('users.otherProfile',['user'=>$user,'posts'=>$posts,'followings'=>$followings]);
    }

    public function update(Request $request){
        $data = $request->input();
        $username = $request->username;
        $mail = $request->mail;
        $bio = $request->bio;

        if(request('newPassword')){
            $validator = Validator::make($data, [
                'newPassword' => 'string|between:4,12',
                ],
                [
                'newPassword.between' => '4文字以上12文字以内で入力してください',
                ]);
            if ($validator->fails()) {
                return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }
            $newPassword = bcrypt($request->newPassword);
        }else{
            $newPassword = DB::table('users')
            ->where('id',Auth::id())
            ->value('password');
        }

        if(request('image')){
            $validator = Validator::make($data, [
            'images' => 'nullable|file|alpha_num',
            ],
            [
            'images.file' => '画像ファイルを選択してください',
            'images.alpha_num' => '英数字以外が使用されています',
            ]);
            if ($validator->fails()) {
                return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images',$image_name);
        }else{
            $image_name = DB::table('users')
            ->where('id',Auth::id())
            ->value('images');
        }

        if(request('username')){
            $validator = Validator::make($data, [
            'username' => 'required|string|between:4,12',
            ],
            [
            'username.required' => '必須項目です',
            'username.between' => '4文字以上12文字以内で入力してください',
            ]);
            if ($validator->fails()) {
                return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if(request('mail')){
            $validator = Validator::make($data, [
            'mail' => 'required|string|email|between:4,12|unique:users,mail',
            ],
            [
            'mail.email' => 'メールアドレスではありません',
            'mail.between' => '4文字以上12文字以内で入力してください',
            'mail.unique' => '既に登録されているメールアドレスです',
            ]);
            if ($validator->fails()) {
                return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }}

        if(request('bio')){
            $validator = Validator::make($data, [
            'bio' => 'nullable|string|max:200',
            ],
            [
            'bio.max' => '200文字以内で入力してください',
            ]);
            if ($validator->fails()) {
                return redirect('/profile')
                    ->withErrors($validator)
                    ->withInput();
            }}

        DB::table('users')
        ->where('id',Auth::id())
        ->update([
            'username' => $username,
            'mail' => $mail,
            'password' => $newPassword,
            'bio' => $bio,
            'images' => $image_name,
        ]);
        return back();
    }

}
