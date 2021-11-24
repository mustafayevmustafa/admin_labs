@extends('base')

@section('content')
<!-- c3.js Charts Plugin -->
<link href="{{asset('assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Dashboard </h4>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card ">
                <div class="card-body text-center">
                    <div class="counter-status dash3-counter">
                        <div class="counter-icon bg-primary box-primary-shadow">
                            <i class="fe fe-codepen text-white"></i>
                        </div>
                        <h5 class="font-weight-normal">Total Items</h5>
                        <h2 class="counter font-weight-semibold">{{ count($projects) }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card ">
                <div class="card-body text-center">
                    <div class="counter-status dash3-counter">
                        <div class="counter-icon bg-secondary box-secondary-shadow">
                            <i class="fe fe-shopping-cart text-white"></i>
                        </div>
                        <h5 class="font-weight-normal">Total Sales</h5>
                        <h2 class="counter font-weight-semibold">{{count($myOrders)}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card ">
                <div class="card-body text-center">
                    <div class="counter-status dash3-counter">
                        <div class="counter-icon bg-success box-success-shadow">
                            <i class="fe fe-users text-white"></i>
                        </div>
                        <h5 class="font-weight-normal">Total Members</h5>
                        <h2 class="counter font-weight-semibold">{{ count($users) }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{asset('assets/plugins/flot/jquery.flot.fillbetween.js')}}"></script>
<script src="{{asset('assets/plugins/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('assets/plugins/chart/chart.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/chart/utils.js')}}"></script>
<script src="{{asset('assets/plugins/echarts/echarts.js')}}"></script>
<script src="{{asset('assets/js/echarts.js')}}"></script>
<script src="{{asset('assets/js/index3.js')}}"></script>
@endsection
