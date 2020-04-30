@extends('back.layouts.master')
@section('title','İletişim')
@section('content')
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Kişi Bilgisi</th>
          <th>Konu</th>
          <th>Mesaj</th>
          <th>Tarih</th>
          <th>İşlemler</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($contacts as $contact)
          <tr id="row_{{ $contact->id }}">
            <td>{{ $contact->name }}<br>{{ $contact->email }}</td>
            <td>{{ $contact->topic }}</td>
            <td>{{ $contact->message }}</td>
            <td>{{ date("d.m.Y H:i:s",strtotime($contact->created_at)) }}</td>
            <td>
              <a onclick="contactDeleteModalFun({{ $contact->id }})" title="İletişim Formunu Sil" class="btn btn-sm btn-danger text-white"><i class="fa fa-times"></i> Sil</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="contactDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bir saniye?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Bu iletişim formunu silerseniz bir daha ulaşamayacaksınız.</div>
        <div class="modal-footer">
          <input type="hidden" name="contactId" id="contactId" value="">
          <button class="btn btn-default" type="button" data-dismiss="modal">Vazgeç</button>
          <a class="btn btn-danger text-white" onclick="confirmDelete()">Sil</a>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function contactDeleteModalFun(id) {
      $("#contactId").val(id);
      $("#contactDeleteModal").modal("show");
    }
    function confirmDelete() {
      var id = $("#contactId").val();
      var token = "{{ csrf_token() }}";
      $.post("{{ route('admin.contact.delete') }}", { id:id,_token:token }, function (message) {
        if (message) {
          $("#row_"+id).html(null);
        }else {
          alert("Olmadı");
        }
      });
      $("#contactDeleteModal").modal("hide");
    }
  </script>
@endsection
