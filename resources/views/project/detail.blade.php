@extends('base')


@section('header')
<section>
    <div class="bannerimg">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white">
                    <h1>Detail</h1>
                    <ol class="breadcrumb text-center">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{$project->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<style>
    video {
        border: 0 solid rgba(0, 0, 0, 0.2);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4) !important;
        position: relative;
        font-size: 0;
        overflow: hidden;
        border-radius: 5px;
        height: 350px;
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
        height: 300px;
        object-fit: cover;
        margin-bottom: 20px;
    }

    .cover_audio {
        height: 141px !important;
    }
</style>
<section class="sptb mt-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="item-det mb-4">
                            <a href="#" class="text-dark">
                                <h2 class="fs-22">{{$project->name}}</h2>
                            </a>
                            <div class="d-flex mt-2">
                                <ul class="d-flex">
                                    <li class="mr-5"><a href="#" class="icons"><i class="fe fe-briefcase text-muted mr-1"></i> {{$project->category}}</a></li>
                                    <li class="mr-5"><a href="#" class="icons"><i class="fe fe-calendar text-muted mr-1"></i> {{\Carbon\Carbon::parse($project->created_at)->diffForHumans()}}</a></li>
                                    <li class="mr-5"><a href="#" class="icons"><i class="fe fe-eye text-muted mr-1"></i> {{$project->view}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="marketplace-single-imag mx-auto text-center">
                            @if($project->category_type == 'theme' || $project->category_type == 'code' || $project->category_type == 'photo' || $project->category_type == 'icon'  || $project->category_type == '3D' )
                                @if($project->files == null || $project->category_type == 'photo')
                                    <div class="d-block link-overlay">
                                        <img class="d-block img-fluid  mx-auto text-center w-100 rounded"
                                             src="{{$project->preview_image_watermark}}">


                                    </div>
                                @endif
                            @if(isset($project->files))
                            <div class="product-slider">
                                <div id="carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach(json_decode($project->files) as $key=>$file)
                                        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                            @if($file->mime_type == 'video/mp4')
                                            <video width="" height="" src="{{$file->file}}" onclick="this.play()" ondblclick="this.pause()">
                                                Your browser does not support the video tag.
                                            </video>
                                            @else
                                            <img src="{{$file->file}}" alt="img">
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </div>

                            </div>
                            @endif
                            @else
                            @if($project->category_type == 'audio')
                            <img src="{{$project->cover}}" class="cover_image">
                            @endif
                            <div class="product-slider">
                                <div id="carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            @if($project->category_type == 'video')
                                            <video poster="{{$project->cover}}" class="cover-image" src="{{$project->preview_file}}" controls></video>
                                            @elseif($project->category_type='audio')
                                            <audio controls class="my-2" style="width: 100%;" src="{{$project->preview_file}}">
                                            </audio>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="p-4  btn-list">
                                @if($project->demo_url != '' || $project->demo_url != null)
                                <a href="{{$project->demo_url}}" class="btn ripple  btn-primary btn-lg-0">
                                    <i class="fe fe-airplay"></i> Live Preview
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-0 mb-5">
                    <div class="wideget-user-tab wideget-user-tab3">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class=""><a href="#tab-1" class="active" data-toggle="tab">Details</a></li>
                                    <li><a href="#tab-2" data-toggle="tab" class="">Ratings</a></li>
                                    <li><a href="#tab-3" data-toggle="tab" class="">Comments</a></li>
                                    <li><a href="#tab-4" data-toggle="tab" class="">Support</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content details-tab-content">
                        <div class="tab-pane active" id="tab-1">
                            <div class="border-left border-right p-5 bg-white">
                                <h3 class="card-title mb-3 ">Description</h3>
                                <div class="mb-0" style="word-break: break-all !important;">
                                    {!! $project->description !!}
                                </div>
{{--                                @if(isset($project->features) && count(json_decode($project->features)))--}}
                                @if(isset($project->specials) )

                                <h4 class="card-title mb-3 ">Product Included</h4>
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 mb-2">
                                        <ul class="list-unstyled widget-spec mb-0">
                                            @foreach((array) json_decode($project->specials) as $special)
                                                <li class="pt-2">
                                                    <span class="w-80 font-weight-semibold text-dark">{{$special->key}}</span>
                                                    <span class="w-60 text-muted"><a href="#">{{$special->value}}</a></span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif

                            </div>
{{--                            <div class="card-footer bg-white br-bl-3 br-br-3 border-right border-left border-bottom">--}}
{{--                                <div class="btn-list">--}}
{{--                                    <a href="#" class="btn ripple btn-primary icons "><i class="icon icon-heart mr-1"></i> <span>{{$likes}}</span></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <div class="border-left border-right p-5 bg-white border-bottom br-bl-3 br-br-3">
                                <div class="row">
                                    <div class="col-md-12 review_list">
                                        @if(isset($reviews) && count($reviews) > 0)
                                        @foreach($reviews as $review)
                                        <div class="card shadow-none review_card">
                                            <div class="card-header bg-light shadow-none">
                                                <div class="d-flex justify-content-between align-items-center w-100">
                                                    <div class="rating-stars-container mr-2 d-flex align-items-center">
                                                        <div class="item-ratings fs-14">
                                                            @if($review->rating)
                                                            <?php
                                                            for ($i = 0; $i < 5; $i++) {
                                                                if ($i < $review->rating) {
                                                            ?>
                                                                    <div style="display: inline-block;font-size: 20px;color: #83829c;cursor: pointer;padding: 1px;">
                                                                        <a href="#"><i class="fa fa-star text-warning"> </i></a>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div style="display: inline-block;font-size: 20px;color: #83829c;cursor: pointer;padding: 1px;">
                                                                        <a href="#"><i class="fa fa-star-o text-warning "> </i></a>
                                                                    </div>
                                                            <?php }
                                                            } ?>

                                                            @endif
                                                        </div>
                                                        <div class="ml-2" style="font-size: 15px;">

                                                            for <span class="h5 dark-grey-text mb-2">{{$review->category}}</span>
                                                            @auth
                                                            @if(Auth::user()->username == json_decode($project->user)->username)
                                                            <a href="#" data-review="{{$review->id}}" data-project="{{$project->id}}" class="ml-2 reply_modal" data-toggle="modal" data-target="#Comment"><span class="badge badge-info">Reply</span></a>
                                                            @endif
                                                            @endauth
                                                        </div>
                                                    </div>
                                                    <div class="">by <a href="#" class="text-primary">{{$review->user}}</a> <span class="text-muted">{{\Carbon\Carbon::parse($review->created_at)->diffForHumans()}}</span></div>
                                                </div>
                                            </div>
                                            @if($review->review != null)
                                            <div class="card-body">
                                                <p class="font-weight-normal dark-grey-text mb-0"> {{$review->review}}</p>
                                            </div>
                                            @endif
                                            @if($review->reply_user != null)
                                            <div class="card-body bg-light border-top">
                                                <div class="media mt-0 mb-0">
                                                    <div class="d-flex mr-3"> <a href="#"><img class="media-object brround" alt="64x64" src="{{json_decode($review->reply_user)[0]->profile_image}}"> </a> </div>
                                                    <div class="media-body">
                                                        <h4 class="mt-0 mb-1 ">{{json_decode($review->reply_user)[0]->username}}</h4>
                                                        <p class="fs-15  mb-0 mt-2">{{json_decode($review->reply)[0]}} </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                        @endif
                                        {!! $reviews->links('pagination::bootstrap-4') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-header">
                                    <h3 class="card-title">Item Rating</h3>
                                </div>
                                <div class="card-body">
                                    <div class="rating-stars d-flex mb-3">
                                        <label class="form-label mr-3 mt-1">Select Rating:</label>
                                        <input type="number" class="rating-value star" id="rating_star" name="rating-stars-value">
                                        <div class="rating-stars-container mr-2">
                                            <div class="rating-star lg">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-star lg">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-star lg">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-star lg">
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="rating-star lg">
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group reviewselect">
                                        <select class="form-control" id="review_category" name="review_category">
                                            <option value="0">Select</option>
                                            @if(isset($review_categories) && count($review_categories) > 0)
                                            @foreach($review_categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="review_comment" rows="6" placeholder="Comment" id="review_comment"></textarea>
                                    </div>
                                    @auth
                                    <a href="#" class="btn ripple  btn-primary btn_review btn-block">Review</a>
                                    @else
                                    <a href="/login" class="btn ripple  btn-primary btn-block">Review</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-3">
                            <div class="border-left border-right p-5 bg-white border-bottom br-bl-3 br-br-3 comment-list">
                                @if(isset($comments) && count($comments) > 0)
                                @foreach($comments as $comment)
                                <div class="card shadow-none" id="{{$comment->id}}">
                                    <div class="card-body">
                                        <div class="media mt-0">
                                            <img class="mr-3 avatar brround" src="{{json_decode($comment->user)->profile_image}}" alt="">
                                            <div class="media-body">
                                                <div class="d-md-flex align-items-center">
                                                    <h4 class="mb-2">
                                                        {{json_decode($comment->user)->full_name}}
                                                    </h4>
                                                    @if(isset(auth()->user()->id) && json_decode($comment->user)->username == Auth::user()->username)
                                                    <a href="" class="mx-2 btn btn-danger btn-sm comment_delete">Delete</a>
                                                    @else
                                                    <a href="" class="mr-2 text-muted" data-toggle="modal" data-target="#report"><span class="badge badge-default">Report</span></a>
                                                    @endif
                                                    <small class="text-muted ml-md-auto"><i class="fe fe-calendar mr-1"></i>{{\Carbon\Carbon::parse(json_decode($project->user)->created_at)->format('j F Y')}}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="fs-15  mb-0 mt-3">
                                            {{$comment->comment}}
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                                {{$comments->links('pagination::bootstrap-4')}}
                                @endif

                            </div>
                            <div class="card mt-5" id="{{$project->id}}">
                                <div class="card-header">
                                    <h3 class="card-title">Write Your Comments</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea class="form-control" id="comment" name="comment" rows="6" placeholder="Write Your Comment"></textarea>
                                    </div>
                                    @auth
                                    <a href="#" class="btn ripple  btn-primary btn_comment btn-block">Comment</a>
                                    @else
                                    <a href="/login" class="btn ripple  btn-primary btn-block">Comment</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-4">
                            <div class="card p-5 bg-white">
                                <h3 class="card-title mb-4 ">Contact the Author</h3>
                                <div class="form-group">
                                    <label class="form-label">Support Query</label>
                                    <textarea class="form-control" id="support_message" name="support_message" rows="6" placeholder="Comment"></textarea>
                                </div>
                                @auth
                                <a href="#" class="btn ripple  btn-primary support_btn">Send</a>
                                @else
                                <a href="/login" class="btn ripple  btn-primary ">Send</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Related Posts-->
            </div>
            <!--Right Side Content-->
            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="card  mt-5 mt-lg-0">
                    <div class="pt-4 pb-4 pl-5 pr-5 border-bottom">
                        <h2 class="d-flex justify-content-between">
                            Price
                            <div>
                                @if($project->price != 0 || $project->sale_price != 0 )
                                    <span class="ml-auto text-danger"
                                          style="font-size: 17px;font-weight:bold;<?php if ($project->price != $project->sale_price && $project->sale_price != 0) {
                                              echo 'text-decoration: line-through;';
                                          } ?>">${{$project->price}}</span>

                                @endif
                                @if($project->price==0)
                                    <span class="ml-auto text-success rounded-circle border border-success"
                                          style="font-size: 17px;font-weight:bold;">Free</span>
                                @endif
                                @if($project->sale_price !=0 && $project->sale_price != $project->price)
                                    <span class="{{$project->price != null ? 'ml-1' :'ml-auto' }} text-dark"
                                          style="font-size: 17px;font-weight:bold;">${{$project->sale_price}}</span>

                                @endif
                                {{--                                    @if($project->price != null && $project->price !=0 && $project->price!=$project->sale_price )--}}
                                {{--                                        <span class="{{$project->price != null ? 'ml-1' :'ml-auto' }} text-dark" style="font-size: 17px;font-weight:bold;">${{$project->sale_price}}</span>--}}

                                {{--                                    @endif--}}
                            </div>

                        </h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="mb-1  mr-3 mt-2">Total Sales:</p>
                            <p class="mb-0 fs-25 font-weight-semibold"><i class="typcn typcn-shopping-cart text-dark mr-1"></i>{{$project->sales}}</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="mb-1 mr-3 mt-2">Total Comments:</p>
                            <p class="mb-0 fs-25 "><i class="typcn typcn-messages text-dark mr-1"></i><a href="#" class="text-dark font-weight-semibold">{{count($comments)}}</a></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="item-rating-info d-flex mb-4">
                            <h5 class="mr-3 ">Items Rating:</h5>
                            @if(isset($ratings))
                            @if($ratings != null)
                            <?php
                            $one = 0;
                            $two = 0;
                            $three = 0;
                            $four = 0;
                            $five = 0;

                            $one_rating = 0;
                            $two_rating = 0;
                            $three_rating = 0;
                            $four_rating = 0;
                            $five_rating = 0;
                            $all_rating = 0;
                            $key = 0;
                            ?>

                            @foreach(json_decode($ratings->ratings) as $rating)
                            @if($rating != null)
                            <?php $key++; ?>
                            @if($rating == 1)
                            <?php $one = $one + $rating;
                            $one_rating++; ?>
                            @elseif($rating == 2)
                            <?php $two = $two + $rating;
                            $two_rating++; ?>
                            @elseif($rating == 3)
                            <?php $three = $three + $rating;
                            $three_rating++; ?>
                            @elseif($rating ==4)
                            <?php $four = $four + $rating;
                            $four_rating++; ?>
                            @elseif($rating ==5)
                            <?php $five = $five + $rating;
                            $five_rating++; ?>
                            @endif
                            <?php $all_rating += $rating; ?>
                            @endif
                            @endforeach
                            <?php
                            $one_percent = round(($one / $all_rating) * 100, 1);
                            $two_percent = round(($two / $all_rating) * 100, 1);
                            $three_percent = round(($three / $all_rating) * 100, 1);
                            $four_percent = round(($four / $all_rating) * 100, 1);
                            $five_percent = round(($five / $all_rating) * 100, 1);
                            $all_rating = round($all_rating / $key, 0);
                            ?>
                            @endif
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
                                ({{$key}})
                            </span>
                            @endif
                            @endif
                        </div>
                        <div class="mb-3">
                            <small class="mb-0">5 Star<span class="float-right text-muted">{{isset($five_percent) ? $five_percent : '0'}}%</span></small>
                            <div class="progress h-1 mt-1">
                                <div class="progress-bar bg-warning" style="width: {{isset($five_percent) ? $five_percent : '0'}}%;" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <small class="mb-0">4 Star<span class="float-right text-muted">{{isset($four_percent) ? $four_percent : '0'}}%</span></small>
                            <div class="progress h-1 mt-1">
                                <div class="progress-bar bg-warning" style="width: {{isset($four_percent) ? $four_percent : '0'}}%;" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <small class="mb-0">3 Star<span class="float-right text-muted">{{isset($three_percent) ? $three_percent : '0'}}%</span></small>
                            <div class="progress h-1 mt-1">
                                <div class="progress-bar bg-warning" style="width: {{isset($three_percent) ? $three_percent : '0'}}%;" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <small class="mb-0">2 Star<span class="float-right text-muted">{{isset($two_percent) ? $two_percent : '0'}}%</span></small>
                            <div class="progress h-1 mt-1">
                                <div class="progress-bar bg-warning" style="width: {{isset($two_percent) ? $two_percent : '0'}}%;" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <small class="mb-0">1 Star<span class="float-right text-muted">{{isset($one_percent) ? $one_percent : '0'}}%</span></small>
                            <div class="progress h-1 mt-1">
                                <div class="progress-bar bg-warning" style="width: {{isset($one_percent) ? $one_percent : '0'}}%;" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body item-user">
                        <div class="text-center">
                            <a href="/{{json_decode($project->user)->username}}" class="mb-4">
                                <img src="{{json_decode($project->user)->profile_image}}" alt="imag" class="avatar avatar-xxl brround"></a>
                            <a href="/{{json_decode($project->user)->username}}">
                                <h3 class="mt-2 mb-1 text-dark">{{json_decode($project->user)->full_name}}</h3>
                            </a>
                            <span class="text-muted">Member since {{\Carbon\Carbon::parse(json_decode($project->user)->created_at)->format('j F Y')}}</span>
                        </div>
                        <div class=" item-user-icons mt-2 mb-5 text-center">
                            <!-- facebook,instagram,twitter,pinterest -->
                            @if(json_decode($project->user)->facebook != null)
                            <a href="//{{json_decode($project->user)->facebook}}" class="facebook-bg mt-0"><i class="fa fa-facebook"></i></a>
                            @endif
                            @if(json_decode($project->user)->instagram != null)
                            <a href="//{{json_decode($project->user)->instagram}}" class="pinterest-bg mt-0"><i class="fa fa-instagram"></i></a>
                            @endif
                            @if(json_decode($project->user)->twitter != null)
                            <a href="//{{json_decode($project->user)->twitter}}" class="twitter-bg"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if(json_decode($project->user)->pinterest != null)
                            <a href="//{{json_decode($project->user)->pinterest}}" class="pinterest-bg"><i class="fa fa-pinterest"></i></a>
                            @endif
                        </div>
                        <div class="">
                            <a href="/user-profile/{{json_decode($project->user)->username}}" class="btn ripple btn-light btn-block btn-lg"> View Porfile</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-0">
                    <div class="card-header">
                        <h3 class="card-title">Product Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="marketplace-content">
                            <ul class="list-unstyled widget-spec mb-0">
                                <li class="">
                                    <span class="w-40 font-weight-semibold text-dark">Last Update</span><span
                                            class="w-60 text-muted">{{\Carbon\Carbon::parse($project->updated_at)->format('j F Y')}}</span>
                                </li>
                                <li class="pt-2">
                                    <span class="w-40 font-weight-semibold text-dark">Release Date</span><span
                                            class="w-60 text-muted">{{\Carbon\Carbon::parse($project->created_at)->format('j F Y')}}</span>
                                </li>
                                @if(json_decode($project->categories))
                                    <li class="pt-2">
                                        <span class="w-40 font-weight-semibold text-dark">Category</span><span
                                                class="w-60 text-muted">

                                        @if(json_decode($project->categories))
                                                @foreach(json_decode($project->categories) as $category)
                                                    <a href="javascript:void(0)">{{$category->name}}</a>
                                                @endforeach
                                            @endif
                                    </span>
                                    </li>
                                @endif
                                @if($project->category_type != 'photo' || $project->category_type != '3D')
                                    @if(isset($project->high_resolution) &&  $project->documentation != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">High Resolution</span><span
                                                    class="w-60 text-muted">

                                        <a href="javascript:void(0)">{{$project->high_resolution}}</a>
                                    </span>
                                        </li>
                                    @endif


                                    @if(isset($project->documentation) &&  $project->documentation != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Documentation</span>
                                            <span class="w-60 text-muted">
                                                <a href="javascript:void(0)">{{$project->documentation}}</a>
                                                      </span>
                                        </li>
                                    @endif
                                @endif

                            <!--    photo            -->
                                @if($project->category_type == 'photo')

                                    @if(isset($project->famous_man) &&  $project->famous_man != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Famous  Man</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->famous_man}}</a>
                                            </span>
                                        </li>
                                    @endif
                                    @if(isset(json_decode($project->files)[0]->size))

                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Size</span>
                                            <span class="w-60 text-muted"><a href="javascript:void(0)">{{ json_decode($project->files)[0]->size }}
                                              </a>
                                              </span>
                                        </li>
                                    @endif

                                    @if(isset(json_decode($project->files)[0]->image_width))

                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Resolution</span>
                                            <span class="w-60 text-muted"><a href="javascript:void(0)">{{ json_decode($project->files)[0]->image_width }}x{{ json_decode($project->files)[0]->image_height }}
                                              </a>
                                              </span>
                                        </li>
                                    @endif
                                    @if(isset(json_decode($project->files)[0]->mime_type))

                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Type</span>
                                            <span class="w-60 text-muted"><a href="javascript:void(0)">{{ str_replace("/" , "" , strstr( json_decode($project->files)[0]->mime_type , "/"))  }}
                                              </a>
                                              </span>
                                        </li>
                                    @endif
                                    @if(isset(json_decode($project->files)[0]->file_code))

                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">File Code</span>
                                            <span class="w-60 text-muted"><a href="javascript:void(0)">#{{json_decode($project->files)[0]->file_code}}</a></span>
                                        </li>
                                    @endif
                                @endif


                                @if($project->category_type == '3D')
                                    @if(isset($project->zip_size) &&  $project->zip_size != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Download Size</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->zip_size}}</a>
                                            </span>
                                        </li>
                                    @endif
                                    @if(isset($project->pbr) &&  $project->pbr != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">PBR</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->pbr}}</a>
                                            </span>
                                        </li>
                                    @endif
                                    @if(isset($project->vertex_colors) &&  $project->vertex_colors != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Vertex Colors</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->vertex_colors}}</a>
                                            </span>
                                        </li>
                                    @endif
                                    @if(isset($project->rigged_geometries) &&  $project->rigged_geometries != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Rigged Geometries</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->rigged_geometries}}</a>
                                            </span>
                                        </li>
                                    @endif
                                    @if(isset($project->uv_layers) &&  $project->uv_layers != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">UV Layers</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->uv_layers}}</a>
                                                      </span>
                                        </li>
                                    @endif
                                    @if(isset($project->scale_transformations) &&  $project->scale_transformations != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Scale Transformations</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->scale_transformations}}</a>
                                                      </span>
                                        </li>
                                    @endif
                                    @if(isset($project->vertices) &&  $project->vertices != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Vertices</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->vertices}}</a>
                                                      </span>
                                        </li>
                                    @endif  @if(isset($project->materials) &&  $project->geometry != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Geometry</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->geometry}}</a>
                                                      </span>
                                        </li>
                                    @endif  @if(isset($project->textures) &&  $project->textures != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Textures</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->textures}}</a>
                                                      </span>
                                        </li>
                                    @endif  @if(isset($project->animations) &&  $project->animations != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Animations</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->animations}}</a>
                                                      </span>
                                        </li>
                                    @endif
                                    @if(isset($project->morph_geometry) &&  $project->morph_geometry != 'undefined')
                                        <li class="pt-2">
                                            <span class="w-40 font-weight-semibold text-dark">Morph Geometry</span><span
                                                    class="w-60 text-muted"><a
                                                        href="javascript:void(0)">{{$project->morph_geometry}}</a>
                                                      </span>
                                        </li>
                                    @endif
                                @endif


                                @if(isset($project->browsers))
                                    <li class="pt-2">
                                        <span class="w-40 font-weight-semibold text-dark">Supported Browsers</span><span
                                                class="w-60 text-muted">
                                        @if(json_decode($project->browsers))
                                                @foreach(json_decode($project->browsers) as $browser)
                                                    <a href="javascript:void(0)">{{$browser->name}}</a>
                                                @endforeach
                                            @endif
                                    </span>
                                    </li>
                                @endif
                                @if(isset($project->layout))
                                    <li class="pt-2">
                                        <span class="w-40 font-weight-semibold text-dark">Layout</span><span
                                                class="w-60 text-muted">
                                        <a href="javascript:void(0)"> {{json_decode($project->layout)->name}}</a>

                                    </span>
                                    </li>
                                @endif
                                @if($project->columns != 0)
                                    <li class="pt-2">
                                        <span class="w-40 font-weight-semibold text-dark">Columns</span>
                                        <span class="w-60 text-muted">
                                        <a href="javascript:void(0)">{{$project->columns == 5 ? 'N/A' : ( $project->columns == 4 ? '4+' : $project->columns)}}</a>
                                          </span>
                                    </li>
                                @endif


                                @if(isset($project->tags))
                                    <li class="pt-2">
                                        <span class="w-40 font-weight-semibold text-dark">Tags</span><span class="w-60 text-muted">
                                        @if(json_decode($project->tags))
                                                @foreach(json_decode($project->tags) as $tag)
                                                    <a href="javascript:void(0)">{{$tag}}</a>
                                                @endforeach
                                            @endif
                                    </span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--Rightside Content-->
        </div>
    </div>
