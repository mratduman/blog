@extends('back.layouts.master')
@section('title','Yazılar')
<div id="indexArticles">
  @section('content')
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{ $articles->count() }}</strong> Yazı Listelendi
          <span class="float-right">
            <a href="{{ route('admin.trashed_article') }}" class="btn btn-sm btn-warning">Silinenler</a>
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
                <th>Durum</th>
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
                    @php
                      $status = str_replace("1","<span class='text-success'>Aktif</span>",$article->active);
                      $status = str_replace("0","<span class='text-danger'>Pasif</span>",$status);
                    @endphp
                    {!! $status !!}
                  </td>
                  <td>
                    <a href="{{ route('single_article',[$article->getCategory->slug,$article->slug]) }}" target="_blank" title="Aç" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.articles.edit',$article->id) }}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                    <button type="button" onclick="delete_article_modal({{ $article->id }})" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      function delete_article_modal(id) {
        $("#deleteId").val(null);
        $("#deleteId").val(id);
        $("#deleteModal").modal("show");
      }
      function deletion_confirmation() {
        var id = $("#deleteId").val();
        $.get("{{ route('admin.delete_article') }}", { id:id }, function (message) {
          $("#deleteModal").modal("hide");
          if (message=="Silindi") {
            $("#row_"+id).html(null);
          }else {
            alert("Olmadı.");
          }
        });
      }
    </script>
  @endsection
</div>
