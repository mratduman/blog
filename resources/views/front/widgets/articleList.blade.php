<div class="col-lg-8 col-md-9 mx-auto">
  @if (count($articles)>0)
    @foreach ($articles as $article)
      <div class="post-preview">
        <a href="{{ route('single_article',[$article->getCategory->slug,$article->slug]) }}">
          <h2 class="post-title">
            {{ $article->title }}
          </h2>
          <img src="{{ $article->image }}">
          <h3 class="post-subtitle">
            {!! Str::limit($article->content,100) !!}
          </h3>
        </a>
        <p class="post-meta">
          Kategori: <a href="#">{{ $article->getCategory->name }}</a>
          <span class="float-right">{{ $article->created_at->diffforHumans() }}</span>
        </p>
      </div>
      <hr>
    @endforeach
    <div class="row">
      <div class="float-right">
        {{ $articles->links() }}
      </div>
    </div>
  @else
    <div class="alert alert-danger">
      Bu kategoriye ait herhangi bir yazı bulunamadı.
    </div>
  @endif
</div>
