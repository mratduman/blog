@extends('front.layouts.master')
@section('title',$page->title)
@section('sub_title','')
@section('bg_img',$page->image)
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      {!! $page->title !!}
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      {!! $page->content !!}
    </div>
  </div>
</div>
@endsection
