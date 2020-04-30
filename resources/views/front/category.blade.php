@extends('front.layouts.master')
@section('title',"$category->name")
@section('sub_title',"$category->slogan")
@section('bg_img',asset('front/')."/img/".$category->image)
@section('content')
<!-- widgets -->
@include('front.widgets.category')
@include('front.widgets.articleList')
<!-- end widgets -->
@endsection
