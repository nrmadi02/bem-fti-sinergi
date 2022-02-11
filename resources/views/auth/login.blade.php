@extends('layouts/fullLayoutMaster')

@section('title', 'Login')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-2">
    <div class="auth-inner my-2">
      <!-- Login basic -->
      <div class="card mb-0">
        <div class="card-body">
          <a href="#" class="brand-logo">
            <img src="{{asset('images/logo/logo-bem.png')}}" >
            <img class="ms-1" src="{{asset('images/logo/logo-kabinet.png')}}" >
            <h2 class="brand-text text-primary ms-1">BEM-FTI UNISKA</h2>
          </a>
          <h4 class="card-title mb-1">Selamat Datang di SINERGI</h4>
          <p class="card-text mb-2">Silahkan login sesuai data yang anda daftarkan</p>

          @if (session('status'))
            <div class="alert alert-success mb-1 rounded-0" role="alert">
              <div class="alert-body">
                {{ session('status') }}
              </div>
            </div>
          @endif

          <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-1">
              <label for="login-email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="login-email" name="email"
                placeholder="udin@gmail.com" aria-describedby="login-email" tabindex="1" autofocus
                value="{{ old('email') }}" />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-1">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="login-password">Password</label>
              </div>
              <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="login-password" name="password"
                  tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="login-password" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
            <div class="mb-1">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" tabindex="3"
                  {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember"> Ingat data login ? </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" tabindex="4">Masuk</button>
          </form>

          <p class="text-center mt-2">
            <span>Belum punya akun ?</span>
            @if (Route::has('register'))
              <a href="{{ route('register') }}">
                <span>Daftar disini</span>
              </a>
            @endif
          </p>
        </div>
      </div>
      <!-- /Login basic -->
    </div>
  </div>
@endsection
