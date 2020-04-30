@extends('back.layouts.master')
@section('title','Kategoriler')
@section('content')
  <div id="includeArea">
    @include('back.categories.indexCategoryTable')
  </div>
@endsection
