<!doctype html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />

        <title inertia>Inventory Admin Dashboard</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- endinject -->
        <link rel="shortcut icon" href="/images/favicon2.png" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function destroyItem(routeUrl, itemId) 
            {
                Swal.fire({
                    title: 'تحذير',
                    text: "هل أنت متأكد من الحذف؟",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(routeUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                Swal.fire({
                                    title: 'نجاح!',
                                    text: 'تم الحذف ',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                // refresh the page after Swal closes
                                location.reload();
                            });
                            } else {
                                Swal.fire('خطأ', 'تعذر حذف العنصر', 'error');
                            }
                        })
                        .catch(() => {
                            Swal.fire('خطأ', 'حدث خطأ في الاتصال بالخادم', 'error');
                        });
                    }
                });
            }
        </script>

    </head>

    <body  class= "rtl">
        @if(Session("success_message"))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: 'نجاح!',
                    text: "{{ Session('success_message') }}",
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                });
            </script>
        @endif


        <div class="container-scroller">
        <!-- partial:././partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo" href="{{ route('home') }}">
                <img src="/images/logo.png" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
                <img src="/images/favicon2.png" alt="logo" />
                </a>
            </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">John Doe</span></h1>
                <h3 class="welcome-sub-text">Your performance summary this week </h3>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-none d-lg-block">
                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                    <span class="input-group-addon input-group-prepend border-right">
                    <span class="icon-calendar input-group-text calendar-icon"></span>
                    </span>
                    <input type="text" class="form-control">
                </div>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="icon-bell"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item py-3 border-bottom">
                    <p class="mb-0 fw-medium float-start">You have 4 new notifications </p>
                    <span class="badge badge-pill badge-primary float-end">View all</span>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                    <div class="preview-thumbnail">
                        <i class="mdi mdi-alert m-auto text-primary"></i>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
                        <p class="fw-light small-text mb-0"> Just now </p>
                    </div>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                    <div class="preview-thumbnail">
                        <i class="mdi mdi-lock-outline m-auto text-primary"></i>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                        <p class="fw-light small-text mb-0"> Private message </p>
                    </div>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                    <div class="preview-thumbnail">
                        <i class="mdi mdi-airballoon m-auto text-primary"></i>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                        <p class="fw-light small-text mb-0"> 2 days ago </p>
                    </div>
                    </a>
                </div>
                </li>
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="/images/faces/face8.jpg" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                    <img class="img-md rounded-circle" src="/images/faces/face8.jpg" alt="Profile image">
                    <p class="mb-1 mt-3 fw-semibold">Allen Moreno</p>
                    <p class="fw-light text-muted mb-0">allenmoreno@gmail.com</p>
                    </div>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>

                    
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                            تسجيل الخروج
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:././partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title">الرئيسية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon fa fa-cog"></i>
                        <span class="menu-title">الاعدادات</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('units.index') }}">وحدات القياس</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('categories.index') }}">التصنيفات</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('branches.index') }}">الفروع</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('warehouses.index') }}">المخازن</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('expensesItems.index') }}">بنود الصرف</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('categories.index') }}">التخفيضات والعروض</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('categories.index') }}">الصلاحيات </a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('categories.index') }}">المستخدمين </a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('items.index') }}">
                        <i class="menu-icon mdi mdi-menu"></i>
                        <span class="menu-title">العناصر</span>
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('suppliers.index') }}">
                    <i class="menu-icon mdi mdi-human-male-female"></i>
                    <span class="menu-title">الموردين</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="././docs/documentation.html">
                    <i class="menu-icon mdi mdi-account-multiple"></i>
                    <span class="menu-title">الزبائن</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="././docs/documentation.html">
                    <i class="menu-icon mdi mdi-cash-multiple"></i>
                    <span class="menu-title">المبيعات</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="././docs/documentation.html">
                    <i class="menu-icon mdi mdi-database"></i>
                    <span class="menu-title">المشتريات</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="././docs/documentation.html">
                    <i class="menu-icon fa fa-money"></i>
                    <span class="menu-title">المصروفات</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-reports" aria-expanded="false" aria-controls="ui-reports">
                    <i class="menu-icon fa fa-bar-chart-o"></i>
                    <span class="menu-title">التقارير</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-reports">
                    <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="././pages/ui-features/buttons.html"> تقرير 1</a></li>
                    <li class="nav-item"> <a class="nav-link" href="././pages/ui-features/dropdowns.html">تقرير 2</a></li>
                    </ul>
                </div>
                </li>
            </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:././partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="javascript:;" target="_blank">Inventory System</a> from our company.</span>
                    <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2025. All rights reserved.</span>
                    </div>
                </footer>
            <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->

        </div>
        <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
        <script src="{{ asset('js/off-canvas.js') }}"></script>
        <script src="{{ asset('js/template.js') }}"></script>
        <script src="{{ asset('js/settings.js') }}"></script>
        <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('js/todolist.js') }}"></script>
        <script src="{{ asset('js/alerts.js') }}"></script>
        <script src="{{ asset('js/select2.js') }}"></script>
        <script src="{{ asset('js/data-table.js') }}"></script>
    </body>
</html>
