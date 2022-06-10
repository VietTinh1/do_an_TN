<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách nhân viên | Quản trị Admin</title>
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
        <form action="{{ route('postEditProduct',['id'=>$product->id]) }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group  col-md-12">
                        <span class="thong-tin-thanh-toan">
                            <h5 style="text-align:center;">Chỉnh sửa thông tin sản phẩm cơ bản</h5>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Mã sản phẩm</label>
                        <input class="form-control" type="text" value="{{ $product->product_code }}" name="product_code" readonly />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Tên sản phẩm</label>
                        <input class="form-control" type="text" value="{{ $product->name }}" name="name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlFile1">Hình ảnh</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Số lượng</label>
                        <input class="form-control" type="text" value="{{ $product->amount }}" name="amount" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Giá tiền</label>
                        <input class="form-control" type="text" value="{{ $product->price }}" name="price" required>
                    </div>
                    <div class="form-group  col-md-6">
                        <label class="control-label">Thuế</label>
                        <input class="form-control" type="text" value="{{ $product->tax }}" name="tax" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Đã bán</label>
                        <input class="form-control" type="text" value="{{ $product->sold }}" name="sold" required readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleSelect1" class="control-label">Loại sản phẩm</label>
                        <select class="form-control" id="exampleSelect1" name="product_type">
                            <option value="1">Điện Thoại</option>
                            <option value="2">Tablet</option>
                            <option value="3">Laptop</option>

                        </select>
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="exampleSelect1" class="control-label">Tình trạng</label>
                        <select class="form-control" id="exampleSelect1" name="status">
                            <option value="Đang hoạt động">Đang hoạt động</option>
                            <option value="Dừng hoạt động">Dừng hoạt động</option>
                        </select>
                    </div>

                </div>
                <BR>
                <BR>
                <BR>
                <button class="btn btn-save" type="submit">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
        </form>
        <BR>
        </div>
    </main>





    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="src/jquery.table2excel.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
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
    <script>
        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("myTable").deleteRow(i);
        }
        jQuery(function() {
            jQuery(".trash").click(function() {
                swal({
                        title: "Cảnh báo",
                        text: "Bạn có chắc chắn là muốn xóa sản phẩm này?",
                        buttons: ["Hủy bỏ", "Đồng ý"],
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Đã xóa thành công.!", {

                            });
                        }
                    });
            });
        });
        oTable = $('#sampleTable').dataTable();
        $('#all').click(function(e) {
            $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
            e.stopImmediatePropagation();
        });
        //In dữ liệu
        var myApp = new function() {
            this.printTable = function() {
                var tab = document.getElementById('sampleTable');
                var win = window.open('', '', 'height=700,width=700');
                win.document.write(tab.outerHTML);
                win.document.close();
                win.print();
            }
        }
    </script>
</body>

</html>