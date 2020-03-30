@extends('front.layouts.master')
@section('title',$category->name)
@section('sub_title','kirpi balığının ısırmasıyla oscarın uçuşu')
@section('bg_img',asset('front/')."/img/".$category->slug.".jpg")
@section('content')
<!-- widgets -->
@include('front.widgets.category')
@include('front.widgets.articleList')
<!-- end widgets -->
@endsection
