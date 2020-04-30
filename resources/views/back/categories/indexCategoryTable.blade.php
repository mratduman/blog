<div class="row">
  <div class="col-md-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.category.create') }}" enctype="multipart/form-data">
          <div class="form-group">
            <label>Kategori Adı</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Kategori adı giriniz" required>
          </div>
          <div class="form-group">
            <label>Slogan</label>
            <input type="text" class="form-control" name="slogan" id="slogan" placeholder="Tanımlayan bir söz giriniz" required>
          </div>
          <div class="form-group">
            <label for="">Resim</label>
            <input type="file" name="image" id="image" class="form-control" required>
          </div>
          <div class="form-group">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            <button type="submit" name="button" class="btn btn-primary btn-block">Ekle</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kategoriler</h6>
      </div>
      <div class="card-body" id="cardTable">
        <div class="table-responsive" id="categoryTable">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Kategori Adı</th>
                <th>Kategoriye Ait Yazı</th>
                <th>Durum</th>
                <th>İşlemler</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                <tr id="row_{{ $category->id }}">
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->articleCount() }}</td>
                  <td>
                    @php
                      $status = str_replace("1","<span class='text-success'>Aktif</span>",$category->active);
                      $status = str_replace("0","<span class='text-danger'>Pasif</span>",$status);
                    @endphp
                    {!! $status !!}
                  </td>
                  <td>
                    <input type="hidden" name="currentSlogan{{ $category->id }}" id="currentSlogan{{ $category->id }}" value="{{ $category->slogan }}">
                    <input type="hidden" name="currentCategoryName{{ $category->id }}" id="currentCategoryName{{ $category->id }}" value="{{ $category->name }}">
                    <input type="hidden" name="currentStatus{{ $category->id }}" id="currentStatus{{ $category->id }}" value="{{ $category->active }}">
                    <a onclick="editFun({{ $category->id }})" title="Düzenle" class="btn btn-sm btn-primary text-white"><i class="fa fa-pen"></i></a>
                    <a onclick="imageEditFun('{{ $category->id }}','{{ $category->image }}','{{ $category->name }}')" title="Resmi Değiştir" class="btn btn-sm btn-info text-white"><i class="fa fa-images"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kategori Düzenle</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Kategori Adı</label>
          <input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="Kategori adı" required>
        </div>
        <div class="form-group">
          <label>Slogan</label>
          <input type="text" class="form-control" name="sloganUp" id="sloganUp" placeholder="Tanımlayan bir söz giriniz" required>
        </div>
        <div class="form-group">
          <label class="text-danger">Dikkat Pasif olarak düzenlerseniz bu kategoriye ait bütün yazılar yayından kalkacaktır.</label><br>
          <label>Aktif</label>
          <input type="checkbox" name="status[]" id="active" onclick="checkboxFun(1)" value="1">
          <label>Pasif</label>
          <input type="checkbox" name="status[]" id="passive" onclick="checkboxFun(0)" value="0">
        </div>
        <input type="hidden" name="categoryId" id="categoryId" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
        <button type="button" onclick="categoryEdit()" name="button" class="btn btn-primary">Kaydet</button>
      </div>
    </div>
  </div>
</div>
<div id="imageEditModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.category.image.edit') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h4 class="modal-title" id="imageEditName"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Mevcut Resim</label>
            <div class="row" id="currentImage"></div>
          </div>
          <div class="form-group">
            <label>Yeni Resimi Yükle</label>
            <input type="file" class="form-control" name="newImage" id="newImage" required>
          </div>
          <label class="text-danger">Dikkat! Yeni resmi yüklediğinizde mevcut resim silinecektir.</label><br>
          <input type="hidden" name="imageEditCategoryId" id="imageEditCategoryId" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
          <button type="submit" name="button" class="btn btn-primary">Değiştir</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  function imageEditFun(id,imageUrl,categoryName) {
    $("#imageEditName").html(categoryName+" Resmini Değiştir");
    $("#currentImage").html("<img src='../front/img/"+imageUrl+"' style='width:70%;height:auto;'>");
    $("#imageEditCategoryId").val(id);
    $("#imageEditModal").modal("show");
  }

  function checkboxFun(status) {
    if (status==1) {
      document.getElementById('passive').checked = false;
    }else {
      document.getElementById('active').checked = false;
    }
  }

  function editFun(id) {
    $("#categoryName").val(null);
    document.getElementById('active').checked = false;
    document.getElementById('passive').checked = false;
    $("#categoryId").val(null);

    var currentCategoryName = $("#currentCategoryName"+id).val();
    var currentStatus = $("#currentStatus"+id).val();
    var currentSlogan = $("#currentSlogan"+id).val();
    $("#categoryName").val(currentCategoryName);
    if (currentStatus==1) {
      document.getElementById('active').checked = true;
    }else {
      document.getElementById('passive').checked = true;
    }
    $("#categoryId").val(id);
    $("#sloganUp").val(currentSlogan);

    $("#editModal").modal("show");
  }

  function categoryEdit() {
    var id = $("#categoryId").val();
    var name = $("#categoryName").val();
    var active = $("#active").is(":checked");
    if (active) {
      var active = 1;
    }else {
      var active = 0;
    }
    var token = "{{ csrf_token() }}";
    $.post("{{ route('admin.category.update') }}", { id:id,name:name,active:active,_token:token }, function (message) {
      if (message=="success") {
        $("#includeArea").load("{{ route('admin.category.table') }}");
      }else {
        alert("Olmadı.");
      }
    });
    $("#editModal").modal("hide");
  }
  /*
  function createCategory() {
    var name = $("#name").val();
    var token = $("#token").val();
    $.post("{{ route('admin.category.create') }}", { name:name,_token:token }, function (message) {
      if (message=="success") {
        $("#includeArea").load("{{ route('admin.category.table') }}");
      }else {
        alert(message);
      }
    });
  }
  */
</script>
