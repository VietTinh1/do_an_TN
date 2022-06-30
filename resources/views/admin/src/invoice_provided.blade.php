<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách hóa đơn nhập | Quản trị Admin</title>
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
        <li class="breadcrumb-item active"><a href="#"><b>Danh sách hóa đơn nhập</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="{{route('addInvoiceProvided')}}" title="Thêm"><i class="fas fa-plus"></i>
                  Cập nhật sản phẩm</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="{{route('addInvoiceProvidedNotYet')}}" title="Thêm"><i class="fas fa-plus"></i>
                  Tạo mới sản phẩm chưa có</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
              </div>
            </div>
            <div class="row element-button">
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateSecurityType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại bảo mật</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateFeatureType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại tính năng</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateRecordType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại ghi âm</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateVideoType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại xem phim</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateMusicType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại nghe nhạc</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateCameraFeatureType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại tính năng camera</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateWjfjType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại Wjfj</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateGpsType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại Gps</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateBluetoothType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại bluetooth</a>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-add btn-sm" href="{{ route('updateFilmType') }}" title="Thêm"><i class="fas fa-plus"></i>
                      Thêm loại quay phim</a>
                </div>
            </div>
            <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0" id="sampleTable">
              <thead>
                <tr>
                  <th>Nhân viên thêm</th>
                  <th>Mã nhà cung cấp</th>
                  <th>Tổng tiền</th>
                  <th>Ngày tạo</th>
                  <th>Chi tiết</th>
                  <th>Xuất PDF</th>
                  <th>Tình trạng</th>
                  <th>Chức năng</th>
                </tr>
              </thead>
              @foreach ($invoiceProvides as $invoiceProvides)
              <tbody>
                <td>{{ $invoiceProvides->account_id }}</td>
                <td>{{ $invoiceProvides->provided_id }}</td>
                <td>{{ $invoiceProvides->total }}</td>
                <td>{{ $invoiceProvides->created_at }}</td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInvoiceProvided" value="{{ $invoiceProvides->id }}" data-provided-id="{{ $invoiceProvides->provided_id }}" data-account-id="{{ $invoiceProvides->account_id }}" data-total="{{ $invoiceProvides->total}}" data-amount="{{ $invoiceProvides->amount }}" data-import-price="{{ $invoiceProvides->import_price }}" data-created-at="{{ $invoiceProvides->created_at }}" data-status="{{ $invoiceProvides->status }}">Chi tiết hóa đơn</button>
                </td>
                <td>
                  <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i class="fas fa-file-pdf"></i> Xuất PDF</a>
                </td>
                <td>
                  @if($invoiceProvides->status =="Đang xử lí")
                  <span class="badge bg-warning"> Đang xử lí</span>
                  @elseif($invoiceProvides->status =="Đã xử lí")
                  <span class="badge bg-success">Đã xử lí</span>
                  @else
                  <span class="badge bg-danger">Đã hủy</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('editInvoiceProvided',['id'=>$invoiceProvides->id]) }}" class="btn btn-warning" style="font-size:7px;"><i class="fas fa-edit"></i></a>
                  @if(empty($invoiceProvides->status =="Đã hủy"))
                  <a href="{{ route('deleteInvoiceProvided',['id'=>$invoiceProvides->id]) }}" class="btn btn-danger" style="font-size:7px;"><i class="fas fa-trash"></i></a>
                  @endif
                </td>
              </tbody>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal POPUP -->
    @extends('admin.src.popup.invoice_provided')
  </main>

  <script type="text/javascript" src="{{ URL::asset('js/trieu_add.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/trieu_add.js') }}"></script>
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
