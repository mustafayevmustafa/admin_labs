@extends('base')

@section('content')
<link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}" rel="stylesheet" />
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Users</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table id="users_table" class="hover table-bordered border-top-0 border-bottom-0 dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Full name</th>
                                    <th>Username</th>
                                    <th>Time</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr id="{{ $user->id }}">
                                    <td><img src="{{ $user->profile_image }}" class="avatar avatar-lg brround " alt=""></td>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        <div class="btn btn-sm btn-{{ $user->is_admin == true ? 'success' : ($user->seller == 1 ? 'dark' : 'danger') }}">
                                            {{ $user->is_admin == true ? 'Admin' : ($user->seller == 1 ? "Seller" : "Buyer") }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center ">
                                            <a href="{{route('edit_profile',$user->username)}}" class="btn btn-sm btn-primary mr-2 ">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger btn_delete">Delete</a>
                                        </div>
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
<script src="{{asset('js/users.js')}}"></script>
@endsection
