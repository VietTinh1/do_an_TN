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
                                        <img src="{{ url('storage/images/'.$image->image) }}" alt="">
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

                                            {{-- @foreach ($product2 as $image)
                                            <label for="#">{{ $image->name_product }}</label>
                                            <label for="#">{{ $image->trademark }}</label>
                                            <label for="#">{{ $image->product_code }}</label>
                                            <label for="#">{{ $image->price }}</label>
                                            <label for="#">{{ $image->time_warranty }}</label>
                                             <img src="{{ url('storage/images/'.$image->image) }}" alt="" width="100%">
                                            @endforeach --}}
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Bình luận</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Họ tên</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                <div class="rating-chooser">
                                                    <p>Số sao</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Ý kiến của bạn</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Gửi"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    {{-- <div class="related-products-wrapper">
                        <h2 class="related-products-title">Sản phẩm</h2>
                        <div class="related-products-carousel">
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-6.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="">Samsung gallaxy note 4</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$400.00</ins>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
