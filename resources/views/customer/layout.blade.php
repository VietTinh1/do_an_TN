<!DOCTYPE html>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link href="{{asset('css/customer/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Font Awesome -->
    <link href="{{asset('css/customer/font-awesome.min.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom CSS -->
    <link href="{{asset('css/customer/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/customer/owl.carousel.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/customer/responsive.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="icon" href="/images/logo_title.png" type="image/x-icon">
</head>


<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1 style="margin: 0px;"><a href="{{ route('indexCustomer') }}"><img src="/images/logo_title.png" style="position: relative;right: 15%;width: 50%;"></a></h1>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="cart.html" data-toggle="modal" data-target="#cart">Gi??? h??ng - <span class="cart-amunt total-cart"></span> VN??<i class="fa fa-shopping-cart"></i><span class="product-count total-count"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
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
                <ul class="nav navbar-nav" style="display:block;">
                    @if($active=='Trang ch???')<li class="active">@else
                    <li> @endif<a href="{{route('indexCustomer')}}">Trang ch???</a></li>
                    @if($active=='??i???n Tho???i')<li class="active">@else
                    <li> @endif<a href="{{route('phoneCustomer')}}">??i???n Tho???i</a></li>
                    @if($active=='Tablet')<li class="active">@else
                    <li> @endif<a href="{{route('tabletCustomer')}}">M??y t??nh b???ng</a></li>
                    {{-- @if($active=='Laptop')<li class="active">@else
                    <li> @endif<a href="{{route('laptopCustomer')}}">Laptop</a></li> --}}
                    @if($active=='Li??n h???')<li class="active">@else
                    <li> @endif<a href="{{route('contactCustomer')}}">Li??n h???</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->

@if(Session()->has('success'))
    <div class="alert alert-success" style="text-align: center;font-weight: bold;">{{session()->get('success')}}</div>
@endif
@yield('content')

<div class="footer-top-area" style="height:250px;">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="footer-about-us">
                    <h2><span>TT-Shop</span></h2>
                    <p>Ch??ng t??i cam k???t ph???c v??? kh??ch h??ng v???i ch???t l?????ng t???t nh???t v?? ch??n th??nh c???m ??n qu?? kh??ch ???? ???ng h??? s???n ph???m ch??ng t??i </p>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Ch??ng t??i c??</h2>
                    <ul>
                        <li><a href="{{ route('phoneCustomer') }}">??i???n tho???i</a></li>
                        <li><a href="{{ route('tabletCustomer') }}">M??y T??nh B???ng</a></li>
                        <li><a href="{{ route('laptopCustomer') }}">Laptop</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer-newsletter">
                    <h2 class="footer-wid-title">????? l???i email</h2>
                    <p>Ch??ng t??i s??? li??n h??? v???i b???n</p>
                    <div class="newsletter-form">
                        <form action="#" method="post">
                            @csrf
                            <input type="email" placeholder="Nh???p email" style="border-radius: 10px;">
                            <input type="submit" value="G???i" style="border-radius: 10px;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer top area -->
 <!-- Modal -->
 <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gi??? h??ng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('paymentCustomer') }}" method="get">
                    @csrf
                    <table class="show-cart table">
                    </table>
                    <div>T???ng ti???n: <span class="total-cart" name="total"></span>&nbsp;VND</div>
                    <button type="submit">Thanh To??n Ngay</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>B???n quy???n &copy; 2022 Website B??n h??ng | B???i TT-TT</p>

                </div>
            </div>


            <div class="col-md-4">
                <div class="footer-card-icon">
                    <i class="fa fa-cc-discover"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-cc-visa"></i>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
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
        //sessionStorage.clear();
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
                    "<td><input type='text' name='namephone"+[i]+"' value='" + cartArray[i].name + "' style='border:none;' readonly></td>" +
                    "<td name='price"+[i]+"'>(" + cartArray[i].price + ")</td>" +
                    "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name='" + cartArray[i].name + "''>-</button>" +
                    "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "' name='amount"+[i]+"'> " +
                    "<button class='plus-item btn btn-primary input-group-addon' data-name='" + cartArray[i].name + "' >+</button></div></td>" +
                    "<td><button class='delete-item btn btn-danger' data-name='" + cartArray[i].name + "'>X</button></td>" +
                    " = " +
                    "<td><input type='text' name='sumtotal"+[i]+"' value='" + cartArray[i].total + "' name='sumtotal"+[i]+"' readonly></td>" +
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
