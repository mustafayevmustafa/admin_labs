@extends('layouts.app')

@section('header')

<section>
    <div class="bannerimg">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white">
                    <h1>Reset Password</h1>
                    <ol class="breadcrumb text-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Custom Pages</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Reset Password</li>
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
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.email') }}">
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
                                <div class="form-footer mt-2">
                                    <button type="submit" class="btn ripple  btn-primary btn-block">
                                        Send Password Reset Link
                                    </button>
                                </div>
                                <div class="text-center text-dark mt-3">
                                    Forget it, <a href="{{route('login')}}">send me back</a> to the sign in.
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