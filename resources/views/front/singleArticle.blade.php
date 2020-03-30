@extends('front.layouts.master')
@section('title',$article->title)
@section('sub_title','')
@section('bg_img',$article->image)
@section('content')
@include('front.widgets.category')
<div class="col-lg-8 col-md-9 mx-auto">
  <article>
    <div class="container">
      <div class="row">
        <div class="mx-auto">
          <p>{!! $article->content !!}</p>
        </div>
      </div>
      <div class="row">
        <span class="float-right">Görüntülenme: {{ $article->hit }}</span>
      </div>
    </div>
  </article>
</div>
@endsection
