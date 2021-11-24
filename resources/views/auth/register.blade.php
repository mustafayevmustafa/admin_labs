@extends('layouts.app')

@section('header')
<section>
    <div class="bannerimg">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white">
                    <h1>Admin</h1>
                    <ol class="breadcrumb text-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">
                            Admin
                        </li>
                    </ol>
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
                        <!-- <div class="card-body">
                            <div class="btn-list d-flex">
                                <a href="https://www.google.com/gmail/" class="btn btn-google btn-block"><i class="fa fa-google fa-1x mr-2"></i> Google</a>
                                <a href="https://twitter.com/" class="btn btn-twitter"><i class="fa fa-twitter fa-1x"></i></a>
                                <a href="https://www.facebook.com/" class="btn btn-facebook"><i class="fa fa-facebook fa-1x"></i></a>
                            </div>
                        </div>
                        <hr class="divider"> -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label text-dark">Username</label>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-dark">First name</label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-dark">Last name</label>
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-dark">Email address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-dark">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label class="form-label text-dark">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label text-dark">Agree the <a href="terms.html">terms and policy</a></span>
                                    </label>
                                </div>
                                <div class="form-footer mt-2">
                                    <button type="submit" class="btn ripple  btn-primary btn-block">
                                        Create New Account
                                    </button>
                                </div>
                                <div class="text-center  mt-3 text-dark">
                                    Already have account?<a href="{{route('login')}}"> SignIn</a>
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