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

</head>

<body onload="time()" class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header">
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">


            <!-- User Menu-->
            <li><a class="app-nav__item" href="/index.html"><i class='bx bx-log-out bx-rotate-180'></i> </a>

            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="/images/hay.jpg" width="50px" alt="User Image">
            <div>
                <p class="app-sidebar__user-name"><b>Võ Trường</b></p>
                <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
            </div>
        </div>
        <hr>
        <ul class="app-menu">
        <li><a class="app-menu__item" href="{{route('index')}}"><i class='app-menu__icon bx bx-home'></i><span class="app-menu__label">Trang Chủ</span></a></li>
      <li><a class="app-menu__item" href="{{route('invoice')}}"><i class='app-menu__icon bx bx-task'></i><span class="app-menu__label"> Đơn Hàng</span></a></li>
      <li><a class="app-menu__item" href="{{route('product')}}"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Sản Phẩm</span></a></li>
      <li><a class="app-menu__item" href="{{route('staff')}}"><i class='app-menu__icon bx bx bx-run'></i><span class="app-menu__label">Quản lí nội bộ </span></a></li>
      <li><a class="app-menu__item" href="{{route('money')}}"><i class='app-menu__icon bx bx-dollar'></i><span class="app-menu__label">Bảng Kê Lương</span></a></li>
      <li><a class="app-menu__item" href="{{route('provided')}}"><i class='app-menu__icon bx bx-cart-alt'></i><span class="app-menu__label">Nhà cung cấp</span></a></li>
      <li><a class="app-menu__item" href="{{route('report')}}"><i class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Báo cáo doanh thu</span></a></li>
      <li><a class="app-menu__item" href="{{asset('')}}"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Về Trang Khách Hàng</span></a></li>
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">Danh sách đơn hàng</li>
                <li class="breadcrumb-item"><a href="#">Thêm đơn hàng</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Tạo mới đơn hàng</h3>
                    <div class="tile-body">
                        <form class="row">
                            <div class="form-group  col-md-4">
                                <label class="control-label">ID đơn hàng ( Nếu không nhập sẽ tự động phát sinh )</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tên khách hàng</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Số điện thoại khách hàng</label>
                                <input class="form-control" type="number">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Địa chỉ khách hàng</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tên người bán</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Số hiệu người bán</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Ngày làm đơn hàng</label>
                                <input class="form-control" type="date">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Tên sản phẩm cần bán</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Mã sản phẩm</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="number">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                                <select class="form-control" id="exampleSelect1">
                                    <option>-- Chọn tình trạng --</option>
                                    <option>Đã xử lý</option>
                                    <option>Đang chờ</option>
                                    <option>Đã hủy</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label class="control-label">Ghi chú đơn hàng</label>
                                <textarea class="form-control" rows="4"></textarea>
                            </div>

                    </div>
                    <button class="btn btn-save" type="button">Lưu lại</button>
                    <a class="btn btn-cancel" href="{{route('invoice')}}">Hủy bỏ</a>
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