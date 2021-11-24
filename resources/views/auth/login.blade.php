@extends('layouts.app')

@section('header')
@if(\Illuminate\Support\Facades\App::environment() == 'production')
<script id="https">
    if (location.href.indexOf('https:') !== 0) {
        location.href = location.href.replace('http:', 'https:');
        document.getElementById('https').remove();
    }
</script>
@endif
<section>
    <div class="bannerimg">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white">
                    <h1>Xoş gəlibsiz məllim</h1>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')

<section class="sptb">
    <div class="container customerpage">
        <div class="row">
            <div class="single-page">
                <div class="col-lg-5 col-xl-4 col-md-6 d-block mx-auto">
                    <div class="card">
                        {{-- <div class="card-body">
                            <div class="btn-list d-flex">
                                <a href="https://www.google.com/gmail/" class="btn btn-google btn-block"><i class="fa fa-google fa-1x mr-2"></i> Google</a>
                                <a href="https://twitter.com/" class="btn btn-twitter"><i class="fa fa-twitter fa-1x"></i></a>
                                <a href="https://www.facebook.com/" class="btn btn-facebook"><i class="fa fa-facebook fa-1x"></i></a>
                            </div>
                        </div>
                        <hr class="divider"> --}}
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label text-dark">Email address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-dark">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="custom-control-label text-dark">Remember Me</span>
                                    </label>
                                </div>
                                <div class="form-footer mt-2">
                                    <button type="submit" class="btn ripple  btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                                <div class="text-center  mt-3 text-dark">
                                    <p class="mb-2"><a href="{{route('password.request')}}">Forgot Password</a></p>
                                    {{-- <p class="text-dark mb-0">Don't have account?<a href="{{route('register')}}" class="text-primary ml-1">Sign UP</a></p> --}}
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
