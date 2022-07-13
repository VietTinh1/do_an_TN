<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách nhà cung cấp | Quản trị Admin</title>
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
    //thêm multi product
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
                        <h5 style="text-align:center;">Chỉnh sửa hóa đơn nhập</h5>
                    </span>
                </div>
            </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Nhà cung cấp</label>
                    <label class="form-control">@if (!empty($data->provided->name))
                        {{ $data->provided->name }}
                    @endif</label>
                </div><br>
                <div style="padding-left: 15px;"><label for="#"><b style="font-size: 20px;">Hóa đơn hiện tại</b></label></div>
                <div class="row col-lg-12">
                    @foreach ($data->invoiceProvidedDetail as $data)
                        <br><br><br>
                        <div class="form-group  col-md-3">
                            <label class="control-label">Sản phẩm</label>
                            <label class="form-control" >{{ $data->product->name_product }}</label>
                        </div>
                        <div class="form-group  col-md-3">
                            <label class="control-label">Số lượng</label>
                            <label class="form-control" >{{ $data->amount }}</label>
                        </div>
                        <div class="form-group  col-md-3">
                            <label class="control-label">Giá nhập(VND)</label>
                            <label class="form-control" >{{ $data->import_price }}</label>
                        </div>
                        <div class="form-group  col-md-3">
                            <label class="control-label">Thuế(%)</label>
                            <label class="form-control" >{{ $data->tax }}</label>
                        </div>
                    @endforeach
                </div>
                <div style="padding-left: 15px;"><label for="#"><b style="font-size: 20px;">Thay đổi hóa đơn</b></label></div>
                <form action="{{ route('postEditInvoiceProvided',['id'=>$data->id]) }}" method="post" enctype="multipart/form-data" style="width: 100%;">
                    @csrf
                    <div class="container" style="max-width:1219px;">
                        <td>
                            <label class="text-center"><b>Chọn nhà cung cấp </b></label>
                            <select class="form-control" id="exampleSelect1" name="id_provided" required>
                                @foreach ($provided as $provided)
                                <option value="{{ $provided->id }}">{{ $provided->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </div><br>
                    <div class="container" style="max-width:1219px;">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic" >
                                    <thead>
                                        <tr>
                                            <td style="text-align: center">1</td>
                                            <th class="text-center"> Sản phẩm </th>
                                            <th class="text-center"> Số lượng </th>
                                            <th class="text-center"> Giá nhập(VND) </th>
                                            <th class="text-center"> Thuế(%) </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id='addr0'>
                                            <td style="text-align: center">1</td>
                                            <td>
                                                <select class="form-control" id="exampleSelect1" name="product_id[]" required>
                                                    @foreach ($product as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" name='amount[]' placeholder='Nhập số lượng' class="form-control amount" onkeypress="return event.charCode >= 48" min="1" step="0" min="0" required></td>
                                            <td><input type="number" name='import_price[]' placeholder='Nhập giá tiền' class="form-control price" onkeypress="return event.charCode >= 48" min="1" step="0.00" min="0" required></td>
                                            <td><input type="number" name='tax[]' placeholder='%' class="form-control tax" step="0.00" min="0" required></td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <button id="add_row" type="button" class="btn btn-primary pull-left">Thêm sản phẩm</button>
                                        <button id="delete_row" type="button" class="btn btn-primary pull-right">Xóa sản phẩm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <BR>
                <BR>
                <BR>
                <button class="btn btn-save" type="submit">Lưu lại</button>
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
        $(document).ready(function() {
                var i = 1;
                $("#add_row").click(function() {
                    b = i - 1;
                    $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                    $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                    i++;
                });
                $("#delete_row").click(function() {
                    if (i > 1) {
                        $("#addr" + (i - 1)).html('');
                        i--;
                    }
                    calc();
                });

                $('#tab_logic tbody').on('keyup change', function() {
                    calc();
                });
                $('#tax').on('keyup change', function() {
                    calc_total();
                });

            });

            function calc() {
                $('#tab_logic tbody tr').each(function(i, element) {
                    var html = $(this).html();
                    if (html != '') {
                        var amount = $(this).find('.amount').val();
                        var price = $(this).find('.price').val();
                        var tax = $(this).find('.tax').val();
                        $(this).find('.total').val((amount * price) + (amount * price * (tax / 100)));

                        calc_total();
                    }
                });
            }

            function calc_total() {
                total = 0;
                $('.total').each(function() {
                    total += parseInt($(this).val());
                });
                $('#sub_total').val(total.toFixed(0));

            }
    </script>
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
