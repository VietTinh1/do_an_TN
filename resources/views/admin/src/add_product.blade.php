<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm sản phẩm | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Custom Theme files -->
    <link href="{{asset('css/admin/main.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="icon" href="/images/logo_title.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
    <script>
        function readURL(input, thumbimage) {
            if (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#thumbimage").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else { // Sử dụng cho IE
                $("#thumbimage").attr('src', input.value);

            }
            $("#thumbimage").show();
            $('.filename').text($("#uploadfile").val());
            $('.Choicefile').css('background', '#14142B');
            $('.Choicefile').css('cursor', 'default');
            $(".removeimg").show();
            $(".Choicefile").unbind('click');

        }
        $(document).ready(function() {
            $(".Choicefile").bind('click', function() {
                $("#uploadfile").click();

            });
            $(".removeimg").click(function() {
                $("#thumbimage").attr('src', '').hide();
                $("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
                $(".removeimg").hide();
                $(".Choicefile").bind('click', function() {
                    $("#uploadfile").click();
                });
                $('.Choicefile').css('background', '#14142B');
                $('.Choicefile').css('cursor', 'pointer');
                $(".filename").text("");
            });
        })
    </script>
</head>

<body class="app sidebar-mini rtl">
    <style>
        .Choicefile {
            display: block;
            background: #14142B;
            border: 1px solid #fff;
            color: #fff;
            width: 150px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            padding: 5px 0px;
            border-radius: 5px;
            font-weight: 500;
            align-items: center;
            justify-content: center;
        }

        .Choicefile:hover {
            text-decoration: none;
            color: white;
        }

        #uploadfile,
        .removeimg {
            display: none;
        }

        #thumbbox {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .removeimg {
            height: 25px;
            position: absolute;
            background-repeat: no-repeat;
            top: 5px;
            left: 5px;
            background-size: 25px;
            width: 25px;
            /* border: 3px solid red; */
            border-radius: 50%;

        }

        .removeimg::before {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            content: '';
            border: 1px solid red;
            background: red;
            text-align: center;
            display: block;
            margin-top: 11px;
            transform: rotate(45deg);
        }

        .removeimg::after {
            /* color: #FFF; */
            /* background-color: #DC403B; */
            content: '';
            background: red;
            border: 1px solid red;
            text-align: center;
            display: block;
            transform: rotate(-45deg);
            margin-top: -2px;
        }
    </style>
    @include('admin.menu_header')
    <main class="app-content">
        @if(Session()->has('success'))
        <div class="alert alert-success">{{session()->get('success')}}</div>
        @endif
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">Danh sách sản phẩm</li>
                <li class="breadcrumb-item"><a href="#">Thêm sản phẩm</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Tạo mới sản phẩm</h3>
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-folder-plus"></i> Thêm nhà cung cấp</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#adddanhmuc"><i class="fas fa-folder-plus"></i> Thêm danh mục</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#addtinhtrang"><i class="fas fa-folder-plus"></i> Thêm tình trạng</a>
                            </div>
                        </div>
                        <form class="row" method="post" action="{{ route('postAddProduct') }}">
                            @csrf
                            <div class="form-group col-md-3">
                                <label class="control-label">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Loại sản phẩm</label>
                                <select class="form-control" id="exampleSelect1" name="product_type_id" required>
                                    <option value="1">Điện Thoại</option>
                                    <option value="2">Tablet</option>
                                    <option value="3">Laptop</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Nhà sản xuất</label>
                                <select class="form-control" id="exampleSelect1" name="provided_id" required>
                                    <option value="1">Samsung</option>
                                    <option value="2">Apple</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-3">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number" name="amount" required onkeypress="return event.charCode >= 48" min="1">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Giá bán</label>
                                <input class="form-control" type="number" name="price" required onkeypress="return event.charCode >= 48" min="1">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Thuế</label>
                                <input class="form-control" type="number" name="tax" required onkeypress="return event.charCode >= 48" min="0">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Ảnh sản phẩm</label>
                                <div id="myfileupload">
                                    <input type="file" id="uploadfile" name="image" onchange="readURL(this);" />
                                </div>
                                <div id="thumbbox">
                                    <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none" />
                                    <a class="removeimg" href="javascript:"></a>
                                </div>
                                <div id="boxchoice">
                                    <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn ảnh</a>
                                    <p style="clear:both"></p>
                                </div>

                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" name="describe" id="mota"></textarea>
                                <script>
                                    CKEDITOR.replace('mota');
                                </script>
                            </div>

                    </div>
                    <button class="btn btn-save" type="submit">Lưu lại</button>
                    <a class="btn btn-cancel" href="{{route('product')}}">Hủy bỏ</a>
                </div>
            </div>
    </main>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script>
        const inpFile = document.getElementById("inpFile");
        const loadFile = document.getElementById("loadFile");
        const previewContainer = document.getElementById("imagePreview");
        const previewImage = previewContainer.querySelector(".image-preview__image");
        const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");
        inpFile.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";
                reader.addEventListener("load", function() {
                    previewImage.setAttribute("src", this.result);
                });
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>