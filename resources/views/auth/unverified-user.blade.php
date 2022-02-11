@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Belum diverifikasi')

@section('page-style')
<link rel="stylesheet" href="{{asset(mix('css/base/pages/page-misc.css'))}}">
@endsection

@section('content')
<!-- Not authorized-->
<div class="misc-wrapper">
  <a class="brand-logo" href="#">
    <img src="{{asset('images/logo/logo-bem.png')}}" >
    <h2 class="brand-text text-primary ms-1">BEM-FTI UNISKA</h2>
  </a>
  <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
      <h2 class="mb-1">Kamu belum diverifikasi 🔐</h2>
      <p class="mb-2">Hubungi admin BEM-FTI atau tunggu beberapa saat !!</p>
      <a class="btn btn-primary mb-1 btn-sm-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kembali login</a>
      <form method="POST" id="logout-form" action="{{ route('logout') }}">
        @csrf
      </form>
      @if($configData['theme'] === 'dark')
      <img class="img-fluid" src="{{asset('images/pages/not-authorized-dark.svg')}}" alt="Not authorized page" />
      @else
      <img class="img-fluid" src="{{asset('images/pages/not-authorized.svg')}}" alt="Not authorized page" />
      @endif
    </div>
  </div>
</div>
<!-- / Not authorized-->
</section>
<!-- maintenance end -->
@endsection
