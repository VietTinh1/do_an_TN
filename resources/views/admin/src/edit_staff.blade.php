<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách nhân viên | Quản trị Admin</title>
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
        <div class="modal-body">
            <div class="row">
                <div class="form-group  col-md-12">
                    <span class="thong-tin-thanh-toan">
                        <h5 style="text-align:center;">Chỉnh sửa thông tin nhân viên cơ bản</h5>
                    </span>
                </div>
            </div>
            <form class="row" method="post" action="{{ route('postEditStaff',['id'=>$staff->id]) }}">
                @csrf
                <div class="form-group col-md-6">
                    <label class="control-label">Họ tên</label>
                    <input class="form-control" type="text" name="fullname" value="{{ $staff->fullname }}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlFile1">Hình ảnh</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label">Địa chỉ</label>
                    <input class="form-control" type="text" name="address" value="{{ $staff->address }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label">Ngày sinh</label>
                    <input class="form-control" type="date" name="birthday" value="{{ $staff->birthday }}" required>
                </div>
                <div class="form-group  col-md-6">
                    <label class="control-label">Email</label>
                    <input class="form-control" type="email" name="email" value="{{ $staff->email }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label">SĐT</label>
                    <input class="form-control" type="text" onkeypress="return event.charCode >= 48" min="1" name="phone" value="{{ $staff->phone }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleSelect1" class="control-label">Quyền</label>
                    <select class="form-control" id="exampleSelect1" name="permission">
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleSelect1" class="control-label">Quyền</label>
                    <select class="form-control" id="exampleSelect1" name="status">
                        <option value="Đang hoạt động">Đang hoạt động</option>
                        <option value="Dừng hoạt động">Dừng hoạt động</option>
                    </select>
                </div>
                <BR>
                    <BR>
                    <BR>
                    <button class="btn btn-save" type="submit" >Lưu lại</button>
                    <a class="btn btn-cancel" data-dismiss="modal" href="{{ route('staff') }}">Hủy bỏ</a>
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
