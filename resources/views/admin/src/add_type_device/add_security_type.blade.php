<!DOCTYPE html>
<html lang="en">

<head>
  <title>Thêm bảo mật | Quản trị Admin</title>
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
  <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <link rel="icon" href="/images/logo_title.png" type="image/x-icon">
</head>

<body onload='time()' class="app sidebar-mini rtl">
  @include('admin.menu_header')
  <main class="app-content">
    @if(Session()->has('success'))
    <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh Sách Hóa Đơn Nhập</li>
        <li class="breadcrumb-item"><a href="#">Thêm loại bảo mật</a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Tạo mới loại bảo mật</h3>
          <div class="tile-body">
            <form class="row" method="post" action="{{ route('postUpdateSecurityType',['id'=>'0']) }}">
              @csrf
              <div class="form-group  col-md-4">
                <label class="control-label">Tên loại bảo mật</label>
                <input class="form-control" type="text" name="name_classify" required>
              </div>
              <div class="form-group  col-md-4" style="margin-top: 30px;">
                <button class="btn btn-save" type="submit" style=" height: 40px;padding-left: 10px;padding-right: 10px;">Lưu lại</button>
                <a class="btn btn-cancel" href="{{route('product')}}" style="height: 40px;padding-left: 10px;padding-right: 10px;margin-left: 10px;">Trở lại</a>
              </div>
            </form>
          </div>
          <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0" id="sampleTable">
            <thead>
              <tr>
                <th>Mã bảo mật</th>
                <th>Tên bảo mật</th>
                <th>Ngày tạo</th>
                <th>Thay đổi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $data)
              <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name_classify }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                  <form class="row" method="post" action="{{ route('postUpdateSecurityType',['id'=>$data->id]) }}">
                    @csrf
                    <div class="form-group  col-md-4">
                      <label class="control-label">Tên loại bảo mật</label>
                      <input class="form-control" type="text" name="name_classify" required>
                    </div>
                    <div class="form-group  col-md-4" style="margin-top: 30px;">
                      <button class="btn btn-save" type="submit" style=" height: 40px;padding-left: 10px;padding-right: 10px;">Lưu lại</button>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
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
