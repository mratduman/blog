@extends('back.layouts.master')
@section('title',$article->title)
@section('content')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{ route('admin.articles.update',$article->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label for="">Başlığı</label>
          <input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Kategori</label>
          <select class="form-control" name="category" id="category" required>
            <option value="{{ $article->category }}" selected>{{ $category->name }}</option>
            @foreach ($categories as $c)
              <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="">Resim</label><br>
          <img src="{{ asset($article->image) }}" width="300" class="rounded"><br>
          <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Metin</label>
          <textarea name="content" id="editor" class="form-control" rows="15">{{ $article->content }}</textarea>
        </div>
        <div class="form-group">
          <label for="">Durum</label>
          <select class="form-control" name="active" id="active" required>
            <option value="{{ $article->active }}" selected>
              <?php
                $status = str_replace("0","Pasif",$article->active);
                $status = str_replace("1","Aktif",$status);
                echo "$status";
              ?>
            </option>
            <option value="1">Aktif</option>
            <option value="0">Pasif</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block" name="button">Güncelle</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@section('css')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#editor").summernote({
        'height':300
      });
    });
  </script>
@endsection
