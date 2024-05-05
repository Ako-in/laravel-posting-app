@extends('layouts.app')
@section('title','投稿編集')
@section('content')
  @if($errors -> any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif   

    <div class="mb-2">
      <a href="{{ route('posts.index') }}" class="text-decoration-none">&lt; 戻る</a>                                  
    </div>

    <form action="{{ route('posts.update', $post) }}" method="post">
      @csrf
      @method('patch')
      {{-- HTMLのフォームはGETとPOST以外のHTTPリクエストメソッドをサポートしていないため、formタグのmethod属性にputやpatch、deleteを指定することができません。 --}}
      {{-- formタグ内で@method('patch')のように記述することで、GETとPOST以外のHTTPリクエストメソッドが使えるようになります。 --}}
      <div class="form-group mb-3">
          <label for="title">タイトル</label>
          <input type="text" class="form-control"name="title" value="{{ old('title',$post->title)}}">
      </div>
      <div class="form-group mb-3">
          <label for="content">本文</label>
          <textarea class="form-control" name="content">{{ old('content',$post->content)}}</textarea>
      </div>
      <button class="btn btn-outline-primary"type="submit">更新</button>
    </form>
@endsection

