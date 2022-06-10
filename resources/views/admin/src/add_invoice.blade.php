<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách đơn hàng | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Custom Theme files -->
    <link href="{{asset('css/admin/main.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Font-icon css-->
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
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Tạo mới hóa đơn</h3>
                    <div class="tile-body">
                        <form class="row" method="POST" action="{{ route('postAddInvoice') }}">
                            @csrf
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tên khách hàng</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Số điện thoại</label>
                                <input class="form-control" type="number" name="phone" maxlength="11" onkeypress="return event.charCode >= 48" min="1" required>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Địa chỉ</label>
                                <input class="form-control" type="text" name="address" required>
                            </div>
                            {{-- dropdown --}}
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tên sản phẩm</label>
                                <select class="form-control" id="exampleSelect1" name="nameProduct" required>
                                    @foreach ($product as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number" name="amount" onkeypress="return event.charCode >= 48" min="1" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                                <select class="form-control" id="exampleSelect1" required>
                                    <option>Đang chờ</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Ghi chú đơn hàng</label>
                                <textarea class="form-control" rows="4" name="note"></textarea>
                            </div>
                            <div class="form-group  col-md-4">

                            </div>
                            <div class="form-group  col-md-4">
                                <button class="btn btn-save" type="submit">Lưu lại</button>
                            </div>
                        </form>
                        <a class="btn btn-cancel" style="position: absolute;bottom: 36px;left: 105px;" href="{{ route('invoice') }}">Hủy bỏ</a>
                    </div>

                </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
</body>

</html>