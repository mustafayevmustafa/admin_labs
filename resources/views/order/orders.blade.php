@extends('base')

@section('content')
    <link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <div class="side-app">
        <div class="page-header">
            <h4 class="page-title">Payment Orders ({{count($orders)}})</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment Orders</li>
            </ol>
        </div>
        <!--/Page-Header-->

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="orders_table" class="hover table-bordered border-top-0 border-bottom-0">
                                <thead>
                                <tr>
                                    <th>Author</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Payment</th>
                                    <th>Submit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr id="{{$order->id}}">
                                        <td>{{ $order->username }}
                                        </td>
                                        <td><a href="{{route('project_detail',$order->slug)}}">{{ $order->name }}</a></td>
                                        <td>${{ $order->price }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</td>
                                        <td>
                                            <h3><span class="badge badge-success">Success</span></h3>
                                        </td>
                                        <td>
                                            @if($order->submit_order == false)

                                                <button class="btn btn-primary btn-sm btn_send"><i class="fe fe-send"></i> Confirmation</button>
                                            @else
                                                <button class="btn btn-dark btn-sm"><i class="fe fe-send"></i> Approved</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script src="{{asset('assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable.js')}}"></script>
    <script>

        $(document).on('click', '.btn_send', function(e) {
            e.preventDefault();
            var id = $(this).parents('tr').attr('id');
            var _this = $(this);
            $.ajax({
                type: "POST",
                url: "/send-order",
                data: {
                    _token: _token,
                    id: id
                },
                success: function(data) {
                    _this.removeClass('btn_send');
                    _this.removeClass('btn-primary');
                    _this.addClass('btn-dark');
                    _this.html('<i class="fe fe-send"></i> Approved');
                }
            });


        })
    </script>
@endsection
