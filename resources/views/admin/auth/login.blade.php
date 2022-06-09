<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>

<head>
    <title>Đăng Nhập</title>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Custom Theme files -->
    <link href="{{asset('css/admin/login.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- for-mobile-apps -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Classy Login form Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!-- //for-mobile-apps -->
    <!--Google Fonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!--header start here-->
    <div class="header">
        <div class="header-main">
            <h1 style="font-weight: bold;">Đăng Nhập</h1>
            <div class="header-bottom">
                <div class="header-right w3agile">

                    <div class="header-left-bottom agileinfo">

                        <form action="{{ route('postLogin') }}" method="post">
                            @csrf
                            <input type="text" name="username" placeholder="Username" id="username" required />
                            <input type="password" name="password" id="password" placeholder="Password" required />
                            <span class="show-btn"><i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
                            </span>
                            <div class="remember">
                                <span class="checkbox1">
                                    <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>Remember
                                        me</label>
                                </span>
                            </div>
                            <input type="submit" value="Login">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--header end here-->
    <div class="copyright">
        <p>© 2022 Website | Design by: VT - TT </p>
    </div>
    <!--footer end here-->

    <script>
        var state = false;

        function toggle() {
            if (state) {
                document.getElementById("password").setAttribute("type", "password");
                document.getElementById("eye").style.color = "black";
                state = false;
            } else {
                document.getElementById("password").setAttribute("type", "text");
                document.getElementById("eye").style.color = "#5887ef";
                state = true;
            }
        }
    </script>
    <!-- show button -->
</body>

</html>