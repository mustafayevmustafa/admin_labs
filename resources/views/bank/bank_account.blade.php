@extends('base')

@section('content')
    <link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}" rel="stylesheet"/>
    <div class="side-app">
        <div class="page-header">
            {{--            <h4 class="page-title">Users Bank Accounts ({{count($orders)}})</h4>--}}
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
        </div>
        <!--/Page-Header-->

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="category_table"
                                   class="hover table-bordered border-top-0 border-bottom-0 dataTable no-footer">
                                <thead>
                                <tr>
                                    <th>Author</th>
                                    <th>account_holder_name</th>
                                    <th>address</th>
                                    <th>account_holder_type</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                    <th>Show Account</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($accounts as $account)
                                    <tr id="{{ $account->id }}">
                                        <td>{{ $account->name }}</td>
                                        <td>{{ $account->account_holder_name }}</td>
                                        <td>{{ $account->address }}</td>
                                        <td>{{ $account->account_holder_type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($account->created_at)->format('d F Y') }}</td>
                                        <td>
                                            <select class="select" data-id="{{ $account->id }}">
                                                <option value="0" @if($account->status==0) selected @endif>Not Confirmed</option>
                                                <option value="1" @if($account->status==1) selected @endif>Confirmed</option>
                                                <option value="2" @if($account->status==2) selected @endif>Reject</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <button type="button" id="{{ $account->id }}"
                                                        class="btn btn-sm btn-primary mr-2 btn_edit show-click"
                                                        data-toggle="modal" data-target="#showModal">Show
                                                </button>
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


        <!-- Button trigger modal -->


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        <button type="button" class="btn btn-primary" id="send_not">Send message</button>
                    </div>
                </div>
            </div>
        </div>



        {{--SHOW MODAL--}}}

        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Your Bank Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
        $(document).ready(function () {
            $('#category_table').DataTable();
        });

        $(".select").on('change', function()
        {
            var type = $(this).val();
            let id = $(this).attr("data-id");
            if (type == 0 || type == 1) {
                $.ajax({
                    method: 'POST',
                    url: "change-status",
                    data: {
                        "id": id,
                        "status": type,
                        "_token":_token
                    },
                    success: function (response) {

                    }
                });

            }
            else{
                $("#exampleModal").modal("show")
                $("#exampleModal").attr("data-id" ,id )

            }
        })


        $('.show-click').on('click', function (e) {

            let id = e.target.id;

            let url = '{{ route("bank_show", "=id=") }}';
            url = url.replace('=id=', id);

            $.ajax({
                method: 'GET',
                url: url,
                success: function (response) {
                    //console.log(response)
                    $('#showModal .modal-body').html(response);
                },
                error: function (error) {
                    console.log(error);
                }
            })


        })

        $("#send_not").on('click', function()
        {
            let id = $(this).parent().parent().parent().parent().attr("data-id");
            let not = $("#message").val()
            $("#exampleModal").modal("hide")

            $.ajax({
                method: 'POST',
                url: "change-status",
                data: {
                    "id": id,
                    "not": not,
                    "status" : 2,
                    "_token":_token
                },
                success: function (response) {
                    console.log("test");
                }
            });
        })





    </script>
@endsection
