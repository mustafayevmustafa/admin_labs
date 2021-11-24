@extends('base')

@section('content')
<link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}" rel="stylesheet" />
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Categories</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <table id="example2" class="hover table-bordered border-top-0 border-bottom-0 dataTable no-footer">
                                <thead>

                                    <tr>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($categories) && count($categories) > 0)
                                    @foreach($categories as $category)
                                    <tr id="{{ $category->id }}">
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->type }}</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <a href="#" class="btn btn-sm btn-primary mr-2"> Edit </a>
                                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    <tr>
                                        <td>Html</td>
                                        <td>theme</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <a href="#" class="btn btn-sm btn-primary mr-2">Edit</a>
                                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page-Header-->

@endsection
@section('javascript')
<script src="{{asset('assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable.js')}}"></script>

@endsection
