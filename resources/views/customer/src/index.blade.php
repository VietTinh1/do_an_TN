@extends('customer.layout')
@section('content')

<div class="slider-area">
    <!-- Slider -->
    <ul class="" id="bxslider-home4">
    @foreach ($newProduct as $newProduct)
        <div class="block-slider block-slider4">
                <li>
                    @foreach ($newProduct->imageDetail as $imageDetail)
                    <img src="{{ url('storage/images/'.$imageDetail->image) }}" alt="Slide" >
                    @endforeach

                    <div class="caption-group">
                        <h2 class="caption title">
                            {{$newProduct->name_product }}
                        </h2>
                        <h4 class="caption subtitle"> {{$newProduct->sim }}</h4>
                        <a class="caption button-radius" href="{{ route('productDetailCustomer',['id'=>$newProduct->id]) }}"><span class="icon"></span>Xem Ngay</a>
                    </div>
                </li>
        </div>
    @endforeach
</ul>
</div>

{{-- <div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>30 ngày hoàn trả</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-truck"></i>
                    <p>Miễn phí vận chuyển</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="fa fa-lock"></i>
                    <p>Thanh toán an toàn</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="fa fa-gift"></i>
                    <p>Sản phảm mới</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area --> --}}


<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title"><b>Sản phẩm mới nhất</b></h2>
                    <div class="product-carousel">
                        @foreach ($data as $data)
                            <div class="single-product">
                                <div class="product-f-image">
                                    @foreach ($data->imageDetail as $image)
                                        <img class="card-img-top" src="{{ url('storage/images/'.$image->image) }}" alt="Card image cap" style="width:auto;max-height:200px;">
                                    @endforeach
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link btn btn-primary"  data-name="{{ $data->name_product }}" data-price="{{$data->price}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                        <a href="{{ route('productDetailCustomer',['id'=>$data->id]) }}" class="view-details-link"><i class="fa fa-link"></i> Xem chi tiết</a>
                                    </div>
                                </div>
                                <h2><a href="{{ route('productDetailCustomer',['id'=>$data->id]) }}">{{ $data->name_product }}</a></h2>
                                <div class="product-carousel-price">
                                    <ins>{{ $data->price }}</ins>
                                    {{-- <del>$100.00</del> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->
<!-- Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Giỏ hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="show-cart table">

                </table>
                <div>Tổng tiền: <span class="total-cart"></span>&nbsp;VND</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Thanh Toán Ngay</button>
            </div>
        </div>
    </div>
</div>

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <div class="brand-list">
                        <img src="img/brand1.png" alt="">
                        <img src="img/brand2.png" alt="">
                        <img src="img/brand3.png" alt="">
                        <img src="img/brand4.png" alt="">
                        <img src="img/brand5.png" alt="">
                        <img src="img/brand6.png" alt="">
                        <img src="img/brand1.png" alt="">
                        <img src="img/brand2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title" style="font-size: 22px;">Điện thoại bán chạy</h2>
                    <a href="{{ route('phoneCustomer') }}" class="wid-view-more">Xem tất cả</a>
                    @foreach ($phone as $phone)
                        <a href="{{ route('productDetailCustomer',['id'=>$phone->id]) }}">
                            <div class="single-wid-product">
                                @foreach ($phone->imageDetail as $image)
                                <img src="{{ url('storage/images/'.$image->image) }}" alt="" class="product-thumb"></a>
                                @endforeach
                                <h2><a href="{{ route('productDetailCustomer',['id'=>$phone->id]) }}">{{ $phone->name_product }}</a></h2>
                                <div class="product-wid-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-wid-price">
                                    <ins>{{ $phone->price }} VND</ins>
                                    {{-- <del>$425.00</del> --}}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title" style="font-size: 22px;">Máy tính bán chạy</h2>
                    <a href="{{ route('tabletCustomer') }}" class="wid-view-more">Xem tất cả</a>
                    @foreach ($tablet as $tablet)
                        <a href="{{ route('productDetailCustomer',['id'=>$tablet->id]) }}">
                            <div class="single-wid-product">
                                @foreach ($tablet->imageDetail as $image)
                                <img src="{{ url('storage/images/'.$image->image) }}" alt="" class="product-thumb"></a>
                                @endforeach
                                <h2><a href="{{ route('productDetailCustomer',['id'=>$tablet->id]) }}">{{ $tablet->name_product }}</a></h2>
                                <div class="product-wid-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-wid-price">
                                    <ins>{{ $tablet->price }} VND</ins>
                                    {{-- <del>$425.00</del> --}}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title" style="font-size: 22px;">Laptop bán chạy</h2>
                    <a href="{{ route('laptopCustomer') }}" class="wid-view-more">Xem tất cả</a>
                    @foreach ($laptop as $laptop)
                        <a href="{{ route('productDetailCustomer',['id'=>$laptop->id]) }}">
                            <div class="single-wid-product">
                                @foreach ($laptop->imageDetail as $image)
                                <img src="{{ url('storage/images/'.$image->image) }}" alt="" class="product-thumb"></a>
                                @endforeach
                                <h2><a href="{{ route('productDetailCustomer',['id'=>$laptop->id]) }}">{{ $laptop->name_product }}</a></h2>
                                <div class="product-wid-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-wid-price">
                                    <ins>{{ $laptop->price }} VND</ins>
                                    {{-- <del>$425.00</del> --}}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
