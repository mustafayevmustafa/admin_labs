@extends('base')

@section('content')
<link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}" rel="stylesheet" />
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Footer</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Footer</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel-group1" id="accordion2">
                        <div class="panel panel-default mb-4 ">
                            <div class="panel-heading1 bg-primary ">
                                <h4 class="panel-title1"> <a class="accordion-toggle collapsed text-light" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour" aria-expanded="false">Add footer</a> </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                                <div class="panel-body  border">
                                    <form action="" id="add_footer_form">
                                        <div class="form-group ">
                                            <label class="form-label">Content</label>
                                            <textarea type="text" id="footer_content" rows="5" class="form-control w-100"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-block">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @if(isset($footer))
            <div class="card" id="{{$footer->id}}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Content</h5>
                        <div>
                            <button class="btn btn-sm btn-primary mr-2 btn_edit" data-toggle="modal" data-target="#exampleModal3">Edit</button>
                            <button class="btn btn-sm btn-danger btn_delete">Delete</button>
                        </div>
                    </div>
                    <hr>
                    <p class="card-text">{{ $footer->content }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal3" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Edit footer</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="modal-footer-content" class="form-control-label">Content</label>
                        <input type="text" class="form-control" id="modal-footer-content">
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
<script src="{{asset('js/footer.js')}}"></script>
@endsection
