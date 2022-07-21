@extends('customer.layout')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Chi tiết sản phẩm</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                {{-- <div class="single-sidebar">
                    <h2 class="sidebar-title">Tìm kiếm sản phẩm</h2>
                    <form action="">
                        <input type="text" placeholder="Tìm kiếm...">
                        <input type="submit" value="Tìm kiếm">
                    </form>
                </div> --}}

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Điện thoại</h2>
                    @foreach ($phone as $phone)
                        <div class="thubmnail-recent">
                            <a href="{{ route('productDetailCustomer',['id'=>$phone->id]) }}">
                                @foreach ($phone->imageDetail as $image)
                                <img src="{{ url('storage/images/'.$image->image) }}" class="recent-thumb" alt="">
                                @break;
                                @endforeach
                            </a>
                            <h2><a href="{{ route('productDetailCustomer',['id'=>$phone->id]) }}">{{ $phone->name_product }}</a></h2>
                            <div class="product-sidebar-price">
                                <ins>{{ $phone->price }} VNĐ</ins>
                                {{-- <del>$100.00</del> --}}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Máy tính bảng</h2>
                    <ul>
                        @foreach ($tablet as $tablet)
                            <li><a href="{{ route('productDetailCustomer',['id'=>$tablet->id]) }}">{{ $tablet->name_product }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="{{ route('indexCustomer') }}">Trang chủ</a>
                        <a href="">Sản phẩm</a>
                        <a href="{{ route('productDetailCustomer',['id'=>$product->id]) }}">{{ $product->name_product }}</a>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                @foreach ($product->imageDetail as $image)
                                    <div class="product-main-img">
                                        <img src="{{ url('storage/images/'.$image->image_main) }}" alt="">
                                    </div>
                                    @break
                                @endforeach
                                <div class="product-gallery">
                                    @foreach ($product1->imageDetail as $image)
                                        <img src="{{ url('storage/images/'.$image->image) }}" alt="" width="100%">
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name">{{ $product->name_product }}</h2>
                                <div class="product-inner-price">
                                    <ins>{{ $product->price }} VNĐ</ins>
                                    {{-- <del>$100.00</del> --}}
                                </div>

                                <form action="" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button add-to-cart-link btn" type="submit" data-name="{{$product->name_product}}" data-price="{{$product->price }}">Thêm giỏ hàng</button>
                                </form>



                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Chi tiết sản phẩm</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Bình luận</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Thông tin sản phẩm</h2>
                                            <div class="form-group">
                                                <div><label for="#"><b>Tên sản phẩm:</b> {{ $product->name_product }}</label></div>
                                                <div><label for="#"><b>Hãng:</b> {{ $product->trademark }}</label></div>
                                                <div><label for="#"><b>Bảo hành:</b> {{ $product->time_warranty }} Tháng</label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Màn hình</b></label></div>
                                                <div><label for="#"><b>Công nghệ màn hình:</b> {{ $product->screen_technology }}</label></div>
                                                <div><label for="#"><b>Độ phân giải màn hình:</b> {{ $product->screen_resolution }}</label></div>
                                                <div><label for="#"><b>Màn hình rộng:</b> {{ $product->screen_width }}</label></div>
                                                <div><label for="#"><b>Độ sáng tối đa:</b> {{ $product->screen_maximum_brightness }}</label></div>
                                                <div><label for="#"><b>Mặt kính cảm ứng:</b> {{ $product->touch_screen_glass }}</label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Camera sau</b></label></div>
                                                <div><label for="#"><b>Độ phân giải:</b>{{ $product->rear_screen_resolution}} </label></div>
                                                <div>
                                                    <label for="#"><b>Quay phim:</b></label>

                                                </div>
                                                <div><label for="#"><b>Đèn Flash:</b>{{ $product->flash_light}}</label></div>
                                                <div><label for="#"><b>Tính năng:</b></label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Camera trước</b></label></div>
                                                <div><label for="#"><b>Độ phân giải:</b>{{ $product->front_screen_resolution}}</label></div>
                                                <div><label for="#"><b>Tính năng:</b></label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Hệ điều hành & CPU</b></label></div>
                                                <div><label for="#"><b>Hệ điều hành:</b>{{ $product->operating_system}}</label></div>
                                                <div><label for="#"><b>Chip xử lý (CPU):</b>{{ $product->CPU}}</label></div>
                                                <div><label for="#"><b>Tốc độ CPU:</b>{{ $product->speed_cpu}}</label></div>
                                                <div><label for="#"><b>Chip đồ họa (GPU):</b>{{ $product->GPU}}</label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Bộ nhớ & Lưu trữ</b></label></div>
                                                <div><label for="#"><b>RAM:</b>{{ $product->ram}}</label></div>
                                                <div><label for="#"><b>Bộ nhớ trong:</b>{{ $product->rom}} GB</label></div>
                                                <div><label for="#"><b>Bộ nhớ còn lại (khả dụng) khoảng:</b>{{ $product->available_memory}} GB</label></div>
                                                <div><label for="#"><b>Thẻ nhớ:</b>{{ $product->memory_stick}} GB</label></div>
                                                <div><label for="#"><b>Danh bạ:</b>{{ $product->phonebook}}</label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Kết nối</b></label></div>
                                                <div><label for="#"><b>Mạng di động:</b>{{ $product->mobile_network}}</label></div>
                                                <div><label for="#"><b>SIM:</b>{{ $product->sim}}</label></div>
                                                <div><label for="#"><b>Wifi:</b>{{ $product->phonebook}}</label></div>
                                                <div><label for="#"><b>GPS:</b></label></div>
                                                <div><label for="#"><b>Bluetooth:</b></label></div>
                                                <div><label for="#"><b>Cổng kết nối/sạc:</b>{{ $product->phonebook}}</label></div>
                                                <div><label for="#"><b>Jack tai nghe:</b>{{ $product->headphone}}</label></div>
                                                <div><label for="#"><b>Kết nối khác:</b>{{ $product->connection_orther}}</label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Pin & Sạc</b></label></div>
                                                <div><label for="#"><b>Dung lượng pin:</b>{{ $product->battery_capacity}}</label></div>
                                                <div><label for="#"><b>Loại pin:</b>{{ $product->pin_type}}</label></div>
                                                <div><label for="#"><b>Hỗ trợ sạc tối đa:</b>{{ $product->maximum_battery_charging_support}}</label></div>
                                                <div><label for="#"><b>Sạc kèm theo máy:</b>{{ $product->charger_included}}</label></div>
                                                <div><label for="#"><b>Công nghệ pin:</b>{{ $product->battery_technology}}</label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Tiện ích</b></label></div>
                                                <div><label for="#"><b>Bảo mật nâng cao:</b></label></div>
                                                <div><label for="#"><b>Tính năng đặc biệt:</b></label></div>
                                                <div><label for="#"><b>Kháng nước, bụi:</b>{{ $product->water_and_dust_resistant}}</label></div>
                                                <div><label for="#"><b>Ghi âm:</b></label></div>
                                                <div><label for="#"><b>Radio:</b>{{ $product->radio}}</label></div>
                                                <div><label for="#"><b>Xem phim:</b></label></div>
                                                <div><label for="#"><b>Nghe nhạc:</b></label></div>
                                                <div><label for="#"><b style="font-size:17px;color:rgb(40, 148, 162);">Thông tin chung</b></label></div>
                                                <div><label for="#"><b>Thiết kế:</b>{{ $product->design}}</label></div>
                                                <div><label for="#"><b>Chất liệu:</b>{{ $product->material}}</label></div>
                                                <div><label for="#"><b>Kích thước, khối lượng:</b>{{ $product->size_volume}}</label></div>
                                                <div><label for="#"><b>Thời điểm ra mắt:</b>{{ $product->date_created}}</label></div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Bình luận</h2>
                                            <form action="{{ route('postCommentCustomer',['id'=>$id]) }}" method="post">
                                                @csrf
                                                <div class="submit-review">
                                                    <p><label for="#">Họ tên</label> <input name="name_customer" type="text" required></p>
                                                    <p><label for="#">Email</label> <input name="email_customer" type="email" required></p>
                                                    <p><label for="#">SĐT</label> <input name="phone_customer" type="number" style="width: 100%;" required></p>
                                                    <p><label for="#">Ý kiến của bạn</label> <textarea name="message_customer" cols="30" rows="10" required></textarea></p>
                                                    <p><input type="submit" value="Gửi"></p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     var a=<?php echo json_encode($data); ?>;
        console.log(a);
    $(document).ready(function() {
        var a=<?php echo json_encode($data); ?>;
        console.log(a);});
</script>
@endsection
