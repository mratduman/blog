@extends('front.layouts.master')
@section('title','Pyotr Alekseyev')
@section('sub_title','kehânetinin izinden')
@section('bg_img',asset('front/')."/img/bg-img.jpg")
@section('content')
<!-- widgets -->
@include('front.widgets.category')
@include('front.widgets.articleList')
<!-- end widgets -->
@endsection
