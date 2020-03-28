@extends('front.layouts.master')
@section('content')
  @include('front.widgets.category')
      <div class="col-lg-8 col-md-9 mx-auto">
        @foreach ($articles as $article)
          <div class="post-preview">
            <a href="post.html">
              <h2 class="post-title">
                {{ $article->title }}
              </h2>
              <h3 class="post-subtitle">
                {{ Str::limit($article->content,100) }}
              </h3>
            </a>
            <p class="post-meta">
              Kategori: <a href="#">{{ $article->getCategory->name }}</a>
              <span class="float-right">{{ $article->created_at->diffforHumans() }}</span>
            </p>
          </div>
          <hr>
        @endforeach
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
@endsection
