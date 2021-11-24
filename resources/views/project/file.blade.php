@extends('base')

@section('content')
<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/image-tooltip/image-tooltip.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/tagsinput.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet" />


<!-- fonts -->
<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link href="https://innostudio.de/fileuploader/css/font-fileuploader.css" rel="stylesheet">


<!-- styles -->
<link href="https://innostudio.de/fileuploader/css/script.css" media="all" rel="stylesheet">
<style>
    /* input */
    .fileuploader-theme-dropin .fileuploader-input {
        margin: -16px;
        padding: 16px;
        border: 0;
    }

    .fileuploader-theme-dropin .fileuploader-input.fileuploader-dragging {
        background: #f3f5fa;
        border-radius: 6px;
    }

    .fileuploader-theme-dropin .fileuploader-input-inner {
        width: 100%;
        text-align: center;
        padding: 16px;
        color: #5b5b7b;
    }

    .fileuploader-theme-dropin .fileuploader-input-inner span {
        display: inline-block;
        text-decoration: underline;
    }

    .fileuploader-theme-dropin .fileuploader-input-inner span:hover {
        color: #4a4a64;
    }

    .fileuploader-item-image img {
        background-color: transparent !important;
    }

    .ldBar-label {
        text-align: center;
        font-size: 20px;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('loading-bar.css')}}" />
