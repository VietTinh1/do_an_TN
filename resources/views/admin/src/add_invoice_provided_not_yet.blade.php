<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm hóa đơn | Quản trị Admin</title>
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
                <li class="breadcrumb-item">Danh sách đơn hàng</li>
                <li class="breadcrumb-item"><a href="#">Thêm đơn hàng</a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Tạo mới hóa đơn nhập</h3>
                    <div class="tile-body">
                        <form class="row" method="POST" action="{{ route('postAddInvoiceProvidedNotYet') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Nhà cung cấp</label>
                                <select class="form-control" id="exampleSelect1" name="provided_id" required>
                                    @foreach ($provided as $provided)
                                    <option value="{{ $provided->id }}">{{ $provided->name }}</option>
                                    @endforeach
                                </select>
                                <p class="help is-danger" style="color: red;text-align: center;background-color:rgb(36, 209, 218);margin-top:5px;">{{ $errors->first('provided_id') }}</p>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tên hãng</label>
                                <input class="form-control" type="text" name="trademark" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Loại sản phẩm</label>
                                <select class="form-control" id="exampleSelect1" name="product_type_id" required>
                                    @foreach ($productType as $productType)
                                    <option value="{{ $productType->id }}">{{ $productType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Mã sản phẩm</label>
                                <input class="form-control" type="text" name="product_code" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number" name="amount" onkeypress="return event.charCode >= 48" min="1" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Giá nhập(VND)</label>
                                <input class="form-control" type="number" name="import_price" onkeypress="return event.charCode >= 48" min="1" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Thời gian bảo hành(tháng)</label>
                                <input class="form-control" type="number" name="time_warranty" onkeypress="return event.charCode >= 48" min="1" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Thuế(%)</label>
                                <input class="form-control" type="number" name="tax" onkeypress="return event.charCode >= 48" min="1" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Hình ảnh mặt trước</label>
                                <input class="form-control" type="file" name="front" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Hình ảnh mặt sau</label>
                                <input class="form-control" type="file" name="backside" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Công nghệ màn hình</label>
                                <input class="form-control" type="text" name="screen_technology"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Độ phân giải</label>
                                <input class="form-control" type="text" name="resolution" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Độ rộng</label>
                                <input class="form-control" type="text" name="width" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Độ sáng tối đa(nits)</label>
                                <input class="form-control" type="number" name="maximum_brightness" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Mặt kính cảm ứng</label>
                                <input class="form-control" type="text" name="touch_glass" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Độ phân giải camera trước</label>
                                <input class="form-control" type="number" name="resolution" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tính năng camera trước</label>
                                <select class="form-control product-chosen" multiple name="name_front_camera_feature[]" required>
                                    @foreach ($cameraFeatureType1 as $cameraFeatureType1)
                                    <option value="{{ $cameraFeatureType1->name_classify }}">{{ $cameraFeatureType1->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Độ phân giải camera chính(sau)</label>
                                <input class="form-control" type="number" name="main_rear_camera" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Độ phân giải camera sau 1</label>
                                <input class="form-control" type="number" name="main_secondary_1" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Độ phân giải camera sau 2</label>
                                <input class="form-control" type="number" name="main_secondary_2" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Quay phim</label>
                                <select class="form-control product-chosen" multiple name="film[]" required>
                                    @foreach ($film as $film)
                                    <option value="{{ $film->name_classify }}">{{ $film->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Đèn flash</label>
                                <input class="form-control" type="text" name="flash_light" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tính năng camera sau</label>
                                <select class="form-control product-chosen" multiple name="name_rear_camera_feature[]" required>
                                    @foreach ($cameraFeatureType2 as $cameraFeatureType2)
                                    <option value="{{ $cameraFeatureType2->name_classify }}">{{ $cameraFeatureType2->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Hệ điều hành</label>
                                <input class="form-control" type="text" name="operating_system_name" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tên Cpu</label>
                                <input class="form-control" type="text" name="chip_cpus" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tốc độ CPU</label>
                                <input class="form-control" type="text" name="speed_cpu" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">GPU</label>
                                <input class="form-control" type="text" name="speed_gpu" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Ram</label>
                                <input class="form-control" type="number" name="ram" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Rom</label>
                                <input class="form-control" type="number" name="rom" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Bộ nhớ khả dụng</label>
                                <input class="form-control" type="number" name="memory_available" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Thẻ nhớ</label>
                                <input class="form-control" type="text" name="memory_stick" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Danh bạ</label>
                                <input class="form-control" type="text" name="phone_book" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Mạng di động</label>
                                <input class="form-control" type="text" name="mobile_network" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Sim</label>
                                <input class="form-control" type="text" name="sim" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Bluetooth</label>
                                <select class="form-control product-chosen" type="text" multiple name="name_bluetooth[]" required>
                                    @foreach ($bluetooth as $bluetooth)
<<<<<<< HEAD
                                            <option value="{{ $bluetooth->name_classify }}">{{ $bluetooth->name_classify }}</option>
=======
                                    <option value="{{ $bluetooth->id }}">{{ $bluetooth->name_classify }}</option>
>>>>>>> 16186f58a4364f13f17445e199994c0b1e2846c0
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Cổng sạc</label>
                                <input class="form-control" type="text" name="charging_port" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tai nghe</label>
                                <input class="form-control" type="text" name="head_phone" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Kết nối khác</label>
                                <input class="form-control" type="text" name="connection_orther" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Wjfj</label>
                                <select class="form-control product-chosen" type="text" multiple name="name_wjfj[]" required>
                                    @foreach ($wjfj as $wjfj)
<<<<<<< HEAD
                                            <option value="{{ $wjfj->name_classify }}">{{ $wjfj->name_classify }}</option>
=======
                                    <option value="{{ $wjfj->id }}">{{ $wjfj->name_classify }}</option>
>>>>>>> 16186f58a4364f13f17445e199994c0b1e2846c0
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Định vị(Gps)</label>
                                <select class="form-control product-chosen" type="text" multiple name="name_gps[]" required>
                                    @foreach ($gps as $gps)
<<<<<<< HEAD
                                            <option value="{{ $gps->name_classify }}">{{ $gps->name_classify }}</option>
=======
                                    <option value="{{ $gps->id }}">{{ $gps->name_classify }}</option>
>>>>>>> 16186f58a4364f13f17445e199994c0b1e2846c0
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Dung lượng pin</label>
                                <input class="form-control" type="text" name="memory_pin" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Loại pin</label>
                                <input class="form-control" type="text" name="pin_type" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Hỗ trợ sạc tối đa</label>
                                <input class="form-control" type="text" name="support_pin_max" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Sạc kèm theo máy</label>
                                <input class="form-control" type="text" name="charger" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Công nghệ pin</label>
                                <input class="form-control" type="text" name="technology_pin"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Kháng nước, bụi</label>
                                <input class="form-control" type="text" name="waterproof_dustproof" onkeypress="return event.charCode >= 48" min="1"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Radio</label>
                                <input class="form-control" type="text" name="radio" required></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Bảo mật nâng cao</label>
                                <select class="form-control product-chosen" type="number" multiple name="security_advance_type[]" required>
                                    @foreach ($security as $security)
<<<<<<< HEAD
                                            <option value="{{ $security->name_classify }}">{{ $security->name_classify }}</option>
=======
                                    <option value="{{ $security->id }}">{{ $security->name_classify }}</option>
>>>>>>> 16186f58a4364f13f17445e199994c0b1e2846c0
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tính năng đặc biệt</label>
                                <select class="form-control product-chosen" type="number" multiple name="feature_advance[]" required>
                                    @foreach ($feature as $feature)
                                    <option value="{{ $feature->name_classify }}">{{ $feature->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Ghi âm</label>
                                <select class="form-control product-chosen" type="number" multiple name="record_type[]" required>
                                    @foreach ($record as $record)
                                    <option value="{{ $record->name_classify }}">{{ $record->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Xem phim</label>
                                <select class="form-control product-chosen" type="number" multiple name="video_type[]" required>
                                    @foreach ($video as $video)
                                    <option value="{{ $video->name_classify }}">{{ $video->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Nghe nhạc</label>
                                <select class="form-control product-chosen" type="number" multiple name="music_type[]" required>
                                    @foreach ($music as $music)
                                    <option value="{{ $music->name_classify }}">{{ $music->name_classify }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Thiết kế</label>
                                <input class="form-control" type="text" name="design"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Chất liệu</label>
                                <input class="form-control" type="text" name="material"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Kích thước khối lượng</label>
                                <input class="form-control" type="text" name="size_mass"></input>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Ngày ra mắt</label>
                                <input class="form-control" type="date" name="date" required></input>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                                <select class="form-control" id="exampleSelect1" name="status" required>
                                    {{-- <option value="Đang xử lí">Đang xử lí</option> --}}
                                    <option value="Đã xử lí">Đã xử lí</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <button class="btn btn-save" type="submit" style="margin-bottom: 13%;">Lưu lại</button>
                                <a class="btn btn-cancel" style="position: absolute;bottom: 36px;left: 105px;" href="{{ route('invoiceProvided') }}">Hủy bỏ</a>
                            </div>
                        </form>
                    </div>
                </div>
    </main>
    <script type="text/javascript" src="{{ URL::asset('js/trieu_add.js') }}"></script>
    <script type="text/javascript">
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
        $(".product-chosen").chosen({
            no_results_text: "Không tìm thấy dữ liệu!",
        })
    </script>
</body>

</html>
