<!DOCTYPE html>
<html lang="en">

<head>
  <title>Trang chủ | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link href="{{asset('css/admin/main.css')}}" rel="stylesheet" type="text/css" media="all" />
  <!-- Custom Theme files -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <link rel="icon" href="/images/logo_title.png" type="image/x-icon">
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body onload="time()" class="app sidebar-mini rtl">
  <!-- Navbar-->
  @include('admin.menu_header')
  <main class="app-content">
    @if(Session()->has('success'))
    <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif
    <div class="row">
      <div class="col-md-12">
        <div class="app-title">
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><b>Bảng điều khiển</b></a></li>
          </ul>
          <div id="clock"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <!--Left-->
      <div class="col-md-12 col-lg-6">
        <div class="row">
          <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
              <div class="info">
                <h4>Tổng khách hàng</h4>
                <p><b>{{ $countCustomer }} khách hàng</b></p>
                <p class="info-tong">Tổng số khách hàng được quản lý.</p>
              </div>
            </div>
          </div>
          <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small info coloured-icon"><i class='icon bx bxs-data fa-3x'></i>
              <div class="info">
                <h4>Tổng sản phẩm</h4>
                <p><b>{{ $product }} sản phẩm</b></p>
                <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
              </div>
            </div>
          </div>
          <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
              <div class="info">
                <h4>Tổng đơn hàng</h4>
                <p><b>{{ $countInvoiceOnMonth }} đơn hàng</b></p>
                <p class="info-tong">Tổng số hóa đơn bán hàng trong tháng.</p>
              </div>
            </div>
          </div>
          <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small danger coloured-icon"><i class='icon bx bxs-error-alt fa-3x'></i>
              <div class="info">
                <h4>Sắp hết hàng</h4>
                <p><b>{{ $outOfProduct }} sản phẩm</b></p>
                <p class="info-tong">Số sản phẩm cảnh báo hết cần nhập thêm.</p>
              </div>
            </div>
          </div>
          <!-- col-12 -->
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Tình trạng đơn hàng</h3>
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID đơn hàng</th>
                      <th>Tên khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($invoice as $invoice)
                    <tr>
                      <td>{{ $invoice->id }}</td>
                      <td>{{ $invoice->name_customer }}</td>
                      <td>{{ $invoice->total }}</td>
                      <td>
                        @if ($invoice->status =="Đang xử lí")
                        <span class="badge bg-success">{{ $invoice->status }}</span>
                        @elseif ($invoice->status =="Đã xử lí")
                        <span class="badge bg-success">{{ $invoice->status }}</span>
                        @elseif ($invoice->status =="Chờ xử lí")
                        <span class="badge bg-success">{{ $invoice->status }}</span>
                        @else
                        <span class="badge bg-danger">{{ $invoice->status }}</span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- / div trống-->
            </div>
          </div>
          <!-- / col-12 -->
          <!-- col-12 -->
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Khách hàng mới</h3>
              <div>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Tên khách hàng</th>
                      <th>Số điện thoại</th>
                      <th>Email</th>
                      <th>Địa chỉ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($newCustomer as $newCustomer)
                    <tr>
                      <td>{{ $newCustomer->name_customer }}</td>
                      <td><span class="tag tag-success">{{ $newCustomer->phone }}</span></td>
                      <td>{{ $newCustomer->email_customer }}</td>
                      <td>{{ $newCustomer->address_customer }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

            </div>
          </div>
          <!-- / col-12 -->
        </div>
      </div>
      <!--END left-->
      <!--Right-->
      <div class="col-md-12 col-lg-6">
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Dữ liệu nhân viên</h3>
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="barChart"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Dữ liệu nhân viên</h3>
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="lineChart"></canvas>
              </div>
            </div>
          </div>

        </div>


      </div>
      <!--END right-->
    </div>
    <div class="text-center" style="font-size: 13px">
      <p><b>Bản quyển &copy; 2022 Website Bán hàng | Bởi TT-TT
        </b></p>
    </div>
  </main>

  <script type="text/javascript" src="{{ URL::asset('js/trieu_add.js') }}"></script>
  <script type="text/javascript" src="{{asset('js/plugins/chart.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <!-- barChart -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <canvas id="barChart" width="400" height="400"></canvas>
  <script type="text/javascript">
    //setup block bar
    const bar = <?php echo json_encode($bar); ?>;
    const data = {
      labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6"],
      datasets: [{
        label: 'Thống kê',
        data: bar,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }, ]
    };
    //config bar
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };
    //render bar
    const myChart = new Chart(
      document.getElementById('barChart'),
      config
    );
  </script>

  <!-- lineChart -->
  <canvas id="lineChart" width="400" height="400"></canvas>
  <script type="text/javascript">
    //setup block line
    const line = <?php echo json_encode($line); ?>;
    const data = {
      labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6"],
      datasets: [{
        label: 'Thống kê',
        data: line,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    };
    //config line
    const config = {
      type: 'line',
      data,

    };
    //render line
    const myChart = new Chart(
      document.getElementById('lineChart'),
      config
    );
  </script>
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