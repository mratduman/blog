<div class="col-lg-8 col-md-9 mx-auto">
  @if (count($articles)>0)
    @foreach ($articles as $article)
      <div class="post-preview">
        <a href="{{ route('single_article',[$article->getCategory->slug,$article->slug]) }}">
          <h2 class="post-title">
            {{ $article->title }}
          </h2>
          <img src="../{{ $article->image }}" style="width:90%;height:auto;"><br>
          <!--<h3 class="post-subtitle">
            <?php /* {!! Str::limit($article->content,200) !!} */ ?>
          </h3>-->
        </a><br>
        <h6 class="post-subtitle">
          Kategori: {{ $article->getCategory->name }}
          <span class="float-right">{{ $article->created_at->diffforHumans() }}</span>
        </h6>
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
      Herhangi bir yazı bulunamadı.
    </div>
  @endif
</div>
