<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách sản phẩm | Quản trị Admin</title>
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
        <form action="{{ route('postEditProduct',['id'=>$id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @foreach ($product as $product)
                <?php
                $temp=$product->configuration;
                ?>
                <div class="form-group  col-md-4">
                    <label class="control-label">Tên sản phẩm</label>
                    <input class="form-control" type="text" name="name" value="{{ $product->name }}" required>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Tên hãng</label>
                    <input class="form-control" type="text" name="trademark" value="{{ $product->trademark }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleSelect1" class="control-label">Loại sản phẩm</label>
                    <input class="form-control" type="text" name="product_type_id" value="{{ $product->product_type_id }}" readonly>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Số lượng</label>
                    <input class="form-control" type="number" name="amount" value="{{ $product->amount }}" onkeypress="return event.charCode >= 48" min="1" required>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Giá nhập(VND)</label>
                    <input class="form-control" type="number" name="import_price" value="{{ $product->import_price }}" onkeypress="return event.charCode >= 48" min="1" required>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Thời gian bảo hành(tháng)</label>
                    <input class="form-control" type="number" name="time_warranty" value="{{ $product->time_warranty }}" onkeypress="return event.charCode >= 48" min="1" required>
                </div>
                <div class="form-group  col-md-4">
                    <label class="control-label">Thuế(%)</label>
                    <input class="form-control" type="number" name="tax" value="{{ $product->tax }}" onkeypress="return event.charCode >= 48" min="1" required>
                </div>
                @foreach($temp->imageDetail as $imageDetail)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Hình ảnh mặt trước</label>
                        <input class="form-control" type="file" name="front" required>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Hình ảnh mặt sau</label>
                        <input class="form-control" type="file" name="backside" required>
                    </div>
                @endforeach
                @foreach ($temp->frontCamera as $frontCamera)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Độ phân giải camera trước</label>
                        <input class="form-control" type="text" name="resolution" value="{{ $frontCamera->resolution }}" required></input>
                        <label class="control-label">Tính năng camera trước:</label>
                        @foreach ($frontCamera->frontCameraFeature as $frontCameraFeature)
                        <div class="form-group  col-md-4">
                            <text class="control-label">{{ $frontCameraFeature->name_front_camera_feature }}</text>
                        </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($temp->screen as $screen)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Công nghệ màn hình</label>
                        <input class="form-control" type="text" name="screen_technology" value="{{ $screen->screen_technology }}" required>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Độ phân giải</label>
                        <input class="form-control" type="text" name="resolution" value="{{ $screen->resolution }}" required>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Độ rộng</label>
                        <input class="form-control" type="text" name="width" value="{{ $screen->width }}"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Độ sáng tối đa(nits)</label>
                        <input class="form-control" type="number" name="maximum_brightness" value="{{ $screen->maximum_brightness }}" onkeypress="return event.charCode >= 48" min="1">
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Mặt kính cảm ứng</label>
                        <input class="form-control" type="text" name="touch_glass" value="{{ $screen->touch_glass }}" required>
                    </div>
                @endforeach
                @foreach ($temp->rearCamera as $rearCamera)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Độ phân giải camera chính(sau)</label>
                        <input class="form-control" type="number" name="main_rear_camera" value="{{ $rearCamera->main_rear_camera }}" onkeypress="return event.charCode >= 48" min="1"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Độ phân giải camera sau 1</label>
                        <input class="form-control" type="number" name="main_secondary_1" value="{{ $rearCamera->main_secondary_1 }}" onkeypress="return event.charCode >= 48" min="1"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Độ phân giải camera sau 2</label>
                        <input class="form-control" type="number" name="main_secondary_2" value="{{ $rearCamera->main_secondary_2 }}" onkeypress="return event.charCode >= 48" min="1"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Đèn flash</label>
                        <input class="form-control" type="text" name="flash_light" value="{{ $rearCamera->flash_light }}" onkeypress="return event.charCode >= 48" min="1"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Tính năng camera sau</label>
                        @foreach ($rearCamera->rearCameraFeature as $rearCameraFeature)
                        <div class="form-group  col-md-4">
                            <label class="control-label">{{ $rearCameraFeature->name_rear_camera_feature }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Quay phim</label>
                        @foreach ($rearCamera->film as $film)
                        <div class="form-group  col-md-4">
                            <label class="control-label">{{ $film->name_film }}</label>
                        </div>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($temp->operatingSystemCpu as $operatingSystemCpu)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Hệ điều hành</label>
                        <input class="form-control" type="text" value="{{ $operatingSystemCpu->operating_system_name }}" name="operating_system_name"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Tên Cpu</label>
                        <input class="form-control" type="text" value="{{ $operatingSystemCpu->chip_cpus }}" name="chip_cpus"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Tốc độ CPU</label>
                        <input class="form-control" type="text" value="{{ $operatingSystemCpu->speed_cpu }}" name="speed_cpu"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">GPU</label>
                        <input class="form-control" type="text" value="{{ $operatingSystemCpu->gpu }}" name="gpu"></input>
                    </div>
                @endforeach
                @foreach ($temp->memory as $memory)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Ram</label>
                        <input class="form-control" type="number" name="ram" value="{{ $memory->ram }}" onkeypress="return event.charCode >= 48" min="1"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Rom</label>
                        <input class="form-control" type="number" name="rom" value="{{ $memory->rom }}" onkeypress="return event.charCode >= 48" min="1"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Bộ nhớ khả dụng</label>
                        <input class="form-control" type="number" name="memory_available" value="{{ $memory->memory_available }}" onkeypress="return event.charCode >= 48" min="1"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Thẻ nhớ</label>
                        <input class="form-control" type="text" name="memory_stick" value="{{ $memory->memory_stick }}" onkeypress="return event.charCode >= 48" min="1"></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Danh bạ</label>
                        <input class="form-control" type="text" name="phone_book" value="{{ $memory->phone_book }}" required></input>
                    </div>
                @endforeach
                @foreach ($temp->connection as $connection)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Mạng di động</label>
                        <input class="form-control" type="text" name="mobile_network" value="{{ $connection->mobile_network }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Sim</label>
                        <input class="form-control" type="text" name="sim" value="{{ $connection->sim }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Bluetooth:</label>
                        @foreach ($connection->bluetooth as $bluetooth)
                        <label class="control-label">{{ $bluetooth->name_bluetooth }}</label>
                        @endforeach
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Wjfj:</label>
                        @foreach ($connection->wjfj as $wjfj)
                        <label class="control-label">{{ $wjfj->name_wjfj }}</label>
                        @endforeach
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Định vị(Gps):</label>
                        @foreach ($connection->gps as $gps)
                        <label class="control-label">{{ $gps->name_gps }}</label>
                        @endforeach
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Cổng sạc</label>
                        <input class="form-control" type="text" name="charging_port" value="{{ $connection->charging_port }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Tai nghe</label>
                        <input class="form-control" type="text" name="head_phone" value="{{ $connection->head_phone }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Kết nối khác</label>
                        <input class="form-control" type="text" name="connection_orther" value="{{ $connection->connection_orther }}" required></input>
                    </div>
                @endforeach
                @foreach ($temp->pin as $pin)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Dung lượng pin</label>
                        <input class="form-control" type="text" name="memory_pin" value="{{ $pin->memory_pin }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Loại pin</label>
                        <input class="form-control" type="text" name="pin_type" value="{{ $pin->pin_type }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Hỗ trợ sạc tối đa</label>
                        <input class="form-control" type="text" name="support_pin_max" value="{{ $pin->support_pin_max }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Sạc kèm theo máy</label>
                        <input class="form-control" type="text" name="charger" value="{{ $pin->charger }}" required ></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Công nghệ pin</label>
                        <input class="form-control" type="text" name="technology_pin" value="{{ $pin->technology_pin }}" required></input>
                    </div>
                @endforeach
                @foreach ($temp->utilitie as $utilitie)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Kháng nước, bụi</label>
                        <input class="form-control" type="text" name="waterproof_dustproof" value="{{ $utilitie->waterproof_dustproof }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Radio</label>
                        <input class="form-control" type="text" name="radio" value="{{ $utilitie->radio }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Bảo mật nâng cao</label>
                        @foreach ($utilitie->securityAdvance as $securityAdvance)
                            <label class="control-label">{{ $securityAdvance->name_security_advance }}</label>
                        @endforeach
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Tính năng đặc biệt</label>
                        @foreach ($utilitie->featureAdvance as $featureAdvance)
                            <label class="control-label">{{ $featureAdvance->name_feature_advance }}</label>
                        @endforeach
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Ghi âm</label>
                            @foreach ($utilitie->record as $record)
                                <label class="control-label">{{ $record->name_record }}</label>
                            @endforeach
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Xem phim</label>
                        @foreach ($utilitie->video as $video)
                            <label class="control-label">{{ $video->name_video }}</label>
                        @endforeach
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Nghe nhạc</label>
                        @foreach ($utilitie->music as $music)
                            <label class="control-label">{{ $music->name_music }}</label>
                        @endforeach
                    </div>
                @endforeach
                @foreach ($temp->information as $information)
                    <div class="form-group  col-md-4">
                        <label class="control-label">Thiết kế</label>
                        <input class="form-control" type="text" name="design" value="{{ $information->design }}" required ></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Chất liệu</label>
                        <input class="form-control" type="text" name="material" value="{{ $information->material }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Kích thước khối lượng</label>
                        <input class="form-control" type="text" name="size_mass" value="{{ $information->size_mass }}" required></input>
                    </div>
                    <div class="form-group  col-md-4">
                        <label class="control-label">Ngày ra mắt</label>
                        <input class="form-control" type="text" name="date" value="{{ $information->created_at }}" readonly></input>
                    </div>
                @endforeach
            @endforeach
            {{--
            <div class="form-group col-md-4">
                <label for="exampleSelect1" class="control-label">Tình trạng</label>
                <select class="form-control" id="exampleSelect1" name="status" required>
                    {{-- <option value="Đang xử lí">Đang xử lí</option> --}}
                    {{-- <option value="Đã xử lí">Đã xử lí</option>
                </select>
            </div> --}}
                <BR>
                <BR>
                <BR>
                <button class="btn btn-save" type="submit">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="{{route('product')}}">Hủy bỏ</a>

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
