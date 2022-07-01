<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TT Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="{{asset('css/customer/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Font Awesome -->
    <link href="{{asset('css/customer/font-awesome.min.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom CSS -->
    <link href="{{asset('css/customer/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/customer/owl.carousel.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/customer/reponsive.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="icon" href="/images/logo_title.png" type="image/x-icon">
</head>

<body>
    @include('customer.header')
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
                        <li class="active"><a href="{{asset('')}}">Trang chủ</a></li>
                        <li><a href="{{asset('shop')}}">Cửa hàng</a></li>
                        <li><a href="{{asset('single_product')}}">Chi tiết sản phẩm</a></li>
                        <li><a href="{{asset('cart')}}">Giỏ hàng</a></li>
                        <li><a href="{{asset('checkout')}}">Thanh Toán</a></li>
                        <li><a href="{{asset('contact')}}">Liên hệ</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Others</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    <div class="slider-area">
        <!-- Slider -->
        <div class="block-slider block-slider4">
            <ul class="" id="bxslider-home4">
                <li>
                    <img src="img/h4-slide.png" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            iPhone <span class="primary">6 <strong>Plus</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Dual SIM</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="img/h4-slide2.png" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            by one, get one <span class="primary">50% <strong>off</strong></span>
                        </h2>
                        <h4 class="caption subtitle">school supplies & backpacks.*</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="img/h4-slide3.png" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Select Item</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li><img src="img/h4-slide4.png" alt="Slide">
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">& Phone</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- ./Slider -->
    </div> <!-- End slider area -->

    <div class="promo-area">
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
    </div> <!-- End promo area -->


    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sản phẩm mới nhất</h2>
                        <div class="product-carousel">
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img class="card-img-top" src="img/product-1.jpg" alt="Card image cap">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link btn btn-primary" data-name="Phone" data-price="2"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="single-product.html" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.html">Samsung Galaxy s5- 2015</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$700.00</ins> <del>$100.00</del>
                                </div>
                            </div>

                            <div class="single-product">
                                <div class="product-f-image">
                                    <img class="card-img-top" src="img/product-2.jpg" alt="Card image cap">
                                    <div class="product-hover">
                                        <a href="#" class="add-to-cart-link btn btn-primary" data-name="Tablet" data-price=""><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="single-product.html" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="single-product.html">Samsung Galaxy s5- 2015</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$700.00</ins> <del>$100.00</del>
                                </div>
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="show-cart table">

                    </table>
                    <div>Total price: $<span class="total-cart"></span></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Order now</button>
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
                        <h2 class="product-wid-title" style="font-size: 22px;">Sản phẩm bán chạy</h2>
                        <a href="" class="wid-view-more">Xem tất cả</a>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-2.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Apple new mac book 2015</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-3.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title" style="font-size: 22px;">Sản phẩm xem gần đây</h2>
                        <a href="#" class="wid-view-more">Xem tất cả</a>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony Smart Air Condtion</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-2.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title" style="font-size: 22px;">Sản phảm đứng đầu</h2>
                        <a href="#" class="wid-view-more">Xem tất cả</a>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-3.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->

    @include('customer.footer')

    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- jQuery sticky menu -->
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.sticky.js')}}"></script>

    <!-- jQuery easing -->
    <script src="{{asset('js/jquery.easing.1.3.min.js')}}"></script>

    <!-- Main Script -->
    <script src="{{asset('js/main_customer.js')}}"></script>

    <!-- Slider -->
    <script type="text/javascript" src="{{asset('js/bxslider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.slider.js')}}"></script>

    <script>
        // ************************************************
        // Shopping Cart API
        // ************************************************

        var shoppingCart = (function() {
            // =============================
            // Private methods and propeties
            // =============================
            cart = [];

            // Constructor
            function Item(name, price, count) {
                this.name = name;
                this.price = price;
                this.count = count;
            }

            // Save cart
            function saveCart() {
                sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
            }

            // Load cart
            function loadCart() {
                cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
            }
            if (sessionStorage.getItem("shoppingCart") != null) {
                loadCart();
            }


            // =============================
            // Public methods and propeties
            // =============================
            var obj = {};

            // Add to cart
            obj.addItemToCart = function(name, price, count) {
                for (var item in cart) {
                    if (cart[item].name === name) {
                        cart[item].count++;
                        saveCart();
                        return;
                    }
                }
                var item = new Item(name, price, count);
                cart.push(item);
                saveCart();
            }
            // Set count from item
            obj.setCountForItem = function(name, count) {
                for (var i in cart) {
                    if (cart[i].name === name) {
                        cart[i].count = count;
                        break;
                    }
                }
            };
            // Remove item from cart
            obj.removeItemFromCart = function(name) {
                for (var item in cart) {
                    if (cart[item].name === name) {
                        cart[item].count--;
                        if (cart[item].count === 0) {
                            cart.splice(item, 1);
                        }
                        break;
                    }
                }
                saveCart();
            }

            // Remove all items from cart
            obj.removeItemFromCartAll = function(name) {
                for (var item in cart) {
                    if (cart[item].name === name) {
                        cart.splice(item, 1);
                        break;
                    }
                }
                saveCart();
            }

            // Clear cart
            obj.clearCart = function() {
                cart = [];
                saveCart();
            }

            // Count cart 
            obj.totalCount = function() {
                var totalCount = 0;
                for (var item in cart) {
                    totalCount += cart[item].count;
                }
                return totalCount;
            }

            // Total cart
            obj.totalCart = function() {
                var totalCart = 0;
                for (var item in cart) {
                    totalCart += cart[item].price * cart[item].count;
                }
                return Number(totalCart.toFixed(2));
            }

            // List cart
            obj.listCart = function() {
                var cartCopy = [];
                for (i in cart) {
                    item = cart[i];
                    itemCopy = {};
                    for (p in item) {
                        itemCopy[p] = item[p];

                    }
                    itemCopy.total = Number(item.price * item.count).toFixed(2);
                    cartCopy.push(itemCopy)
                }
                return cartCopy;
            }

            // cart : Array
            // Item : Object/Class
            // addItemToCart : Function
            // removeItemFromCart : Function
            // removeItemFromCartAll : Function
            // clearCart : Function
            // countCart : Function
            // totalCart : Function
            // listCart : Function
            // saveCart : Function
            // loadCart : Function
            return obj;
        })();


        // *****************************************
        // Triggers / Events
        // ***************************************** 
        // Add item
        $('.add-to-cart-link').click(function(event) {
            event.preventDefault();
            var name = $(this).data('name');
            var price = Number($(this).data('price'));
            shoppingCart.addItemToCart(name, price, 1);
            displayCart();
        });

        // Clear items
        $('.clear-cart').click(function() {
            shoppingCart.clearCart();
            displayCart();
        });


        function displayCart() {
            var cartArray = shoppingCart.listCart();
            var output = "";
            for (var i in cartArray) {
                output += "<tr>" +
                    "<td>" + cartArray[i].name + "</td>" +
                    "<td>(" + cartArray[i].price + ")</td>" +
                    "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].name + ">-</button>" +
                    "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>" +
                    "<button class='plus-item btn btn-primary input-group-addon' data-name=" + cartArray[i].name + ">+</button></div></td>" +
                    "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].name + ">X</button></td>" +
                    " = " +
                    "<td>" + cartArray[i].total + "</td>" +
                    "</tr>";
            }
            $('.show-cart').html(output);
            $('.total-cart').html(shoppingCart.totalCart());
            $('.total-count').html(shoppingCart.totalCount());
        }

        // Delete item button

        $('.show-cart').on("click", ".delete-item", function(event) {
            var name = $(this).data('name')
            shoppingCart.removeItemFromCartAll(name);
            displayCart();
        })


        // -1
        $('.show-cart').on("click", ".minus-item", function(event) {
            var name = $(this).data('name')
            shoppingCart.removeItemFromCart(name);
            displayCart();
        })
        // +1
        $('.show-cart').on("click", ".plus-item", function(event) {
            var name = $(this).data('name')
            shoppingCart.addItemToCart(name);
            displayCart();
        })

        // Item count input
        $('.show-cart').on("change", ".item-count", function(event) {
            var name = $(this).data('name');
            var count = Number($(this).val());
            shoppingCart.setCountForItem(name, count);
            displayCart();
        });

        displayCart();
    </script>
</body>

</html>