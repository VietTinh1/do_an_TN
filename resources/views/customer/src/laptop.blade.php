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
        <div class="content" style="margin: 10px 0px 10px 0px;">
            <div class="container">
                <div class="row">
                    @foreach($laptop as $laptop)
                        <div class="col-xs-12 col-sm-4" style="padding: 5px 5px;border-radius:15px;">
                            <div class="card" style="padding: 15px;">
                                <a class="img-card" href="{{ route('productDetailCustomer',['id'=>$laptop->id]) }}">
                                @foreach ($laptop->imageDetail as $imageDetail)
                                    <img src="{{ url('storage/images/'.$imageDetail->image) }}"/>
                                @endforeach
                                </a>
                                <div class="card-content">
                                    <h4 class="card-title">
                                        <a href="{{ route('productDetailCustomer',['id'=>$laptop->id]) }}"> {{ $laptop->name_product }}
                                    </a>
                                    </h4>
                                    <p class="">
                                        {{ $laptop->price }} VND
                                    </p>
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
