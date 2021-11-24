@extends('layouts.app')

@section('header')

<section>
    <div class="bannerimg">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white">
                    <h1>Verify Your Email Address</h1>
                    <ol class="breadcrumb text-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Custom Pages</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Verify Your Email Address</li>
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
                            <!-- @if (session('resent')) -->
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                            <!-- @endif -->
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <div class="form-footer mt-2">
                                    <button type="submit" class="btn ripple  btn-primary btn-block">
                                        Click here to request another.
                                    </button>
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