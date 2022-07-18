<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm hóa đơn | Quản trị Admin</title>
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
    {{-- thêm multi product --}}
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
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
                        <h5 style="text-align:center;">Chỉnh sửa thông tin hóa đơn</h5>
                    </span>
                </div>
            </div>
            <form action="{{ route('postEditInvoice',['id'=>$invoice->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Tên khách hàng</label>
                        <input class="form-control" type="text" value="{{ $invoice->name_customer }}" name="name_customer" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="email" value="{{ $invoice->email_customer }}" name="email_customer" required>
                    </div>
                    <div class="form-group  col-md-6">
                        <label class="control-label">Số điện thoại</label>
                        <input class="form-control" type="number" value="{{ $invoice->phone }}" name="phone" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Địa chỉ</label>
                        <input class="form-control" type="text" value="{{ $invoice->address_customer }}" name="address_customer" required>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Thay đổi ghi chú đơn hàng</label>
                        <textarea class="form-control" rows="4" name="message">{{ $invoice->message }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Tình trạng</label>
                        <input class="form-control" type="text" value="@if($invoice->status =="Chờ xử lí") Chờ xử lí @elseif($invoice->status =="Đang xử lí") Đang xử lí @else Đã xử lí @endif" readonly="readonly">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleSelect1" class="control-label">Thay đổi tình trạng</label>
                        <select class="form-control" id="exampleSelect1" name="status" required>
                            <option value="{{ $invoice->status }}">{{ $invoice->status }}</option>
                            @foreach ($status as $status)
                                @if($invoice->status!=$status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                </div>

                <?php $i=0; ?>
                <div class="container" style="max-width:1219px;">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="tab_logicX" >
                                <thead>
                                    <tr>
                                        <th class="text-center"> Mã sản phẩm</th>
                                        <th class="text-center"> Tên sản phẩm </th>
                                        <th class="text-center"> Số lượng </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice->invoiceDetail as $invoiceDetail)
                                        <tr>
                                            <td style="text-align: center">
                                                @if (!empty($invoiceDetail->product->product_code))
                                                 {{ $invoiceDetail->product->product_code }}
                                                @endif
                                            </td>
                                            <td>
                                                <select name="products[]" class="form-control" >
                                                    <option value="{{ $invoiceDetail->id }}">
                                                        @if (!@empty($invoiceDetail->product->name_product))
                                                            {{ $invoiceDetail->product->name_product }}
                                                        @endif
                                                    </option>
                                                </select>
                                            </td>
                                            <td><input type="number" name='amount[]' placeholder='Nhập số lượng' value="{{ $invoiceDetail->amount }}" class="form-control amount" step="0" min="0" required></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if ($invoice->status=="Chờ xử lí")
                            <div>
                                <input type="button" id="product_add" value="Thêm sản phẩm"></input>
                            </div>
                            <div id="showProductAdd" style="display:none;max-width:1219px;">
                                <div style="text-align: center;width:100%;font-size:23px;"><label for="#" ><b>Thêm sản phẩm</b></label></div>
                                <div class="container" style="max-width:1219px;" >
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover" id="tab_logic" >
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"> ID </th>
                                                        <th class="text-center"> Tên sản phẩm </th>
                                                        <th class="text-center"> Số lượng </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id='addr0'>
                                                        <td style="text-align: center">1</td>
                                                        <td>
                                                            <select name="productAdd[]" class="form-control" >
                                                                @foreach ($product as $product)
                                                                <option value="{{ $product->id }}">
                                                                    {{ $product->name_product }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input type="number" name='amountAdd[]' placeholder='Nhập số lượng' class="form-control amount" step="0" min="0"></td>
                                                    </tr>
                                                    <tr id='addr1'></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <button id="add_row" type="button" class="btn btn-primary pull-left">Thêm sản phẩm</button>
                                            <button id="delete_row" type="button" class="btn btn-primary pull-right">Xóa sản phẩm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                <BR>
                <BR>
                <BR>
                @if ($invoice->status !="Đã xử lí")
                    <button class="btn btn-save" type="submit">Lưu lại</button>
                @endif
                <a class="btn btn-cancel" data-dismiss="modal" href="{{route('deleteInvoice',['id'=>$invoice->id])}}">Hủy đơn hàng</a>
                <a class="btn btn-cancel" data-dismiss="modal" href="{{route('invoice')}}">Trở về</a>
                <BR>
        </div>
        </form>
    </main>
    <script type="text/javascript" src="{{ URL::asset('js/trieu_add.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#product_add').on('click', function(e) {
                if(document.getElementById("showProductAdd").style.display = 'none'){
                    document.getElementById("showProductAdd").style.display = 'block';
                }
                else{
                    document.getElementById("showProductAdd").style.display = 'none';
                }
            });
        });
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
