<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách sản phảm | Quản trị Admin</title>
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
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">

                                <a class="btn btn-add btn-sm" href="{{ route('addProduct') }}" title="Thêm"><i class="fas fa-plus"></i>
                                    Tạo mới sản phẩm</a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
                            </div>


                            <div class="col-sm-2">
                                <a class="btn btn-excel btn-sm" href="{{ route('exportProduct') }}" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i class="fas fa-file-pdf"></i> Xuất PDF</a>
                            </div>

                        </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>NV Thêm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá tiền</th>
                                    <th>Đơn vị tính</th>
                                    <th>Ảnh</th>
                                    <th>Mô tả</th>
                                    <th>Thời gian bảo hành</th>
                                    <th>Khuyến mãi</th>
                                    <th>Thuế</th>
                                    <th>Đánh giá</th>
                                    <th>Chi tiết</th>
                                    <th>Tình trạng</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $product)
                                <tr>

                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->product_code }}</td>
                                    <td>{{ $product->product_type_id}}</td>
                                    <td>{{ $product->provided_id}}</td>
                                    <td>{{ $product->name}}</td>
                                    <td><img src="../img-sanpham/kara.jpg" alt="" width="100px;"></td>
                                    {{-- image --}}
                                    <td>{{ $product->amount }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->tax }}</td>
                                    <td>{{ $product->sale }}</td>
                                    <td>{{ $product->sold }}</td>
                                    <td>{{ $product->so_sao }}</td> 

                                    <td>
                                        <button type="button" class="btn btn-primary open-modal" value="{{ $product->id }}" id="edit" data-toggle="modal" data-target="#exampleModal" data-productcode="{{ $product->product_code }}" data-producttypeid="{{ $product->product_type_id }}" data-providedid="{{ $product->provided_id }}" data-name="{{ $product->name }}" data-images="{{ $product->images }}" data-amount="{{ $product->amount }}" data-price="{{ $product->price }}" data-tax="{{ $product->tax }}" data-sold="{{ $product->sold }}" data-sosao="{{ $product->so_sao }}" data-status="{{ $product->status }}" data-createdat="{{ $product->created_at }}">Chi tiết</button>
                                    </td>
                                    <td>
                                        @if($product->status=="Đang hoạt động")
                                        <span class="badge bg-success">{{ $product->status }}</span>
                                        @else
                                        <span class="badge bg-danger">{{ $product->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('editProduct',['id'=>$product->id]) }}" class="btn btn-warning" style="font-size:5px;"><i class="fas fa-edit"></i></a>
                                        @if($product->status !="Dừng hoạt động")
                                        <a href="{{ route('deleteProduct',['id'=>$product->id]) }}" class="btn btn-danger" style="font-size:7px;"><i class="fas fa-trash"></i></a>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding: 25px 0px 25px 0px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="margin-left:35%;color:red;font-size:25px;">Chi tiết sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#ccc;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group col-md-12">
                                <label class="control-label">Nhân viên thêm</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->account_id)) @endif" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Tên sản phẩm</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->name)) @endif" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Loại sản phẩm</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->product_type_id)) @endif" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Mã sản phẩm</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->product_code)) @endif" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Nhà cung cấp</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->provided_id)) @endif" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Mô tả</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->describe)) @endif" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Số lượng</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->amount)) @endif" readonly>
                            </div>
                            <div class="form-group  col-md-12">
                                <label class="control-label">Giá</label>
                                <input class="form-control" type="number" value="@if(!empty( $data->price)) @endif" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Thuế</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->tax)) @endif" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Đã bán</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->sold)) @endif" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Đánh giá</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->so_sao)) @endif" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Tình Trạng</label>
                                <input class="form-control" type="text" value="@if(!empty( $data->status)) @endif" readonly>
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