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
                    @foreach($laptop as $laptop)
                    <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                @foreach ($laptop->imageDetail as $imageDetail)
                                <img src="{{ url('storage/images/'.$imageDetail->image) }}" alt="">
                                @endforeach
                            </div>
                            <h2> <a href="{{ route('productDetailCustomer',['id'=>$laptop->id]) }}"> {{ $laptop->name_product }}
                                </a></h2>
                            <div class="product-carousel-price">
                                {{ $laptop->price }} VND
                            </div>

                            <div class="product-option-shop">
                                <a class="add_to_cart_button" data-name="{{ $laptop->name_product }}" data-price="{{$laptop->price}}">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>


@endsection