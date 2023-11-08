<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href="dashboard.php" class="logo">
                    <img src="layout_dashboard/assets/img/logo.png" alt="">
                </a>
                <a href="dashboard.php" class="logo-small">
                    <img src="layout_dashboard/assets/img/logo-small.png" alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="#">
                            <div class="searchinputs">
                                <input type="text" placeholder="Search Here ...">
                                <div class="search-addon">
                                    <span><img src="layout_dashboard/assets/img/icons/closes.svg" alt="img"></span>
                                </div>
                            </div>
                            <a class="btn" id="searchdiv"><img src="layout_dashboard/assets/img/icons/search.svg" alt="img"></a>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="layout_dashboard/assets/img/profiles/avator1.jpg" alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="layout_dashboard/assets/img/profiles/avator1.jpg" alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>John Doe</h6>
                                    <h5>Admin</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i> My
                                Profile</a>
                            <a class="dropdown-item" href="generalsettings.html"><i class="me-2" data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="signin.html"><img src="layout_dashboard/assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>


            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="generalsettings.html">Settings</a>
                    <a class="dropdown-item" href="signin.html">Logout</a>
                </div>
            </div>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="active">
                            <a href="dashboard.php"><img src="layout_dashboard/assets/img/icons/dashboard.svg" alt="img"><span>
                                    Dashboard</span> </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="layout_dashboard/assets/img/icons/product.svg" alt="img"><span>
                                    Product</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="addproduct.php">Add Product</a></li>
                                <li><a href="listproduct.php">Product List</a></li>
                                <li><a href="edit-product.php">Product Edit</a></li>
                                <li><a href="product-update.php">Product update</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="layout_dashboard/assets/img/icons/product.svg" alt="img"><span>
                                    Category</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="addCategory.php">Add Category</a></li>
                                <li><a href="listCategory.php">Category List</a></li>
                                <li><a href="edit-category.php">Category Edit</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="layout_dashboard/assets/img/icons/users1.svg" alt="img"><span>
                                    Users</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="customerlist.php">New User </a></li>
                                <li><a href="addcustomer.php">Users List</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="layout_dashboard/assets/js/jquery-3.6.0.min.js"></script>

    <script src="layout_dashboard/assets/js/feather.min.js"></script>

    <script src="layout_dashboard/assets/js/jquery.slimscroll.min.js"></script>

    <script src="layout_dashboard/assets/js/jquery.dataTables.min.js"></script>
    <script src="layout_dashboard/assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="layout_dashboard/assets/js/bootstrap.bundle.min.js"></script>

    <script src="layout_dashboard/assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="layout_dashboard/assets/plugins/apexchart/chart-data.js"></script>

    <script src="layout_dashboard/assets/js/script.js"></script>
</body>

</html>