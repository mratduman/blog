<div class="col-md-3">
  <div class="card">
    <div class="card-header">
        Kategoriler
    </div>
    <div class="list-group">
      @foreach ($categories as $c)
        <li class="list-group-item"><a href="#">{{ $c["name"] }}</a> <span class="badge">12</span></li>
      @endforeach
    </div>
  </div>
</div>
