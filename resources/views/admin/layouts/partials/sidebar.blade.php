<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if(Auth::check())
            <div class="image">
                <img src=" {{Auth::user()->user_image_path}}" class="img-circle elevation-2" alt="User Image">
            </div>
            @endif
            <div class="info">
                <a href="#" class="d-block ">
                    @if(Auth::check())
                        Xin chào: {{Auth::user()->name}}
                    @endif
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.category.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh mục sản phẩm
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.menu.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Menus</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.product.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.slider.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.setting.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Setting</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.user.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Danh sách nhân viên</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.roles.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Danh sách Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.permission.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Tạo dữ liệu permission</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.oder.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Danh sách đơn hàng</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('web.comment.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Quản lý comment</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.contact.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Liên hệ của khách</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.video')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Danh sách video</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
