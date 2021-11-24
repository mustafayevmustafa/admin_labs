@extends('base')

@section('content')
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/image-tooltip/image-tooltip.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/tagsinput.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="side-app">

    <!--Page-Header-->
    <div class="page-header">
        <h4 class="page-title">Upload Post</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Upload Post</li>
        </ol>
    </div>
    <!--/Page-Header-->

    <div class="card mb-xl-0">
        <div class="card-body">
            <div class="form-group category_form">
                <label class="form-label text-dark">Category</label>
                <select class="form-control " id="first_category" name="first_category">
                    <option value="0">Select</option>
                    @foreach($categories as $category)
                    <option data-type="{{$category->type}}" @if(isset($project->category_id) && $category->id == $project->category_id) selected @endif value="{{$category->id}}" >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label text-dark">Other Categories</label>
                <select id="other_categories" class="form-control" name="other_categories[]" multiple="multiple">
                </select>
            </div>
            <div class="form-group">
                <label class="form-label text-dark">Title</label>
                <input type="text" class="form-control" id="title" value="{{$id && isset($project->name) ? $project->name : ''}}">
            </div>
            <div class="form-group">
                <label class="form-label text-dark">Description</label>
                <textarea class="form-control content" id="description" name="description" rows="6">{{$id && isset($project->description) ? $project->description : ''}}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label text-dark">Tags</label>
                <input type="text" id="tags" class="form-control" data-role="tagsinput" value="{{$tags}}" />
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
                    @foreach($project_features as $feature)
                    <div class="form-group removeclass{{$feature->id}}" id="{{$feature->id}}">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="morefeatures[]" value="{{$feature->feature}}">
                            <div class="input-group-append">
                                <button class="btn btn-danger" onclick="remove_features_fields({{$feature->id}});" type="button">Remove</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                    @foreach($project_specials as $special)
                    <div class="row removeclassspecial{{$special->id}}" id="{{$special->id}}">
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" value="{{$special->key}}" name="project_specials_key[]" placeholder="Key...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" value="{{$special->value}}" name="project_specials_value[]" placeholder="Value...">
                                <div class=" input-group-append">
                                    <button class="btn btn-danger " onclick="remove_project_specials_list({{$special->id}});" type="button">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label text-dark">Price</label>
                        <input type="text" class="form-control" name="price" id="pricee" value="{{$project->price}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label text-dark">Sale Price</label>
                        <input type="text" class="form-control" name="sale_price" id="sale_price" value="{{$project->sale_price}}">
                    </div>
                </div>
            </div>
            <div class="form-group" id="browsers_row">
                <label class="form-label text-dark">Supported Browsers</label>
                <select id="select-Categories3" class="form-control" name="browsers[]" multiple="multiple">
                    @foreach($browsers as $key=>$browser)
                    <option value="{{$browser->id}}" {{isset($project_browsers[$key]) && $browser->id == $project_browsers[$key]->browser_id ? 'selected' : ''}}>{{$browser->name}}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group " id="high_resolution_row">
                <div class="row">
                    <div class="col-md-3"> <label class="form-label" id="high_resolution">High Resolution</label> </div>
                    <div class="col-md-9">
                        <div class="custom-controls-stacked d-flex justify-content-around">
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input high_resolution" name="high_resolution" value="Yes" {{$project->high_resolution == "Yes" ? 'checked' : '' }}> <span class="custom-control-label">Yes</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input high_resolution" name="high_resolution" value="No" {{$project->high_resolution == "No" ? 'checked' : '' }}> <span class="custom-control-label">No</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input high_resolution" name="high_resolution" value="N/A" {{$project->high_resolution == "N/A" ? 'checked' : '' }}> <span class="custom-control-label">N/A</span>
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
                                <input type="radio" class="custom-control-input documentation" name="documentation" value="Yes" {{$project->documentation == "Yes" ? 'checked' : '' }}> <span class="custom-control-label">Yes</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input documentation" name="documentation" value="No" {{$project->documentation == "No" ? 'checked' : '' }}> <span class="custom-control-label">No</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input documentation" name="documentation" value="N/A" {{$project->documentation == "N/A" ? 'checked' : '' }}> <span class="custom-control-label">N/A</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" id="columns_row">
                <label class="form-label text-dark">Columns</label>
                <select id="columns" class="form-control" name="columns">
                    <option value="0" {{$project->columns == 0 ? 'selected' : ''}}>Select</option>
                    <option value="1" {{$project->columns == 1 ? 'selected' : ''}}>1</option>
                    <option value="2" {{$project->columns == 2 ? 'selected' : ''}}>2</option>
                    <option value="3" {{$project->columns == 3 ? 'selected' : ''}}>3</option>
                    <option value="4" {{$project->columns == 4 ? 'selected' : ''}}>4+</option>
                    <option value="5" {{$project->columns == 5 ? 'selected' : ''}}>N/A</option>
                </select>
            </div>
            <div class="form-group" id="layout_row">
                <label class="form-label text-dark">Layout</label>
                <select id="layout" class="form-control" name="layout">
                    <option value="0">Select</option>
                    @foreach($layouts as $layout)
                    <option value="{{$layout->id}}" {{$project->layout_id == $layout->id ? 'selected' : ''}}>{{$layout->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="compatible_with_row">
                <label class="form-label text-dark">Compatible With </label>

                <select id="compatible_with" class="form-control" name="compatible_with" multiple="multiple">
                    <option value="0">Select</option>
                    @foreach($compatibles as $key=>$compatible)
                    <option value="{{$compatible->id}}" {{isset($project_compatibles[$key]) && $compatible->id == $project_compatibles[$key]->compatible_id ? 'selected' : ''}}>{{$compatible->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <form method="POST" action="/file-upload" accept-charset="UTF-8" enctype="multipart/form-data">
                    <label>Upload Files(zip,rar,audio,video)</label>
                    <input id="files" type="file" name="files" multiple="" class="ff_fileupload_hidden" accept=".jpg,.png,.jpeg,.mp3,.mp4,audio/*,video/*,.zip,.rar,.7zip,zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                    {{-- <div class="text-small">You can include additional images which show off your item. Additional images must be named in the order that you want them to appear, for example, 02_filename.jpg, 03_filename.jpg, 04_filename.jpg.</div> --}}

                    <button type="button" class="btn btn-warning all_upload mt-4 btn-block">Upload all files</button>
                    @if(isset($files) && count($files) )
                    <div class="ff_fileupload_wrap">
                        <table class="ff_fileupload_uploads">
                            @foreach($files as $file)
                            <tr id="{{$file->id}}">
                                <td class="ff_fileupload_preview">
                                    @if($file->mime_type == 'application/x-rar')
                                    <button class="ff_fileupload_preview_image ff_fileupload_preview_text_with_color ff_fileupload_preview_text_r" type="button" disabled="" aria-label="No preview available">rar</button>
                                    @elseif($file->mime_type == 'application/zip')
                                    <button class="ff_fileupload_preview_image ff_fileupload_preview_text_with_color ff_fileupload_preview_text_z" type="button" disabled="" aria-label="No preview available">zip</button>
                                    @elseif($file->mime_type == 'video/mp4')
                                    <button class="ff_fileupload_preview_image ff_fileupload_preview_image_has_preview ff_fileupload_preview_text_with_color ff_fileupload_preview_text_m" type="button" aria-label="Preview">mp4</button>
                                    @elseif($file->mime_type == 'audio/mpeg')
                                    <button class="ff_fileupload_preview_image ff_fileupload_preview_image_has_preview ff_fileupload_preview_text_with_color ff_fileupload_preview_text_m" type="button" aria-label="Preview">mp3</button>
                                    @elseif($file->mime_type != 'application/zip')
                                    <button class="ff_fileupload_preview_image ff_fileupload_preview_image_has_preview" type="button" aria-label="Preview" style="background-image: url({{$file->file}});"><span class="ff_fileupload_preview_text"></span></button>
                                    @endif
                                    <div class="ff_fileupload_actions_mobile"><button class="ff_fileupload_remove_file" type="button" aria-label="Remove from list"></button></div>
                                </td>

                                <td class="ff_fileupload_summary">
                                    <div class="ff_fileupload_filename">{{$file->original_name}}</div>
                                    <div class="ff_fileupload_fileinfo">{{$file->size}}| {{$file->created_at->diffForHumans()}}</div>
                                    <div class="ff_fileupload_buttoninfo ff_fileupload_hidden">Preview</div>
                                    <div class="ff_fileupload_errors ff_fileupload_hidden"></div>
                                    <div class="ff_fileupload_progress_background ff_fileupload_hidden">
                                        <div class="ff_fileupload_progress_bar" style="width: 100%;"></div>
                                    </div>
                                </td>
                                <td class="ff_fileupload_actions"><button class="ff_fileupload_remove_file" type="button" aria-label="Remove from list"></button></td>
                            </tr>
                            <!-- <tr id="{{$file->id}}">
                                    <td class="ff_fileupload_preview">
                                        <button class="ff_fileupload_preview_image ff_fileupload_preview_image_has_preview" type="button" aria-label="Preview" style="background-image: url({{$file->file}});"><span class="ff_fileupload_preview_text"></span></button>
                                        <div class="ff_fileupload_actions_mobile"><button class="ff_fileupload_remove_file" type="button" aria-label="Remove from list"></button></div>
                                    </td>
                                    <td class="ff_fileupload_summary">
                                        <div class="ff_fileupload_filename">{{$file->original_name}}</div>
                                        <div class="ff_fileupload_fileinfo">{{$file->size}}| {{$file->created_at->diffForHumans()}}</div>
                                        <div class="ff_fileupload_buttoninfo ff_fileupload_hidden">Preview</div>
                                        <div class="ff_fileupload_errors ff_fileupload_hidden"></div>
                                        <div class="ff_fileupload_progress_background ff_fileupload_hidden">
                                            <div class="ff_fileupload_progress_bar" style="width: 100%;"></div>
                                        </div>
                                    </td>
                                    <td class="ff_fileupload_actions"><button class="ff_fileupload_remove_file" type="button" aria-label="Remove from list"></button></td>
                                </tr> -->

                            @endforeach
                        </table>
                    </div>
                    @endif
                </form>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <label class="form-label text-dark">Preview Image</label>
                    <select id="preview_image" class="form-control" name="preview_image">
                    </select>
                    <div class="text-small">The first image appears on the Item Page and Search Results and must be 590x300 pixels</div>
                </div>
                <div class="col-md-2">
                    <button type="button" id="view_image" class="btn btn-primary btn-block mt-5 shadow-none " data-toggle="modal" data-target="#viewImage">View image</button>
                </div>
            </div>
            <div class="row preview_file_section">

                <div class="col-md-10">
                    <label class="form-label text-dark">Preview File(audio,video)</label>
                    <select id="preview_file" class="form-control" name="preview_file">
                    </select>
                    <div class="text-small">The first file appears on the Item Page and Search Results</div>
                </div>
                <div class="col-md-2">
                    <button type="button" id="view_file" class="btn btn-primary btn-block mt-5 shadow-none " data-toggle="modal" data-target="#viewFile">View File</button>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label text-dark">Main File(zip,rar)</label>
                <select id="main_file" class="form-control" name="main_file">
                </select>
                <div class="text-small">ZIP - All files for buyers, not including preview images</div>
            </div>
            <div class="form-group demo_url_row">
                <label class="form-label text-dark">Demo url (website)</label>
                <input type="text" id="demo_url" class="form-control">
            </div>
            <div class="custom-controls-stacked">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="" value="option1">
                    <span class="custom-control-label">Any images, sounds, video, code, flash, or other assets that are not my own work, have been appropriately licensed for use in the file preview or main download. Other than these items, this work is entirely my own and I have full rights to sell it on Templist.
                    </span>
                </label>
            </div>
            <a href="#" class="btn ripple btn-block btn_send btn-primary">Submit Now</a>

        </div>
    </div>
</div>
<div class="modal fade" id="viewImage" role="dialog" aria-labelledby="viewImageLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewImageLabel">Preview Image</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <div class="modal-body">
                <img src="" alt="" id="modal_image" class="rounded shadow w-100">
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> </div>
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
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/image-tooltip/image-tooltip.js')}}"></script>
<script src="{{asset('assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
<script src="{{asset('assets/js/formeditor.js')}}"></script>
<script src="{{asset('assets/js/tagsinput.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>


<script>
    var category_form = $(".category_form");
    var project_id = "{{$id}}";
    var cover_id = "{{$project->cover_id}}";
    var file_id = "{{$project->file_id}}";
    var original_file_id = "{{$project->original_file_id}}";
    var category_id = "{{$project->category_id}}";
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
<script src="{{asset('assets/js/uploadedit.js')}}"></script>

@endsection
