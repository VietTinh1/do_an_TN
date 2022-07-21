@extends('customer.layout')

@section('content')
<section class="wrapper">
    <div class="container-fostrap">
        {{-- <div>
            <img src="https://4.bp.blogspot.com/-7OHSFmygfYQ/VtLSb1xe8kI/AAAAAAAABjI/FxaRp5xW2JQ/s320/logo.png" class="fostrap-logo"/>
            <h1 class="heading">
                Bootstrap Card Responsive
            </h1>
        </div> --}}
        <br>
        <div class="single-product-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    @foreach($phone as $phone)
                    <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                @foreach ($phone->imageDetail as $imageDetail)
                                    <a href="{{ route('productDetailCustomer',['id'=>$phone->id]) }}">
                                        <img src="{{ url('storage/images/'.$imageDetail->image_main) }}" alt="">
                                    </a>
                                    @break
                                @endforeach
                            </div>
                            <h2> <a href="{{ route('productDetailCustomer',['id'=>$phone->id]) }}"> {{ $phone->name_product }}</a></h2>
                            <div class="product-carousel-price">
                                {{ $phone->price }} VND
                            </div>

                            <div class="product-option-shop">
                                <a class="add_to_cart_button add-to-cart-link" data-name="{{ $phone->name_product }}" data-price="{{$phone->price}}">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>

</section>


@endsection
