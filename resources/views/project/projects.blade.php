@extends('base')

@section('content')

    <link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <style>
        video {
            border: 0 solid rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            font-size: 0;
            overflow: hidden;
            border-radius: 5px;
            height: 200px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .cover_image {
            border: 0 solid rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            font-size: 0;
            overflow: hidden;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .cover_audio {
            height: 141px !important;
        }
    </style>

    <div class="side-app">
        <div class="page-header">
            <div style="width: 100%;">
                <form>
                    <div class="form-group">
                        <label for="">Axtar</label>
                        <input type="text" class="form-control" name="search" value="{{request()->get('search')}}" placeholder="Axtar" style="width: 100%"/>
                    </div>
                </form>
            </div>
        </div>
        @if(isset($projects) && count($projects) > 0)
            <div class="row">

                @foreach($projects as $project)
                    <div class="col-lg-4 col-md-4 project" id="{{$project->id}}">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                @if($project->category_type != 'video')
                                    <a href="/project-detail/{{$project->slug}}">
                                        <img src="{{$project->preview_image_watermark}}" class="cover_image {{$project->category_type == 'audio' ? 'cover_audio' : ''}}" alt="Avada | Website Builder For WordPress &amp; WooCommerce2" class="cover-image">
                                    </a>
                                @endif
                                @if($project->category_type == 'video')
                                    <video controls poster="{{$project->cover}}">
                                        <source src="{{$project->file}}">
                                    </video>
                                @endif
                                @if($project->category_type == 'audio')
                                    <audio controls style="width: 100% !important;" class="pb-3">
                                        <source src="{{$project->file}}">
                                    </audio>
                                @endif
                                <div class="item-card9">
                                    <a href="{{ route('project_detail',$project->slug)}}" class="text-dark mt-2">
                                        <h4 class=" mt-0 mb-2">{{$project->name}}</h4>
                                    </a>
                                    <div class="d-md-flex">
                            <span class="item-ratings fs-14">
                                <?php
                                $all_rating = 0;
                                $key = 0;
                                ?>
                                @if(json_decode($project->ratings) != null)
                                    @foreach(json_decode($project->ratings) as $rating)
                                        @if($rating != null)
                                            <?php $key++; ?>
                                            <?php $all_rating += $rating; ?>
                                        @endif
                                    @endforeach
                                    @if(isset($all_rating))
                                        <span class="item-ratings fs-14">
                                    <?php
                                            for ($i = 0; $i < 5; $i++) {
                                            if ($i < $all_rating) {
                                            ?>
                                            <a href="#"><i class="fa fa-star text-warning "> </i></a>
                                        <?php } else { ?>
                                            <a href="#"><i class="fa fa-star-o text-warning "> </i></a>
                                    <?php }
                                            } ?>
                                </span>
                                    @endif
                                @else
                                    <i class="fa fa-star-o text-warning"></i>
                                    <i class="fa fa-star-o text-warning "></i>
                                    <i class="fa fa-star-o text-warning"></i>
                                    <i class="fa fa-star-o text-warning"></i>
                                    <i class="fa fa-star-o text-warning mr-2"></i>

                                @endif


                                <span class="text-muted fs-13"> ({{$project->sales}} Sales)</span>
                            </span>
                                        @if($project->price != 0 || $project->sale_price != 0 )
                                            <span class="ml-auto text-danger" style="font-size: 17px;font-weight:bold;<?php if($project->price != $project->sale_price && $project->sale_price!=0){echo 'text-decoration: line-through;' ;} ?>">${{$project->price}}</span>
                                        @endif
                                        @if($project->price==0)
                                            <span class="ml-auto text-success rounded-circle border border-success" style="font-size: 17px;font-weight:bold;">Free</span>
                                        @endif
                                        @if($project->sale_price !=0 && $project->sale_price != $project->price && $project->price!=0)
                                            <span class="{{$project->price != null ? 'ml-1' :'ml-auto' }} text-dark" style="font-size: 17px;font-weight:bold;">${{$project->sale_price}}</span>

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <a href="{{ route('project_edit',$project->id)}}" class="btn btn-primary shadow-none btn-sm">
                                            <i class="fe fe-edit-3"></i>
                                        </a>
                                        <button class="btn btn-primary shadow-none btn-sm btn_zap " data-toggle="modal"  data-target="#showModal">
                                            <i class="fe fe-zap"></i>
                                        </button>
                                        <a href="{{ route('project_detail',$project->slug)}}" class="btn btn-info shadow-none btn-sm">
                                            <i class="fe fe-eye"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="/download/{{$project->id}}" class="btn shadow-none btn-warning  ml-1 btn-sm btn_download" download="download">
                                            <i class="fe fe-download"></i>
                                        </a>
                                        <a href="#" class="btn shadow-none btn-danger btn_delete ml-1 btn-sm">
                                            <i class="fe fe-trash-2"></i>
                                        </a>
                                    </div>
                                </div>
                                <hr>
                                @if($project->submit == 0)
                                    <div class="font-weight-bold btn btn-sm btn-danger btn-block btn_confirm"  >Confirm</div>
                                    {{--                    <div class="font-weight-bold btn btn-sm btn-danger btn-block btn_confirm"  data-toggle="modal" data-target="#showModal">Confirm</div>--}}
                                @endif


                            </div>

                        </div>
                        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Please Category Name Write</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Category Name:</label>

                                                <input type="text" class="form-control" name="category_name" id="category_name" >

                                            </div>
                                            <div class="form-group">
                                                <div class="font-weight-bold btn btn-sm btn-danger btn-block btn_name" data-toggle="modal" data-target="#showModal">Category Name Change</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div>
            {!! $projects->appends(request()->all())->links('pagination::bootstrap-4') !!}
        </div>
        <br>
    </div>


@endsection

@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $("#exampleModal").modal("show");

        $(".btn_zap").on("click",function(e){
            $(".btn_name").attr("id",$(this).parents().eq(4).attr("id"));
        });

        // $(".btn-block").on("click",function(e){
        //    $(".btn_confirm").attr("id",$(this).parent().parent().parent().attr("id"));
        // });

        function ajaxAction1(action, id, btn = null) {
            $.ajax({
                type: "POST",
                url: "/project-action",
                data: {
                    _token: _token,
                    id: id,
                    action: action,
                    category_name:$("#category_name").val()
                },
                success: function(response) {
                    $("#category_name").val('')
                    console.log(response);
                    if (response.success == true && response.confirm == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Project Category  is Change',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            })
        }

        function ajaxAction(action, id, btn = null) {
            $.ajax({
                type: "POST",
                url: "/project-action",
                data: {
                    _token: _token,
                    id: id,
                    action: action,
                    // category_name:$("#category_name").val()
                },
                success: function(response) {
                    $("#category_name").val('')
                    console.log(response);
                    if (response.success == true && response.confirm == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Project is confirm',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        btn.fadeOut();
                    }
                    if (response.success == true && response.delete == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Project is delete',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#" + id).fadeOut();
                    }
                }
            })
        }

        $('.btn_confirm').on('click',function(e) {
            var id = $(this).parents().eq(2).attr("id");
            ajaxAction('confirm', id, $(this));
        });

        $('.btn_name').on('click',function(e) {
            var id = $(this).attr("id");
            ajaxAction1('confirm', id, $(this));
        });

        $('.btn_delete').click(function(e) {
            e.preventDefault();
            var id = $(this).parents('.project').attr('id');
            ajaxAction('delete', id)
        })
    </script>


@endsection
