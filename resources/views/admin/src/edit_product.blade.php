<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách sản phẩm | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="{{asset('css/admin/main.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom Theme files -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="icon" href="/images/logo_title.png" type="image/x-icon">
</head>
<body onload="time()" class="app sidebar-mini rtl">
    @include('admin.menu_header')
    <main class="app-content">
        @if(Session()->has('success'))
        <div class="alert alert-success">{{session()->get('success')}}</div>
        @endif
        <form action="{{ route('postEditProduct',['id'=>$product[0]->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @foreach ($product as $product)
                <?php $temp=$product->configuration;?>
                <div class="form-group  col-md-4">
                    <label class="control-label">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" value="{{ $product->name }}" required>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Tên hãng</label>
                    <input class="form-control" type="text" name="trademark" value="{{ $product->trademark }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleSelect1" class="control-label">Loại sản phẩm</label>
                    <input class="form-control" type="text" name="product_type_id" value="{{ $product->product_type_id }}" readonly>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Mã sản phẩm</label>

                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Số lượng</label>
                    <input class="form-control" type="number" name="amount" value="{{ $product->amount }}" onkeypress="return event.charCode >= 48" min="1" required>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Giá nhập(VND)</label>
                    <input class="form-control" type="number" name="import_price" value="{{ $product->import_price }}" onkeypress="return event.charCode >= 48" min="1" required>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Thời gian bảo hành(tháng)</label>
                    <input class="form-control" type="number" name="time_warranty" value="{{ $product->time_warranty }}" onkeypress="return event.charCode >= 48" min="1" required>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Thuế(%)</label>
                    <input class="form-control" type="number" name="tax" value="{{ $product->tax }}" onkeypress="return event.charCode >= 48" min="1" required>
                </div>
                @foreach($temp->imageDetail as $imageDetail)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Hình ảnh mặt trước</label>
                        <input class="form-control" type="file" name="front" required>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Hình ảnh mặt sau</label>
                        <input class="form-control" type="file" name="backside" required>
                    </div>
                @endforeach
            @endforeach

            {{--


            <div class="form-group  col-md-4">
                <label class="control-label">Công nghệ màn hình</label>
                <input class="form-control" type="text" name="screen_technology" value="{{ $product[0]['configuration']['screen'][0]->screen_technology }}" required>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Độ phân giải</label>
                <input class="form-control" type="text" name="resolution" value="{{ $product[0]['configuration']['screen'][0]->resolution }}" required>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Độ rộng</label>
                <input class="form-control" type="text" name="width" value="{{ $product[0]['configuration']['screen'][0]->width }}"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Độ sáng tối đa(nits)</label>
                <input class="form-control" type="number" name="maximum_brightness" value="{{ $product[0]['configuration']['screen'][0]->maximum_brightness }}" onkeypress="return event.charCode >= 48" min="1">
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Mặt kính cảm ứng</label>
                <input class="form-control" type="text" name="touch_glass" value="{{ $product[0]['configuration']['screen'][0]->touch_glass }}" required>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Độ phân giải camera trước</label>
                <input class="form-control" type="text" name="resolution" value="{{ $product[0]['configuration']['front_cameras'][0]->resolution }}" onkeypress="return event.charCode >= 48" min="1"></input>
            </div> --}}
            {{-- <div class="form-group  col-md-4">
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
                <input class="form-control" type="text" name="operating_system_name"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Tên Cpu</label>
                <input class="form-control" type="text" name="chip_cpus"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Tốc độ CPU</label>
                <input class="form-control" type="text" name="speed_cpu"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">GPU</label>
                <input class="form-control" type="text" name="speed_gpu"></input>
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
                <input class="form-control" type="text" name="phone_book"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Mạng di động</label>
                <input class="form-control" type="text" name="mobile_network"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Sim</label>
                <input class="form-control" type="text" name="sim"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Bluetooth</label>
                <select class="form-control product-chosen" type="text" multiple name="name_bluetooth[]" required>
                    @foreach ($bluetooth as $bluetooth)
                    <option value="{{ $bluetooth->name_classify }}">{{ $bluetooth->name_classify }}</option>

                    <option value="{{ $bluetooth->id }}">{{ $bluetooth->name_classify }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Cổng sạc</label>
                <input class="form-control" type="text" name="charging_port"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Tai nghe</label>
                <input class="form-control" type="text" name="head_phone"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Kết nối khác</label>
                <input class="form-control" type="text" name="connection_orther"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Wifi</label>
                <select class="form-control product-chosen" type="text" multiple name="name_wjfj[]" required>
                    @foreach ($wjfj as $wjfj)
                    <option value="{{ $wjfj->name_classify }}">{{ $wjfj->name_classify }}</option>

                    <option value="{{ $wjfj->id }}">{{ $wjfj->name_classify }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Định vị(Gps)</label>
                <select class="form-control product-chosen" type="text" multiple name="name_gps[]" required>
                    @foreach ($gps as $gps)
                    <option value="{{ $gps->name_classify }}">{{ $gps->name_classify }}</option>

                    <option value="{{ $gps->id }}">{{ $gps->name_classify }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Dung lượng pin</label>
                <input class="form-control" type="text" name="memory_pin"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Loại pin</label>
                <input class="form-control" type="text" name="pin_type"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Hỗ trợ sạc tối đa</label>
                <input class="form-control" type="text" name="support_pin_max"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Sạc kèm theo máy</label>
                <input class="form-control" type="text" name="charger"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Công nghệ pin</label>
                <input class="form-control" type="text" name="technology_pin"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Kháng nước, bụi</label>
                <input class="form-control" type="text" name="waterproof_dustproof"></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Radio</label>
                <input class="form-control" type="text" name="radio" required></input>
            </div>
            <div class="form-group  col-md-4">
                <label class="control-label">Bảo mật nâng cao</label>
                <select class="form-control product-chosen" type="number" multiple name="security_advance_type[]" required>
                    @foreach ($security as $security)
                    <option value="{{ $security->name_classify }}">{{ $security->name_classify }}</option>

                    <option value="{{ $security->id }}">{{ $security->name_classify }}</option>

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
                    {{-- <option value="Đã xử lí">Đã xử lí</option>
                </select>
            </div> --}}
                <BR>
                <BR>
                <BR>
                <button class="btn btn-save" type="submit">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="{{route('product')}}">Hủy bỏ</a>

        </form>
        <BR>
        </div>
    </main>
    <script type="text/javascript" src="{{ URL::asset('js/trieu_add.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
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
    </script>

</body>

</html>