<script type="text/javascript" src="{{asset('loading-bar.js')}}"></script>
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

            <div id="images_form">
                <div class="fileuploader fileuploader-theme-dropin">
                    <input type="file" multiple name="choose-file" class="d-none" />
                    <input type="file" multiple name="choose-folder" webkitdirectory directory multiple class="d-none" />
                    <div class="fileuploader-input">
                        <div class="fileuploader-input-inner">
                            <div>
                                <span id="file">Browse Files</span> or
                                <span id="folder">Browse Folder</span>
                            </div>
                        </div>
                    </div>
                    <div class="fileuploader-items">

                        <ul class="fileuploader-items-list">
                        </ul>

                    </div>
                </div>

                <div class="form-status"></div>
                <input type="submit" id="send_btn">
            </div>

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
    let files = [];
    let folders = [];
    let allFilesSize = 0;
    let currentLoadedFileSize = 0;
    let lastLoadedFileSize = 0;
    let cursor = 0;
    let transferId = 0;
    let _continue = false;
    var inFolderFile = 0;
    let calculateSize = (byte) => {
        if (byte < 100) return byte + " b";
        else if (byte <= 1024)
            return (byte / 1024).toFixed(2) + " kb";
        else if (byte <= 1024 * 1024)
            return parseInt(byte / 1024) + " kb";
        else if (byte <= 1024 * 1024 * 1024)
            return parseInt(byte / (1024 * 1024)) + " mb";
        else if (byte <= 1024 * 1024 * 1024 * 1024)
            return parseInt(byte / (1024 * 1024 * 1024)) + " gb";
    };
    $("#file").click(function() {
        $('input[name="choose-file"]').click();
    });
    $("#folder").click(function() {
        $('input[name="choose-folder"]').click();
    });
    $('input[name="choose-folder"]').change(function() {
        let selectedFiles = $(this)[0].files;
        const fileElement = $(".fileuploader-items-list");
        let folder = "";
        let folderId = -1;
        let folder_each_file_length = selectedFiles.length;
        Object.keys(selectedFiles).forEach((item) => {
            if (selectedFiles[item].webkitRelativePath != "") {
                folder = selectedFiles[item].webkitRelativePath.substring(
                    0,
                    selectedFiles[item].webkitRelativePath.indexOf("/")
                );
                folderId = folders.indexOf(folder);
                if (folderId == -1) {
                    folders.push(folder);
                    folderId = folders.length - 1;
                    fileElement.append(`<li class="fileuploader-item file-type-image file-ext-png file-has-popup" id=${folderId} data-type="folder">
                                <div class="columns">
                                    <div class="column-thumbnail">
                                        <div class="fileuploader-item-image">
                                        <img src="{{asset('folder.svg')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="column-title">
                                        <div>${folder}</div><span>${folder_each_file_length} items</span>
                                    </div>
                                    <div class="column-actions"><button type="button" class="fileuploader-action fileuploader-action-remove" onclick="removeItem($(this))" ><i class="fe fe-x"></i></button></div>
                                </div>
                                <div class="progress-bar2">
                                    <div class="fileuploader-progressbar">
                                        <div class="bar"></div>
                                    </div><span></span>
                                </div>
                            </li>`);
                }
                files.push({
                    folder: folderId,
                    path: selectedFiles[item].webkitRelativePath.substring(
                        0,
                        selectedFiles[item].webkitRelativePath.lastIndexOf("/")
                    ),
                    file: selectedFiles[item],
                });
                allFilesSize += selectedFiles[item]["size"];
            } else {
                files.push({
                    folder: -1,
                    path: "",
                    file: selectedFiles[item],
                });
                allFilesSize += selectedFiles[item]["size"];
                fileElement.append(`
           <li data-file-id="${files.length - 1}" data-type="file">
                         <div class="file-system-entry" role="gridcell" tabindex="0">
                           <div class="file-system-entry__header">
                             <div class="poptip">
                               <h6 class="file-system-entry__title">
                                ${selectedFiles[item]["name"]}
                               </h6>
                             </div>
                             <div class="file-system-entry__details">
                               <span class="file-system-entry__detail">${calculateSize(
                                   selectedFiles[item]["size"]
                               )} </span><span class="file-system-entry__detail">${
                selectedFiles[item]["type"]
            }</span>
                             </div>
                             <div class="file-system-entry__actions">
                               <div onclick="removeItem($(this))" class="filelist__action filelist__action--delete" data-item-name="logo-footer.png" data-item-type="file">
                                 <svg viewBox="-1 -1 16 16">
                                   <path fill="#797C7F" fill-rule="evenodd" d="M7 5.586L4.738 3.324c-.315-.315-.822-.31-1.136.003l-.186.186c-.315.315-.317.824-.004 1.137l2.262 2.262-2.35 2.35c-.315.315-.31.822.003 1.136l.186.186c.315.315.824.317 1.137.004L7 8.238l2.35 2.35c.315.315.822.31 1.137-.004l.186-.186c.314-.314.316-.823.003-1.136l-2.35-2.35 2.262-2.262c.315-.315.31-.822-.004-1.137l-.186-.186c-.314-.314-.823-.316-1.136-.003L7 5.586z"></path>
                                 </svg>
                               </div>
                             </div>
                           </div>
                         </div>
                       </li>
               `);
            }
        });

    });
    $('input[name="choose-file"]').change(function() {
        let selectedFiles = $(this)[0].files;
        const fileElement = $(".fileuploader-items-list");
        let folder = "";
        let folderId = -1;
        Object.keys(selectedFiles).forEach((item) => {
            files.push({
                folder: -1,
                path: "",
                file: selectedFiles[item],
            });
            allFilesSize += selectedFiles[item]["size"];

            function readURL(input) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    fileElement.append(`<li class="fileuploader-item file-type-image file-ext-png file-has-popup" id=${folderId}                        data-file-id="${files.length - 1}" data-type="file">
                                <div class="columns">
                                    <div class="column-thumbnail">
                                        <div class="fileuploader-item-image">
                                        ${
                                            input.type != 'image/png' && input.type == 'image/jpeg'  ?
                                            `<img src="${e.target.result}" alt="">` :
                                            (input.type != 'image/jpeg' && input.type == 'image/png' ? `<img src="${e.target.result}" alt="">` :  `<img src="{{asset('file.svg')}}"/>`) }
                                        </div>
                                    </div>
                                    <div class="column-title">
                                        <div>${selectedFiles[item]["name"]}</div><span>${calculateSize(selectedFiles[item]["size"])} ${selectedFiles[item]["type"]}</span>

                                    </div>
                                    <div class="column-actions"><button type="button" class="fileuploader-action fileuploader-action-remove" onclick="removeItem($(this))" ><i class="fe fe-x"></i></button></div>
                                </div>
                                <div class="progress-bar2">
                                    <div class="fileuploader-progressbar">
                                        <div class="bar"></div>
                                    </div><span></span>
                                </div>
                                        </li>
                                    `);
                }
                reader.readAsDataURL(input); // convert to base64 string
            }
            readURL(selectedFiles[item]);
        });
    });
    let removeItem = (_this) => {
        if ($(_this).parents("li").attr("data-type") == "folder") {
            const id = $(_this).parents("li").attr("data-folder-id");
            $(_this).parents("li").remove();
            delete folders[id];
            files.forEach((item, key) => {
                if (item.folder == id) {
                    allFilesSize -= item["file"]["size"];
                    delete files[key];
                }
            });
        } else {
            const id = $(_this).parents("li").attr("data-file-id");
            $(_this).parents("li").remove();
            allFilesSize -= files[id]["file"]["size"];
            delete files[id];
        }
    };


    $("#send_btn").click(function(e) {
        e.preventDefault();
        sendFile();
        var output = `<div class="progress progress-md">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger">0%</div>
        </div>`;
        $(".fileuploader-items").html(output);
    });
    var fileCount = 0;
    let sendFile = () => {
        loading(1, '#body');
        uploadStarted = true;
        if (fileCount === 0) fileCount = files.length;
        if (cursor === fileCount) {
            $.post(
                "/web-send-finish", {
                    id: transferId,
                },
                (response) => {
                    if (response.status == "success") {
                        setTimeout(function() {
                            $('.fileuploader-items').text('Uploading');
                            setTimeout(function() {
                                link(response.key, response.type);
                            }, 100);
                        }, 100);
                    }
                }
            );
            return;
        }
        if (!files[cursor]) {
            ++cursor;
            sendFile();
            return;
        }
        let formData = new FormData();
        formData.append("id", transferId);
        formData.append("path", files[cursor].path);
        formData.append("filess", files[cursor].file);

        const currentFileSize = files[cursor].file["size"];

        $.ajax({
            url: "/web-send-file",
            type: "POST",
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            data: formData,
            success: function(data) {
                if (data.status == true) {
                    lastLoadedFileSize += currentFileSize;
                    ++cursor;
                    setPercentage(
                        parseInt((lastLoadedFileSize * 100) / allFilesSize)
                    );
                    setTimeout(() => {
                        sendFile();
                    }, 80);
                }
            },
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener(
                    "progress",
                    function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete =
                                (evt.loaded * 100) / allFilesSize +
                                (lastLoadedFileSize * 100) / allFilesSize;
                            setPercentage(parseInt(percentComplete));
                        }
                    },
                    false
                );

                return xhr;
            },
            error: function(response, status, e) {

            },
        });
    };

    let setPercentage = (percentComplete) => {
        if (!isNaN(percentComplete)) {
            // percentComplete = percentComplete > 100 ? 100 : percentComplete;
            $(".progress-bar").text(percentComplete + "%");
            $(".progress-bar").css('width', percentComplete + "%");
        }
    };

    function traverseFileTree(item, path, folderId = -1) {
        path = path || "";

        if (item.isFile) {
            item.file(function(file) {
                files.push({
                    folder: folderId,
                    path: path === "" ? "/" : path,
                    file: file,
                });
                allFilesSize += file["size"];
            });
        } else if (item.isDirectory) {
            var dirReader = item.createReader();
            dirReader.readEntries(function(entries) {
                inFolderFile = entries.length;
                for (var i = 0; i < entries.length; i++) {
                    traverseFileTree(entries[i], path + item.name + "/", folderId);
                }
            });
        }
    }

    document.getElementById("images_form").addEventListener(
        "drop",
        function(event) {
            event.preventDefault();
            var items = event.dataTransfer.items;
            const fileElement = $(".fileuploader-items-list");
            folderSizes = [];
            for (var i = 0; i < items.length; i++) {
                var item = items[i].webkitGetAsEntry();

                if (item) {
                    if (item.isFile) {
                        item.file(function(file) {
                            files.push({
                                folder: -1,
                                path: "",
                                file: file,
                            });
                            allFilesSize += file["size"];

                            function readURL(input) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    fileElement.append(`<li class="fileuploader-item file-type-image file-ext-png file-has-popup" data-file-id="${files.length - 1}" data-type="file">
                                <div class="columns">
                                    <div class="column-thumbnail">
                                        <div class="fileuploader-item-image">
                                        ${
                                            input.type != 'image/png' && input.type == 'image/jpeg'  ?
                                            `<img src="${e.target.result}" alt="">` :
                                            (input.type != 'image/jpeg' && input.type == 'image/png' ? `<img src="${e.target.result}" alt="">` :  `<img src="{{asset('file.svg')}}"/>`) }
                                        </div>
                                    </div>
                                    <div class="column-title">
                                        <div>${file["name"]}</div><span>${calculateSize(file["size"])} ${file["type"]}</span>

                                    </div>
                                    <div class="column-actions"><button type="button" class="fileuploader-action fileuploader-action-remove" onclick="removeItem($(this))" ><i class="fe fe-x"></i></button></div>
                                </div>
                                <div class="progress-bar2">
                                    <div class="fileuploader-progressbar">
                                        <div class="bar"></div>
                                    </div><span></span>
                                </div>
                                        </li>
                                    `);
                                }
                                reader.readAsDataURL(input); // convert to base64 string
                            }
                            readURL(file);
                        });

                    } else if (item.isDirectory) {
                        if (folders.indexOf(item["name"]) === -1) {
                            folders.push(item["name"]);
                            folderSizes.push(0);
                            traverseFileTree(item, null);
                            id = folders.length - 1;
                            setTimeout(function() {
                                fileElement.append(`<li class="fileuploader-item file-type-image file-ext-png file-has-popup" id="${id}" data-type="folder">
                                <div class="columns">
                                    <div class="column-thumbnail">
                                        <div class="fileuploader-item-image">
                                        <img src="{{asset('folder.svg')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="column-title">
                                        <div>${item["name"]}</div><span>${inFolderFile} items</span>
                                    </div>
                                    <div class="column-actions"><button type="button" class="fileuploader-action fileuploader-action-remove" onclick="removeItem($(this))" ><i class="fe fe-x"></i></button></div>
                                </div>
                                <div class="progress-bar2">
                                    <div class="fileuploader-progressbar">
                                        <div class="bar"></div>
                                    </div><span></span>
                                </div>
                            </li>`);
                            }, 80)
                        }
                    }
                }
            }
            $("#images_form>div").css("background", "#F3F7FE");
        },
        false
    );

    let link = (key, type = 2) => {
        loading(0, 'body');
    }

    $("#images_form")
        .on("drag dragstart dragend dragover dragenter dragleave drop", function(
            e
        ) {
            e.preventDefault();
            e.stopPropagation();
        })
        .on("dragover dragenter", function() {
            if ($("#images_form>div")[0].style.backgroundColor == "rgb(243, 243, 243)")
                return false;
            $("#images_form>div").css("background", "#F3F7FE");
        })
        .on("dragend drop", function(e) {
            $("#images_form>div").css("background", "#F3F7FE");
        })
        .on("dragleave", function() {
            $("#images_form>div").css("background", "#F3F7FE");
        });

    let folderSizes = [];
</script>

@endsection
