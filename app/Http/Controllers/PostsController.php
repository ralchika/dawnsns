<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class PostsController extends Controller
{
    //
    public function index(){
        // dd(Auth::user()->input('id'));
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id', 'posts.user_id', 'posts.posts', 'posts.created_at', 'users.username', 'users.images')
            ->get();
        // dd($posts);
        return view('posts.index',['posts'=>$posts]);
    }

    public function create(Request $request){
        $data = $request->input();
        $post = $request->input('newPost');
        // dd($post);
        if(request('newPost')){
            $validator = Validator::make($data, [
            'newPost' => 'required|string|max:150',
            ],
            [
            'newPost.required' => '必須項目です',
            'newPost.max' => '150文字以内で入力してください',
            ]);
            if ($validator->fails()) {
                return redirect('/top')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => Auth::id()
        ]);


        return redirect('/top');
    }

    public function delete($id){
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        // dd('hello');
        return redirect('/top');
    }

        public function update(Request $request){
            // dd('hello');
        $post = $request->input('upPost');
        $id = $request->input('id');

        // dd($id);
        DB::table('posts')
                ->where('id', $id)
                ->update(['posts' => $post]);
                return redirect('/top');
    }
}
