<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách đơn hàng | Quản trị Admin</title>
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
        <li class="breadcrumb-item active"><a href="#"><b>Danh sách đơn hàng</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="{{route('addInvoice')}}" title="Thêm"><i class="fas fa-plus"></i>
                  Tạo mới đơn hàng</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="{{route('updatePayment')}}" title="Thêm phương thức thanh toán"><i class="fas fa-plus"></i>
                  Thêm phương thức thanh toán</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-excel btn-sm" href="{{ route('exportInvoice') }}" title="Xuất Excel"><i class="fas fa-file-excel"></i>Xuất Excel</a>
              </div>
            </div>
            <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0" id="sampleTable">
              <thead>
                <tr>
                  <th>Mã đơn hàng</th>
                  <th>Tên khách hàng</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Địa chỉ</th>
                  <th>Tổng tiền</th>
                  <th>Ngày tạo</th>
                  <th>Lời nhắn</th>
                  <th>Chi tiết</th>
                  <th>Tình trạng</th>
                  <th>Chức năng</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->name_customer }}</td>
                        <td>{{ $data->email_customer }}</td>
                        <td>0{{ $data->phone }}</td>
                        <td>{{ $data->address_customer }}</td>
                        <td>{{ $data->total }} VND</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->message }}</td>
                        <td>
                            <button type="button" class="btn btn-primary open-modal" value="{{ $data->id }}" id="edit" data-toggle="modal" data-target="#exampleModal" data-namecustomer="{{ $data->name_customer }}" data-emailcustomer="{{ $data->email_customer }}" data-phone="{{ $data->phone }}" data-addresscustomer="{{ $data->address_customer }}" data-total="{{ $data->total }}" data-status="{{ $data->status }}" data-createdat="{{ $data->created_at }}">Chi tiết</button>
                        </td>
                        <td>
                            @if($data->status =="Chờ xử lí")
                            <span class="badge bg-success">Chờ xử lí</span>
                            @elseif($data->status =="Đang xử lí")
                            <span class="badge bg-success">Đang xử lí</span>
                            @elseif($data->status =="Đã xử lí")
                            <span class="badge bg-success">Đã xử lí</span>
                            @else
                            <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->status !="Đã xử lí" && $data->status !="Đã hủy")
                                <a href="{{ route('editInvoice',['id'=>$data->id]) }}" class="btn btn-warning" style="font-size:7px;"><i class=" fas fa-edit"></i></a>
                                <a href="{{ route('deleteInvoice',['id'=>$data->id]) }}" class=" btn btn-danger" style="font-size:7px;"><i class="fas fa-trash"></i></a>
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

    <!-- Modal POPUP -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 25px 0px 25px 0px;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="margin-left:35%;color:red;font-size:25px;">Chi tiết hóa đơn</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#ccc;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="form-group col-md-12">
                <label class="control-label">Tên khách hàng</label>
                <input class="form-control" type="text" value="@if(!empty($data->account_id)) @endif" readonly>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Email</label>
                <input class="form-control" type="text" value=" @if(!empty($data->email_customer)) @endif" readonly>
              </div>
              <div class="form-group  col-md-12">
                <label class="control-label">Số điện thoại</label>
                <input class="form-control" type="number" value="@if(!empty( $data->phone)) @endif" readonly>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Địa chỉ </label>
                <input class="form-control" type="text" value="@if(!empty(  $data->address_customer)) @endif" readonly>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Địa chỉ </label>
                <input class="form-control" type="text" value="@if(!empty( $data->address_customer)) @endif" readonly>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Tin nhắn</label>
                <input class="form-control" type="text" value="@if(!empty( $data->message)) @endif" readonly>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Tổng tiền</label>
                <input class="form-control" type="number" value="@if(!empty( $data->total)) @endif" readonly>
              </div>
            </div>
            <div class="modal-footer" style="margin-right:30%;">
              <button type="button" class="btn btn-primary">Lưu lại</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
