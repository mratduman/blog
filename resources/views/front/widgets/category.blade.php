@isset($categories)
  <div class="col-md-3">
    <div class="card">
      <div class="card-header">
          Kategoriler
      </div>
      <div class="list-group">
        @foreach ($categories as $c)
          @if ($c->articleCount()>0)
            <li class="list-group-item">
              <a href="{{ route('category',$c->slug) }}">{{ $c["name"] }}</a> <span class="badge float-right">{{ $c->articleCount() }}</span>
            </li>
          @endif
        @endforeach
      </div>
    </div>
  </div>
@endisset
