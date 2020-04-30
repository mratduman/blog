@extends('back.layouts.master')
@section('title','Silinen Yazılar')
<div id="indexArticles">
  @section('content')
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{ $articles->count() }}</strong> Yazı Listelendi
          <span class="float-right">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-warning">Mevcutlar</a>
          </span>
        </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Görüntü</th>
                <th>Başlık</th>
                <th>Kategori</th>
                <th>Hit</th>
                <th>Tarih</th>
                <th>İşlemler</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($articles as $article)
                <tr id="row_{{ $article->id }}">
                  <td>
                    <a href="{{ $article->image }}" target="_blank">{{ $article->id }}</a>
                  </td>
                  <td>{{ $article->title }}</td>
                  <td>{{ $article->getCategory->name }}</td>
                  <td>{{ $article->hit }}</td>
                  <td>{{ $article->created_at->diffforHumans() }}</td>
                  <td>
                    <a href="{{ route('admin.articles.edit',$article->id) }}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                    <button type="button" onclick="publish_post({{ $article->id }})" title="Yayınla" class="btn btn-sm btn-success"><i class="fa fa-history"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      function publish_post(id) {
        $.get("{{ route('admin.publish_article') }}", { id:id }, function (message) {
          if (message=="Yayinlandi") {
            $("#row_"+id).html(null);
          }else {
            alert("Olmadı.");
          }
        });
      }
    </script>
  @endsection
</div>
