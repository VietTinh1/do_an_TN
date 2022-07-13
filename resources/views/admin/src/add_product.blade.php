<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm sản phẩm | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="{{asset('css/admin/main.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom Theme files -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="icon" href="/images/logo_title.png" type="image/x-icon">

</head>

<body onload="time()" class="app sidebar-mini rtl">
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
            <div id="clock"></div>
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
                        </div>
                        <form class="row" method="post" action="{{ route('postAddProduct') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-3">
                                <label class="control-label">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name_product" required>
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Loại sản phẩm</label>
                                <select class="form-control" id="exampleSelect1" name="product_type_id" required>
                                    @foreach ($productType as $productType)
                                    <option value="{{ $productType->id }}">{{ $productType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Tên hãng</label>
                                <input class="form-control" type="text" name="trademark" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Mã sản phẩm</label>
                                <input class="form-control" type="text" name="product_code" required>
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
                            <div class="form-group col-md-3">
                                <label class="control-label">Thời gian bảo hành</label>
                                <input class="form-control" type="number" name="time_warranty" required onkeypress="return event.charCode >= 48" min="0">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Khuyến mãi(%)</label>
                                <input class="form-control" type="number" name="sale" required onkeypress="return event.charCode >= 48" min="0">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Công nghệ màn hình</label>
                                <input class="form-control" type="text" name="screen_technology" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Độ phân giải màn hình</label>
                                <input class="form-control" type="text" name="screen_resolution" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Mặt kính cảm ứng</label>
                                <input class="form-control" type="text" name="touch_screen_glass" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Chiều rộng màn hình</label>
                                <input class="form-control" type="text" name="screen_width" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Độ sáng tối đa*(nits)</label>
                                <input class="form-control" type="text" name="screen_maximum_brightness" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label"> Đèn flash</label>
                                <input class="form-control" type="text" name="flash_light" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Hệ điều hành</label>
                                <input class="form-control" type="text" name="operating_system" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Chip(cpu)</label>
                                <input class="form-control" type="text" name="CPU" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Tốc độ chip(cpu)</label>
                                <input class="form-control" type="text" name="speed_cpu" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Chip đồ họa</label>
                                <input class="form-control" type="text" name="GPU" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Ram</label>
                                <input class="form-control" type="number" name="ram" onkeypress="return event.charCode >= 48" min="0" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Rom</label>
                                <input class="form-control" type="number" name="rom" onkeypress="return event.charCode >= 48" min="0" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Bộ nhớ khả dụng</label>
                                <input class="form-control" type="number" name="available_memory" onkeypress="return event.charCode >= 48" min="0" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Thẻ nhớ</label>
                                <input class="form-control" type="text" name="memory_stick" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Mạng di động</label>
                                <input class="form-control" type="text" name="mobile_network" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Sim</label>
                                <input class="form-control" type="text" name="sim" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Danh bạ</label>
                                <input class="form-control" type="text" name="phonebook" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Cổng sạc</label>
                                <input class="form-control" type="text" name="charging_port" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Tai nghe</label>
                                <input class="form-control" type="text" name="headphone" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Kết nối khác</label>
                                <input class="form-control" type="text" name="connection_orther" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Dung lượng pin</label>
                                <input class="form-control" type="text" name="battery_capacity" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Loại pin</label>
                                <input class="form-control" type="text" name="pin_type" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Hỗ trợ sạc pin tối đa</label>
                                <input class="form-control" type="text" name="maximum_battery_charging_support" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Sạc kèm theo máy</label>
                                <input class="form-control" type="text" name="charger_included" required>
                            </div>
                            {{-- // --}}
                            <div class="form-group col-md-3">
                                <label class="control-label">Công nghệ pin</label>
                                <input class="form-control" type="text" name="battery_technology" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Kháng bụi, nước</label>
                                <input class="form-control" type="text" name="water_and_dust_resistant" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Radio</label>
                                <input class="form-control" type="text" name="radio" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Thiết kế</label>
                                <input class="form-control" type="text" name="design" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Chất liệu</label>
                                <input class="form-control" type="text" name="material" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Kích thước, khối lượng</label>
                                <input class="form-control" type="text" name="size_volume" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Ngày tạo</label>
                                <input class="form-control" type="date" name="date_created" required>
                            </div>
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                                <select class="form-control" id="exampleSelect1" name="status" required>
                                    <option value="Đang hoạt động">Đang hoạt động</option>
                                    {{-- <option value="{{ $productType->id }}">Dừng hoạt động</option> --}}
                                    <option value="Chưa hoạt động">Chưa hoạt động</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Bảo mật</label>
                                <select class="form-control product-chosen" multiple name="secutity_type[]" required>
                                    @foreach ($secutity as $secutity)
                                    <option value="{{ $secutity->id }}">{{ $secutity->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tính năng</label>
                                <select class="form-control product-chosen" multiple name="feature_type[]" required>
                                    @foreach ($feature as $feature)
                                    <option value="{{ $feature->id }}">{{ $feature->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Ghi âm</label>
                                <select class="form-control product-chosen" multiple name="record_type[]" required>
                                    @foreach ($record as $record)
                                    <option value="{{ $record->id }}">{{ $record->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Xem phim</label>
                                <select class="form-control product-chosen" multiple name="video_type[]" required>
                                    @foreach ($video as $video)
                                    <option value="{{ $video->id }}">{{ $video->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Nghe nhạc</label>
                                <select class="form-control product-chosen" multiple name="music_type[]" required>
                                    @foreach ($music as $music)
                                    <option value="{{ $music->id }}">{{ $music->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Wjfj</label>
                                <select class="form-control product-chosen" multiple name="wjfj_type[]" required>
                                    @foreach ($wjfj as $wjfj)
                                    <option value="{{ $wjfj->id }}">{{ $wjfj->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Xem phim</label>
                                <select class="form-control product-chosen" multiple name="film_type[]" required>
                                    @foreach ($film as $film)
                                    <option value="{{ $film->id }}">{{ $film->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Định vị</label>
                                <select class="form-control product-chosen" multiple name="gps_type[]" required>
                                    @foreach ($gps as $gps)
                                    <option value="{{ $gps->id }}">{{ $gps->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Bluetooth</label>
                                <select class="form-control product-chosen" multiple name="bluetooth_type[]" required>
                                    @foreach ($bluetooth as $bluetooth)
                                    <option value="{{ $bluetooth->id }}">{{ $bluetooth->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Hình ảnh</label>
<<<<<<< HEAD
                                <input class="form-control" type="file" name="image" >
                                @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
=======
                                <input class="form-control" type="file" name="image">
>>>>>>> 62ba03640dbf861505911b8ddb540fb3866a628e
                            </div>
                    </div>
                    <button class="btn btn-save" type="submit">Lưu lại</button>
                    <a class="btn btn-cancel" href="{{route('product')}}">Hủy bỏ</a>
                </div>
            </div>
    </main>
    <script type="text/javascript" src="{{ URL::asset('js/trieu_add.js') }}"></script>
    <script type="text/javascript"></script>
    <script>
        //Thời Gian
        function time() {
            var today = new Date();
            var weekday = new Array(7);
            weekday[0] = "Chủ Nhật";
            weekday[1] = "Thứ Hai";
            weekday[2] = "Thứ Ba";
            weekday[3] = "Thứ Tư";
            weekday[4] = "Thứ Năm";
            weekday[5] = "Thứ Sáu";
            weekday[6] = "Thứ Bảy";
            var day = weekday[today.getDay()];
            var dd = today.getDate();
            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            nowTime = h + " giờ " + m + " phút " + s + " giây";
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            today = day + ', ' + dd + '/' + mm + '/' + yyyy;
            tmp = '<span class="date"> ' + today + ' - ' + nowTime +
                '</span>';
            document.getElementById("clock").innerHTML = tmp;
            clocktime = setTimeout("time()", "1000", "Javascript");

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
        }