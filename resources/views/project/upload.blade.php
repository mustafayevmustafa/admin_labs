@extends('base')

@section('content')
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/tagsinput.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .modal {
        overflow-y: auto !important;
    }
</style>
<div class="side-app">
    <div class="page-header">
        <h4 class="page-title">Upload Project</h4>
    </div>
    <div class="card mb-xl-0">
        <div class="card-body">
            <div class="form-group category_form">
                <label class="form-label text-dark">Category</label>
                <select class="form-control custom-select select2-show-search select2-hidden-accessible" id="first_category" name="first_category">
                    <option value="0">Select</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" data-type="{{$category->type}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-none">
                <div class="form-group">
                    <label class="form-label text-dark">Other Categories</label>
                    <select id="other_categories" class="form-control" name="other_categories[]" multiple="multiple">
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label text-dark">Title</label>
                    <input type="text" class="form-control" id="title">
                </div>
                <div class="form-group">
                    <label class="form-label text-dark">Description</label>
                    <textarea class="form-control content" id="description" name="description" rows="6" placeholder="Text here.."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label text-dark">Tags (Press enter after each word)</label>
                    <input type="text" id="tags" class="form-control" data-role="tagsinput" />
                </div>
                <div class="form-group features_row">
                    <label class="form-label text-dark">Features</label>

                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="morefeatures[]">
                        <div class=" input-group-append">
                            <button class="btn btn-primary feature_btn_add" onclick="features_fields();" type="button">Add</button>
                        </div>
                    </div>
                    <div id="features_fields">

                    </div>
                </div>
                <div class="form-group project_specials">
                    <label class="form-label text-dark">Specials</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="project_specials_key[]" placeholder="Key...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="project_specials_value[]" placeholder="Value...">
                                <div class=" input-group-append">
                                    <button class="btn btn-primary" onclick="project_specials_list();" type="button">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="project_specials_list">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label text-dark">Sale Price</label>
                            <input type="text" class="form-control" name="sale_price" id="sale_price">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label text-dark">Price</label>
                            <input type="text" class="form-control" name="price" id="pricee">
                        </div>
                    </div>

                </div>

                <div class="form-group" id="browsers_row">
                    <label class="form-label text-dark">Supported Browsers</label>
                    <select id="select-Categories3" class="form-control" name="browsers[]" multiple="multiple">
                        @foreach($browsers as $browser)
                        <option value="{{$browser->id}}">{{$browser->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group " id="high_resolution_row">
                    <div class="row">
                        <div class="col-md-3"> <label class="form-label" id="high_resolution">High Resolution</label> </div>
                        <div class="col-md-9">
                            <div class="custom-controls-stacked d-flex justify-content-around">
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input high_resolution" name="high_resolution" value="Yes"> <span class="custom-control-label">Yes</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input high_resolution" name="high_resolution" value="No"> <span class="custom-control-label">No</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input high_resolution" name="high_resolution" value="N/A"> <span class="custom-control-label">N/A</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group " id="documentation_row">
                    <div class="row">
                        <div class="col-md-3"> <label class="form-label">Documentation</label> </div>
                        <div class="col-md-9">
                            <div class="custom-controls-stacked d-flex justify-content-around">
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input documentation" name="documentation" value="Yes"> <span class="custom-control-label">Yes</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input documentation" name="documentation" value="No"> <span class="custom-control-label">No</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input documentation" name="documentation" value="N/A"> <span class="custom-control-label">N/A</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="columns_row">
                    <label class="form-label text-dark">Columns</label>
                    <select id="columns" class="form-control" name="columns">
                        <option value="0">Select</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4+</option>
                        <option value="5">N/A</option>
                    </select>
                </div>
                <div class="form-group" id="layout_row">
                    <label class="form-label text-dark">Layout</label>
                    <select id="layout" class="form-control" name="layout">
                        <option value="0">Select</option>
                        @foreach($layouts as $layout)
                        <option value="{{$layout->id}}">{{$layout->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="compatible_with_row">
                    <label class="form-label text-dark">Compatible With </label>
                    <select id="compatible_with" class="form-control" name="compatible_with" multiple="multiple">
                        @foreach($compatibles as $compatible)
                        <option value="{{$compatible->id}}">{{$compatible->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group demo_url_row">
                    <label class="form-label text-dark">Demo url (website)</label>
                    <input type="text" id="demo_url" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label text-dark">Preview Image</label>
                    <input type="file" id="preview_image" class="preview_image" />

                </div>
                <div class="form-group images_row mt-2">
                    <label class="form-label text-dark">Upload Files(zip,rar,audio(mp3),video(mp4),image)</label>
                    <div class="row image-list">
                        @foreach($files as $file)
                        <div class="col-md-2 mb-1" id="{{ $file->id }}">
                            <div class="card">
                                <img src="{{ $file->file }}" alt="" class="rounded shadow-sm">
                                <button class="btn btn-danger btn-sm btn-block mt-1" style="opacity: .8;">Delete</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <input type="file" style="display: none" name="upload_image" id="upload_image" class="form-control" accept=".png,.jpeg,.jpg" />
                    <button onclick="$(this).prev().click()" class="btn btn-block btn-info">Images Upload</button>
                </div>
                <div class="row preview_file_section mt-2">
                    <div class="col-md-10">
                        <label class="form-label text-dark">Preview File</label>
                        <input type="file" style="display: none" name="preview_file" id="preview_file" class="form-control" accept="audio/*,video/*,.mp4,.mp3" />
                        <button onclick="$(this).prev().click()" class="btn btn-block btn-primary">File Upload</button>
                        <div class="text-small">The first file appears on the Item Page and Search Results</div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="view_file" class="btn btn-primary btn-block mt-5 shadow-none " data-toggle="modal" data-target="#viewFile" disabled>View File</button>
                    </div>
                </div>
                <div class="form-group main_file_row mt-2">
                    <label class="form-label text-dark">Main File(zip,rar)</label>
                    <input type="file" style="display: none" name="main_file" id="main_file" class="form-control" accept=".rar,.zip" />
                    <button onclick="$(this).prev().click()" class="btn btn-block btn-primary">File Upload</button>
                    <div class="text-small">ZIP - All files for buyers, not including preview images</div>
                </div>

                <a href="#" class="btn ripple btn-block btn_send btn-dark">Submit Now</a>
            </div>

        </div>

    </div>
</div>
</div>
<div class="modal fade" id="viewFile" role="dialog" aria-labelledby="viewFileLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewFileLabel">Preview File</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cropmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="image" src="" style="width: 100% !important;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-block" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
<link rel="stylesheet" href="{{asset('css/croppie.css')}}">
<script>
    var category_type = '';
    var project_id = '';
    var category_id = '';
    var other_categories_id = '';
</script>
<script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/2fancy-uploader.js')}}"></script>
<script src="{{asset('assets/plugins/image-tooltip/image-tooltip.js')}}"></script>
<!-- <script src="{{asset('assets/plugins/wysiwyag/jquery.richtext.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/formeditor.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="{{asset('assets/js/tagsinput.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>
<script src="{{asset('js/croppie.js')}}"></script>
<script src="{{asset('js/main_file.js')}}"></script>
<script>
    $('#description').summernote({
        tabsize: 2,
        height: 300
    });
    var feature_btn_add = $(".feature_btn_add");
    var features_row = $(".features_row");
    var feature_number = 1;
    var project_specials_number = 1;

    function features_fields() {
        feature_number++;
        var objTo = document.getElementById("features_fields");
        var divtest = document.createElement("div");
        divtest.setAttribute(
            "class",
            "form-group removeclass" + feature_number
        );
        var rdiv = "removeclass" + feature_number;
        divtest.innerHTML = `<div class="input-group mb-2">
                     <input type="text" class="form-control" name="morefeatures[]">
                     <div class="input-group-append">
                         <button class="btn btn-danger " onclick="remove_features_fields(${feature_number});" type="button">Remove</button>
                     </div>
                 </div>`;
        objTo.prepend(divtest);
    }

    function remove_features_fields(rid) {
        $(".removeclass" + rid).remove();
    }

    function project_specials_list() {
        project_specials_number++;
        console.log(project_specials_number);
        var objTo = document.getElementById("project_specials_list");
        var divtest = document.createElement("div");
        divtest.setAttribute(
            "class",
            "row removeclassspecial" + project_specials_number
        );
        var rdiv = "removeclassspecial" + project_specials_number;
        divtest.innerHTML = `<div class="col-md-6">
                             <div class="input-group mb-2">
                                 <input type="text" class="form-control" name="project_specials_key[]" placeholder="Key...">
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="input-group mb-2">
                                 <input type="text" class="form-control" name="project_specials_value[]" placeholder="Value...">
                                 <div class=" input-group-append">
                                     <button class="btn btn-danger" onclick="remove_project_specials_list(${project_specials_number});" type="button">Remove</button>
                                 </div>
                             </div>
                         </div>`;
        objTo.prepend(divtest);
        console.log(divtest);
    }

    function remove_project_specials_list(rid) {
        $(".removeclassspecial" + rid).remove();
    }
</script>
@endsection
