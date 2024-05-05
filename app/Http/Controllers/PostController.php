<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//やりとりするモデルを宣言する
use App\Models\Post;

class PostController extends Controller
{
    //一覧ページ
    public function index(){
        $posts = Post::latest()->get();
        return view('posts.index',compact('posts'));
    }

    //作成ページ
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);
        $post = new Post();//Postモデルをインスタンス化して新しいデータを取得する
        $post->title = $request->input('title');//フォームから送信された入力内容を各カラムに代入する
        $post->content = $request->input('content');
        $post->save();//postsデーブルにデータを保存する
        return redirect()->route('posts.index')->with('flash_message','投稿が完了しました。');
        //投稿一覧ページにリダイレクト、フラッシュメッセージの内容を送信する
        //フラッシュメッセージ：処理結果をユーザーに伝えるもの
        //ビュー内で{{ session('flash_message') }}と記述すれば、
        // flash_messageというキーの値（例「投稿が完了しました。」）を表示できる
    }
    //詳細ページ
    public function show(Post $post){
        return view('posts.show',compact('post'));
    }
    //更新ページ
    public function edit(Post $post){
        return view('posts.edit',compact('post'));
    }
    //更新機能
    public function update(Request $request, Post $post){
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);
        $post->title= $request->input('title');
        $post->content=$request->input('content');
        $post->save();
        return redirect()->route('posts.show',$post)->with('flash_message','投稿を編集しました');
    }

    //削除機能
    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index')->with('flash_message','投稿を削除しました');
    }

}
