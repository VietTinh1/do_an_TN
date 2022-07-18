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
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-excel btn-sm" href="{{ route('exportProduct') }}" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" href="{{ route('addProduct') }}" title="In">Thêm sản phẩm</a>
                            </div>
                        </div>
                        <form action="{{ route('postEditProduct',['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row col-md-12">
                                <div class="form-group col-md-3">
                                    <label class="control-label">Tên hãng điện thoại</label>
                                    <input class="form-control" type="text" name="trademark" value="{{ $product->trademark }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Tên sản phẩm</label>
                                    <input class="form-control" type="text" name="name_product" value="{{ $product->name_product }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Mã sản phẩm</label>
                                    <input class="form-control" type="text" name="product_code" value="{{ $product->product_code }}" required>
                                </div>
                                <div class="form-group  col-md-3">
                                    <label class="control-label">Số lượng</label>
                                    <input class="form-control" type="number" name="amount" value="{{ $product->amount }}" required onkeypress="return event.charCode >= 48" min="1">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Giá bán</label>
                                    <input class="form-control" type="number" name="price" value="{{ $product->price }}" required onkeypress="return event.charCode >= 48" min="1">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Thuế</label>
                                    <input class="form-control" type="number" name="tax" value="{{ $product->tax }}" required onkeypress="return event.charCode >= 48" min="0">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Thời gian bảo hành</label>
                                    <input class="form-control" type="number" name="time_warranty" value="{{ $product->time_warranty }}" required onkeypress="return event.charCode >= 48" min="0">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Khuyến mãi(%)</label>
                                    <input class="form-control" type="number" name="sale"  value="{{ $product->sale }}" required onkeypress="return event.charCode >= 48" min="0">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Công nghệ màn hình</label>
                                    <input class="form-control" type="text" name="screen_technology" value="{{ $product->screen_technology }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Độ phân giải màn hình</label>
                                    <input class="form-control" type="text" name="screen_resolution" value="{{ $product->screen_resolution }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Mặt kính cảm ứng</label>
                                    <input class="form-control" type="text" name="touch_screen_glass" value="{{ $product->touch_screen_glass }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Chiều rộng màn hình</label>
                                    <input class="form-control" type="text" name="screen_width" value="{{ $product->screen_width }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Độ sáng tối đa*(nits)</label>
                                    <input class="form-control" type="text" name="screen_maximum_brightness" value="{{ $product->screen_maximum_brightness }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Đèn</label>
                                    <input class="form-control" type="text" name="flash_light" value="{{ $product->flash_light }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Hệ điều hành</label>
                                    <input class="form-control" type="text" name="operating_system" value="{{ $product->operating_system }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Chip(cpu)</label>
                                    <input class="form-control" type="text" name="CPU" value="{{ $product->CPU }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Tốc độ chip(cpu)</label>
                                    <input class="form-control" type="text" name="speed_cpu" value="{{ $product->speed_cpu }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Chip đồ họa</label>
                                    <input class="form-control" type="text" name="GPU" value="{{ $product->GPU }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Ram</label>
                                    <input class="form-control" type="number" name="GPU" value="{{ $product->GPU }}" onkeypress="return event.charCode >= 48" min="0" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Rom</label>
                                    <input class="form-control" type="number" name="rom" value="{{ $product->rom }}" onkeypress="return event.charCode >= 48" min="0" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Bộ nhớ khả dụng</label>
                                    <input class="form-control" type="number" name="available_memory" value="{{ $product->available_memory }}" onkeypress="return event.charCode >= 48" min="0" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Thẻ nhớ</label>
                                    <input class="form-control" type="text" name="memory_stick" value="{{ $product->memory_stick }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Mạng di động</label>
                                    <input class="form-control" type="text" name="mobile_network" value="{{ $product->mobile_network }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Sim</label>
                                    <input class="form-control" type="text" name="sim" value="{{ $product->sim }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Danh bạ</label>
                                    <input class="form-control" type="text" name="phonebook" value="{{ $product->phonebook }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Cổng sạc</label>
                                    <input class="form-control" type="text" name="charging_port" value="{{ $product->charging_port }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Tai nghe</label>
                                    <input class="form-control" type="text" name="headphone" value="{{ $product->headphone }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Kết nối khác</label>
                                    <input class="form-control" type="text" name="connection_orther" value="{{ $product->connection_orther }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Dung lượng pin</label>
                                    <input class="form-control" type="text" name="battery_capacity" value="{{ $product->battery_capacity }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Loại pin</label>
                                    <input class="form-control" type="text" name="pin_type" value="{{ $product->pin_type }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Hỗ trợ sạc pin tối đa</label>
                                    <input class="form-control" type="text" name="maximum_battery_charging_support" value="{{ $product->maximum_battery_charging_support }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Sạc kèm theo máy</label>
                                    <input class="form-control" type="text" name="charger_included" value="{{ $product->charger_included }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Công nghệ pin</label>
                                    <input class="form-control" type="text" name="battery_technology" value="{{ $product->battery_technology }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Kháng bụi, nước</label>
                                    <input class="form-control" type="text" name="water_and_dust_resistant" value="{{ $product->water_and_dust_resistant }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Radio</label>
                                    <input class="form-control" type="text" name="radio" value="{{ $product->radio }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Thiết kế</label>
                                    <input class="form-control" type="text" name="design" value="{{ $product->design }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Chất liệu</label>
                                    <input class="form-control" type="text" name="material" value="{{ $product->material }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Kích thước, khối lượng</label>
                                    <input class="form-control" type="text" name="size_volume" value="{{ $product->size_volume }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Ngày tạo</label>
                                    <input class="form-control" type="date" name="date_created" value="{{ $product->date_created }}" required>
                                </div>
                            </div>
                            <div>
                                <label class="control-label">Hình ảnh</label>
                                <div class="row col-md-12">
                                    @foreach ($product->ImageDetail as $image)
                                        <div class="form-group col-md-6">
                                            @if (!empty($image->image_main))
                                            <img src="{{ url('storage/images/'.$image->image_main) }}" alt="" title="" width="300px" />
                                            @endif
                                            @if (!empty($image->image))
                                            <img src="{{ url('storage/images/'.$image->image) }}" alt="" title="" width="300px" />
                                            @endif
                                            @if (!empty($image->slider))
                                            <img src="{{ url('storage/images/'.$image->slider) }}" alt="" title="" width="300px" />
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            @if (!empty($image->image_main))
                                            <label for="#">Thay đổi hình ảnh(Không bắt buộc)</label>
                                            <input class="form-control" type="file" name="{{ $image->id }}" >
                                            @endif
                                            @if (!empty($image->image))
                                            <label for="#">Thay đổi hình ảnh(Không bắt buộc)</label>
                                            <input class="form-control" type="file" name="{{ $image->id }}" >
                                            @endif
                                            @if (!empty($image->slider))
                                            <label for="#">Thay đổi hình ảnh(Không bắt buộc)</label>
                                            <input class="form-control" type="file" name="{{ $image->id }}" >
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group  col-md-4">
                                    <label class="control-label">Tình trạng</label>
                                    <select class="form-control product-chosen" name="status" required>
                                            <option value="Đang hoạt động">Đang hoạt động</option>
                                            <option value="Chưa hoạt động">Chưa hoạt động</option>
                                    </select>
                                </div>
                            </div>
                                <BR>
                                <BR>
                                <BR>
                                <button class="btn btn-save" type="submit">Lưu lại</button>
                                <a class="btn btn-cancel" data-dismiss="modal" href="{{route('product')}}">Hủy bỏ</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
