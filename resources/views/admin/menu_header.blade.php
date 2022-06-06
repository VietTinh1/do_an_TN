 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
 <aside class="app-sidebar">
     <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="/images/hay.jpg" width="50px" alt="User Image">
         <div>
             <p class="app-sidebar__user-name"><b>{{auth()->user()->username}}</b></p>
             <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
         </div>
     </div>
     <hr>
     <ul class="app-menu">
         <li><a class="app-menu__item" href="{{route('index')}}"><i class='app-menu__icon bx bx-home'></i><span class="app-menu__label">Trang Chủ</span></a></li>
         <li><a class="app-menu__item" href="{{route('invoice')}}"><i class='app-menu__icon bx bx-task'></i><span class="app-menu__label"> Đơn Hàng</span></a></li>
         <li><a class="app-menu__item" href="{{route('product')}}"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Sản Phẩm</span></a></li>
         <li><a class="app-menu__item" href="{{route('staff')}}"><i class='app-menu__icon bx bx bx-run'></i><span class="app-menu__label">Quản lí nội bộ </span></a></li>
         <li><a class="app-menu__item" href="{{route('money')}}"><i class='app-menu__icon bx bx-dollar'></i><span class="app-menu__label">Bảng Kê Lương</span></a></li>
         <li><a class="app-menu__item" href="{{route('provided')}}"><i class='app-menu__icon bx bx-cart-alt'></i><span class="app-menu__label">Nhà cung cấp</span></a></li>
         <li><a class="app-menu__item" href="{{route('report')}}"><i class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Báo cáo doanh thu</span></a></li>
         <li><a class="app-menu__item" href="{{asset('')}}"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Về Trang Khách Hàng</span></a></li>
     </ul>
 </aside>