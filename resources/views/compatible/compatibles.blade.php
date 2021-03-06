@extends('base')

@section('content')
<link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}" rel="stylesheet" />
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Compatibles</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Compatibles</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel-group1" id="accordion2">
                        <div class="panel panel-default mb-4 ">
                            <div class="panel-heading1 bg-primary ">
                                <h4 class="panel-title1"> <a class="accordion-toggle collapsed text-light" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour" aria-expanded="false">Add Compatible</a> </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                                <div class="panel-body  border">
                                    <form action="" id="add_compatible_form">
                                        <div class="form-group ">
                                            <label class="form-label">Name</label>
                                            <input type="text" id="compatible_name" class="form-control w-100">
                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table id="compatible_table" class="hover table-bordered border-top-0 border-bottom-0 dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>Compatible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compatibles as $compatible)
                                <tr id="{{ $compatible->id }}">
                                    <td>{{ $compatible->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center ">
                                            <button type="button" class="btn btn-sm btn-primary mr-2 btn_edit" data-toggle="modal" data-target="#exampleModal3">Edit</button>
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
<div class="modal fade" id="exampleModal3" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Edit compatible</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">??</span> </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="modal-compatible-name" class="form-control-label">Name</label>
                        <input type="text" class="form-control" id="modal-compatible-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary modal_edit">Update</button> </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')

<script src="{{asset('assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable.js')}}"></script>
<script src="{{asset('js/compatible.js')}}"></script>
@endsection
