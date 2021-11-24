@extends('base')

@section('content')
<link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}" rel="stylesheet" />
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">User Reports</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Reports</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table id="user_reports_table" class="hover table-bordered border-top-0 border-bottom-0 dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Done</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                <tr id="{{ $report->id }}">
                                    <td>{{ $report->fromUser->username }}</td>
                                    <td>{{ $report->toUser->username }}</td>
                                    <td><i class="fe fe-user-{{ $report->done == true ? 'check' : 'x' }} text-{{ $report->done == true ? 'success' : 'danger' }}" style="font-size: 20px;margin-left: 10px;"></i></td>
                                    <td>
                                        <div class="d-flex align-items-center ">
                                            <button type="button" class="btn btn-sm btn-primary mr-2 btn_view" data-toggle="modal" data-target="#userreposermodal">View</button>
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
<div class="modal fade" id="userreposermodal" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">View</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center">
                <h4>
                    <span id="modal-date" class="badge badge-warning">12/12/2020</span>
                </h4>

                <div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn_done" data-dismiss="modal">Done</button>
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
<script src="{{asset('js/userreports.js')}}"></script>
@endsection
