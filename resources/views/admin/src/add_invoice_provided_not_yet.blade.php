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
                                <select class="form-control" id="exampleSelect1" name="id_provided" required>
                                    @foreach ($provided as $provided)
                                    <option value="{{ $provided->id }}">{{ $provided->name }}</option>
                                    @endforeach
                                </select>
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
                                <select class="form-control" id="exampleSelect1" name="id_product_type" required>
                                    @foreach ($productType as $productType)
                                    <option value="{{ $productType->id }}">{{ $productType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Hình ảnh</label>
                                <input class="form-control" type="file" name="image">
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
                                <label class="control-label">Thời gian bảo hành</label>
                                <input class="form-control" type="number" name="time_warranty" onkeypress="return event.charCode >= 48" min="1" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Thuế(%)</label>
                                <input class="form-control" type="number" name="tax" onkeypress="return event.charCode >= 48" min="1" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Mô tả</label>
                                <textarea class="form-control" type="text" name="describe" onkeypress="return event.charCode >= 48" min="1"></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                                <select class="form-control" id="exampleSelect1" name="status" required>
                                    {{-- <option value="Đang xử lí">Đang xử lí</option> --}}
                                    <option value="Đã xử lí">Đã xử lí</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <button class="btn btn-save" type="submit">Lưu lại</button>
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
    </script>
</body>

</html>
