@extends('front.layouts.master')
@section('title',"Bana bir mesaj bırak")
@section('sub_title','')
@section('bg_img',"https://blackrockdigital.github.io/startbootstrap-clean-blog/img/contact-bg.jpg")
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <p>Bana ulaşmak için aşağıdaki formu doldurabilirsin</p>
      <form name="sentMessage" id="contactForm" action="{{ route('contact_post') }}" method="post" novalidate>
        @csrf
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Ad Soyad</label>
            <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Ad soyad" id="name" name="name" required data-validation-required-message="Lütfen bu alanı doldurunuz.">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Email Address</label>
            <input type="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" id="email" name="email" required data-validation-required-message="Lütfen bu alanı doldurunuz.">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group col-xs-12 floating-label-form-group controls">
            <label>Konu</label>
            <input type="text" class="form-control" value="{{ old('topic') }}" placeholder="Konu" id="topic" name="topic" required data-validation-required-message="Lütfen bu alanı doldurunuz.">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Mesaj</label>
            <textarea rows="5" class="form-control" placeholder="Mesajınız" id="message" name="message" required data-validation-required-message="Lütfen bu alanı doldurunuz.">{{ old('message') }}</textarea>
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <br>
        <div id="success"></div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
