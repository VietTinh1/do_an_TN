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
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>Danh sách nhân viên</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="{{route('addStaff')}}" title="Thêm"><i class="fas fa-plus"></i>
                  Tạo mới nhân viên</a>
              </div>
              {{-- <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
              </div> --}}
              {{-- <div class="col-sm-2">
                <a class="btn btn-excel btn-sm" href="{{ route('exportStaff') }}" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
            </div> --}}
            {{-- <div class="col-sm-2">
                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i class="fas fa-file-pdf"></i> Xuất PDF</a>
              </div> --}}
          </div>
          <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0" id="sampleTable">
            <thead>
              <tr>
                <th>Mã nhân viên</th>
                <th>Hình ảnh</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Email</th>
                <th>Quyền</th>
                <th>Chi tiết</th>
                <th>Tình trạng</th>
                <th>Tính năng</th>
              </tr>
            </thead>
            <tbody>
              @foreach($user1 as $user)
                <tr>
                    <td>{{ $user->account_id}}</td>
                    <td>
                    <img src="{{ url('storage/images/'.$user->image_url) }}" alt="" title="" width="80px" />
                    </td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->birthday }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->permission }}</td>
                    <td>
                    <button type="button" class="btn btn-primary open-modal" value="{{ $user->id }}" id="edit" data-toggle="modal" data-target="#modalStaff" data-account-id="{{ $user->account_id }}" data-fullname="{{ $user->fullname }}" data-sex="{{ $user->sex }}" data-birthday="{{ $user->birthday }}" data-citizenid="{{ $user->citizen_ID }}" data-address="{{ $user->address }}" data-phone="{{ $user->phone }}" data-email="{{ $user->email }}" data-permission="{{ $user->permission }}" data-status="{{ $user->status }}" data-createdat="{{ $user->created_at }}">Chi tiết</button>
                    </td>
                    <td>
                    @if($user->status=="Đang hoạt động")
                    <span class="badge bg-success">Đang hoạt động</span>
                    @else
                    <span class="badge bg-danger">Dừng hoạt động</span>
                    @endif
                    </td>
                    <td>
                    <a href="{{ route('editStaff',['id'=>$user->id]) }}" class="btn btn-warning" style="font-size:7px;"><i class="fas fa-edit"></i></a>
                    @if($user->status=="Đang hoạt động")
                    <a href="{{ route('deleteStaff',['id'=>$user->id]) }}" class="btn btn-danger" style="font-size:7px;"><i class="fas fa-trash"></i></a>
                    @endif
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    </div>
    <!-- Modal -->
    @extends('admin.src.popup.staff')
  </main>
  <script type="text/javascript" src="{{ URL::asset('js/trieu_add.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
  </script>
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
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
