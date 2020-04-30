@extends('back.layouts.master')
@section('title','Yeni Yazı')
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
      <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Başlığı</label>
          <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Kategori</label>
          <select class="form-control" name="category" id="category" required>
            <option value="" selected disabled>Kategori seçin</option>
            @foreach ($categories as $c)
              <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="">Resim</label>
          <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="">Metin</label>
          <textarea name="content" id="editor" class="form-control" rows="15"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block" name="button">Oluştur</button>
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
