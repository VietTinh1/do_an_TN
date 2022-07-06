@extends('customer.layout')
@section('content')
<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{asset('')}}">Trang chủ</a></li>
                    <li><a href="{{asset('shop')}}">Cửa hàng</a></li>
                    <li><a href="{{asset('single_product')}}">Chi tiết sản phẩm</a></li>
                    <li><a href="{{asset('cart')}}">Giỏ hàng</a></li>
                    <li><a href="{{asset('checkout')}}">Thanh toán</a></li>
                    <li class="active"><a href="{{asset('contact')}}">Liên hệ</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Others</a></li>

                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Liên hệ</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h3 class="heading mb-4">Gửi thông tin liên lạc cho chúng tôi!</h3>
                        <p>Chúng tôi sẽ phản hồi bạn sớm nhất</p>
                        <p><img src="img/contact.png" alt="Image" class="img-fluid"></p>
                    </div>
                    <div class="col-md-6">

                        <form class="mb-5" method="post" id="contactForm" name="contactForm">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Họ tên">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Chủ đề">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="7" placeholder="Ý kiến của bạn"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="submit" value="Gửi thông tin" class="btn btn-primary rounded-0 py-2 px-4" style="margin-left:18px;">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form>

                        <div id="form-message-warning mt-4"></div>
                        <div id="form-message-success">
                            Your message was sent, thank you!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