</section>

<!-- Message Modal -->
<div class="modal" id="contact" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Send Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="customername" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="customeremail" placeholder="Email address">
                </div>
                <div class="form-group mb-0">
                    <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Message"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn ripple  btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn ripple  btn-success">Send</button>
            </div>
        </div>
    </div>
</div><!-- /Message Modal -->

<!--Comment Modal -->
<div class="modal reply_comment_modal" id="Comment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleCommentLongTitle">Reply Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-0">
                    <textarea class="form-control" id="reply_comment" name="reply_comment" rows="6" placeholder="Reply Comment"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn ripple  btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn ripple  btn-success reply_btn">Comment</button>
            </div>
        </div>
    </div>
</div><!-- /Comment Modal -->

<!-- Report Modal -->
<div class="modal" id="report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="examplereportLongTitle">Report Abuse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="report-name" placeholder="Enter url">
                </div>
                <div class="form-group">
                    <select name="country" id="select-countries2" class="form-control custom-select">
                        <option value="1" selected>Categories</option>
                        <option value="2">IT Itemsm</option>
                        <option value="3">Identity Theft</option>
                        <option value="4">Online Shopping Fraud</option>
                        <option value="5">Service Providers</option>
                        <option value="6">Phishing</option>
                        <option value="7">Spyware</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="report-email" placeholder="Email address">
                </div>
                <div class="form-group mb-0">
                    <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Message"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn ripple  btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn ripple  btn-success">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="img-container">
                    <img id="image" src="" style="width: 100% !important;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var comment = $('#comment');
    $('.btn_comment').click(function(e) {
        e.preventDefault();
        var id = $(this).parents('.card').attr('id');
        if (comment.val() == '') {
            comment.addClass('is-invalid');
        }

        if (comment.val() != '') {
            loading(1, '#' + id)
            $.ajax({
                url: '/comment-add',
                type: "POST",
                data: {
                    _token: token,
                    project_id: id,
                    comment: comment.val(),
                },
                success: function(response) {
                    console.log(response);
                    if (response.success == true) {
                        loading(0, '#' + id);
                        comment.val('');
                        var output = `<div class="card shadow-none" id="${response.comment.id}">
									<div class="card-body">
										<div class="media mt-0">
											<div id="profileImage" class=" profileImage">
												<img src="${response.comment.profile_image}" class="mr-3 avatar  brround" />
											</div>
											<div class="media-body">
												<div class="d-md-flex align-items-center">
													<h4 class="mb-2">
													${response.comment.user}
													</h4>
													<a href="" class="mx-2 btn btn-danger btn-sm comment_delete">Delete</a>
													<small class="text-muted ml-md-auto"><i class="fe fe-calendar mr-1"></i>		${response.comment.created_at}</small>
												</div>
											</div>
										</div>
										<p class="fs-15  mb-0 mt-3">
										${response.comment.comment}
										</p>
									</div>
								</div>`;

                        $(".comment-list").append(output);
                    }
                }
            });
        }
    });
    comment.keyup(function() {
        if (comment.val() == '') {
            comment.addClass('is-invalid');
        } else {
            comment.removeClass('is-invalid');
        }
    });
    $(".comment_delete").click(function(e) {
        e.preventDefault();
        var id = $(this).parents('.card').attr('id');
        $.ajax({
            url: '/comment-delete',
            type: "POST",
            data: {
                _token: token,
                id: id,
            },
            success: function(response) {
                if (response.success == true) {
                    $('#' + id).fadeOut();
                }
            }
        });

    });

    var id = '{{$id}}';
    $('.btn_review').click(function(e) {
        e.preventDefault();
        var review_comment = $("#review_comment");
        var review_category = $("#review_category");
        var rating_star = $('#rating_star');

        if (rating_star.val() == 0) {
            rating_star.parents('.rating-stars').addClass('text-danger');
        }
        if (review_category.val() == 0) {
            review_category.addClass('is-invalid');
        }

        if (rating_star != 0 && review_category.val() != 0) {
            $.ajax({
                type: "POST",
                url: "/review-submit",
                data: {
                    _token: token,
                    id: id,
                    rating: rating_star.val(),
                    review_category: review_category.val(),
                    review_comment: review_comment.val(),
                },
                success: function(response) {

                    if (response.success == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Success Review',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#review_comment").val('');
                        $("#review_category").val(0);
                        $('#rating_star').next().children().removeClass('is--active');
                        rating_star.parents('.rating-stars').removeClass('text-danger');
                        review_category.removeClass('is-invalid');
                        window.location.reload();
                    }
                }
            });
        }
    });

    $('.reply_modal').click(function() {
        var review_id = $(this).attr('data-review')
        var review_card = $(this).parents('.review_card');
        $('.reply_btn').click(function() {
            var reply_comment = $('#reply_comment');
            if (reply_comment.val() == '') {
                reply_comment.addClass('is-invalid');
            }
            if (review_id != '' && reply_comment.val() != '') {
                $.ajax({
                    type: "POST",
                    url: "/review-submit",
                    data: {
                        _token: token,
                        id: id,
                        review_id: review_id,
                        review_comment: reply_comment.val(),
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Success Review',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.reload();
                            $('.reply_comment_modal').modal('hide');
                            $("#reply_comment").val('');
                            $("#review_category").val(0);
                            $('#reply_comment').removeClass('is-invalid');
                        }
                        if (response.success == false) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'The answer was given a comment',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#reply_comment").val('');
                            $("#review_category").val(0);
                            $('#reply_comment').removeClass('is-invalid');
                        }
                    }
                });
            }
        });
    });

    // $(document).on('click', '.review_list a.page-link', function(event) {
    // 	event.preventDefault();
    // 	var page = $(this).attr('href').split('page=')[1];
    // 	fetch_data(page);
    // });

    // function fetch_data(page) {
    // 	var _token = token;
    // 	$.ajax({
    // 		url: "/review-pagination",
    // 		method: "POST",
    // 		data: {
    // 			_token: _token,
    // 			page: page,
    // 			id: id
    // 		},
    // 		success: function(data) {
    // 			$('.review_list').html(data);
    // 		}
    // 	});
    // }

    var btn_like = $('.btn_like');
    btn_like.click(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var like = parseInt($(this).find('span').text());
        $.ajax({
            type: "POST",
            url: "/like-project",
            data: {
                _token: token,
                project_id: id,
            },
            success: function(response) {
                if (response.success == true) {
                    if (response.status === 0) {
                        btn_like.removeClass('btn-danger').addClass('btn-primary').find('span').text(like - 1);
                    }
                    if (response.status === 1) {
                        btn_like.addClass('btn-danger').removeClass('btn-primary').find('span').text(like + 1);
                    }
                }
            }
        });
    });

    $('.support_btn').click(function(e) {
        e.preventDefault();
        var support_message = $('#support_message');
        if (support_message.val() == '') {
            support_message.addClass('is-invalid');
        }
        if (support_message.val() != '') {
            $.ajax({
                type: "POST",
                url: "/support-message",
                data: {
                    _token: token,
                    id: id,
                    message: support_message.val()
                },
                success: function(response) {
                    if (response.success == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Success send message',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#support_message").val('');
                    }

                }
            })
        }
    })
</script>

<script>
    $('.carousel-item img').click(function() {
        console.log($(this));
        $('#modal').modal('show');
        $('#modal #image').attr('src', $(this).attr('src'));
    });
</script>
@endsection
