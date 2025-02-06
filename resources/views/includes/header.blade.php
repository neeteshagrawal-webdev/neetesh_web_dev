<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>KMS</title>
<!-- Custom fonts for this template -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">
<!-- Custom fonts for this template -->
<link href="{{asset('assets/admin_css/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">
<!-- Custom styles for this template -->
<link href="{{asset('assets/admin_css/css/sb-admin-2.min.css')}}" rel="stylesheet">
<!-- Custom styles for this page -->
<link href="{{asset('assets/admin_css/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="{{ asset('assets/admin_css/img/logoSnT2.png')}}">
<style>
.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #7c2749 !important;
    border-color: #7c2749 !important;
}
.navbar-nav {
    line-height: 1; /* Default for desktop */
}

@media (max-width: 1024px) { /* For tablets and smaller screens */
    .navbar-nav {
        line-height: 1.5;
    }
}

@media (max-width: 768px) { /* For mobile screens */
    .navbar-nav {
        line-height: 1.5;
    }
}
</style>
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
<!-- Sidebar -->
<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #003366;">
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
<div class="sidebar-brand-icon rotate-n-0">
<!-- <i class="fas fa-laugh-wink"></i> -->
<img style="width:60px;" src="{{ asset('assets/admin_css/img/logoSnT2.png')}}" alt=" Logo">
</div>
<div class="sidebar-brand-text mx-3" style="font-size: 1.8rem;"></div>
</a>
<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- Heading -->
<div class="sidebar-heading mt-3" style="color: white;">
General
</div> 
<!-- Nav Item - Dashboard -->
<li class="nav-item">
<a class="nav-link" href="{{route('home')}}">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Home</span></a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
    aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-th-large"></i>
        <span>Masters</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('uploads.show')}}">Uploads</a>
            <a class="collapse-item" href="{{route('scroll.message')}}">Scroll Message</a>
            <a class="collapse-item" href="{{route('users.show')}}">User</a>
            <a class="collapse-item" href="{{route('login.activity')}}">Login Activity</a>
        </div>
    </div>
</li>   
<li class="nav-item">
    <a class="nav-link" href="{{route('user.report')}}">
        <i class="fas fa-layer-group"></i> <!-- Category icon -->
        <span>Reports</span>
    </a>
</li>


<!--{% comment %} <li class="nav-item">-->
<!--    <a class="nav-link" href="">-->
<!--        <i class="fas fa-id-card"></i>-->
<!--        <span>eKYC / Authorisation</span></a>-->
<!--</li>-->

<!--<li class="nav-item">-->
<!--    <a class="nav-link" href="">-->
<!--        <i class="fas fa-id-card"></i>-->
<!--        <span>User</span></a>-->
<!--</li>-->

<!--<div class="sidebar-heading mt-3" style="color: white;">-->
<!--    Reports-->
<!--</div> -->


<!--<li class="nav-item">-->
<!--    <a class="nav-link" href="">-->
<!--        <i class="fas fa-file-alt"></i>-->
<!--        <span>Submission</span></a>-->
<!--</li>-->
<!--{% endcomment %}-->
<!-- <li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefour"
aria-expanded="true" aria-controls="collapseTwo">
<i class="fas fa-th-large"></i>
<span>Directory</span>
</a>
<div id="collapsefour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">

<a class="collapse-item" href=">About Us</a>


</div>
</div>
</li>  


<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefive"
aria-expanded="true" aria-controls="collapseTwo">
<i class="fas fa-th-large"></i>
<span>Policies</span>
</a>
<div id="collapsefive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">

<a class="collapse-item" href="">Name</a>
<a class="collapse-item" href="">Details</a>

</div>

</li>  -->

<!--{% comment %} <li class="nav-item">-->
<!--    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesix"-->
<!--        aria-expanded="true" aria-controls="collapseTwo">-->
<!--       <i class="fas fa-th-large"></i>-->
<!--        <span>Policies Details</span>-->
<!--    </a>-->
<!--    <div id="collapsesix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">-->
<!--        <div class="bg-white py-2 collapse-inner rounded">-->

<!--            <a class="collapse-item" href="">Terms & Conditions Details</a>-->


<!--        </div>-->
<!--    </div>-->
<!--</li>   {% endcomment %}-->

<!--{% comment %} <li class="nav-item">-->
<!--    <a class="nav-link" href="">-->
<!--        <i class="fas fa-building"></i>-->
<!--        <span>Company Details</span></a>-->
<!--</li> {% endcomment %}-->

<!-- <li class="nav-item">
<a class="nav-link" href="">
<i class="fas fa-industry"></i>
<span>Industry Category</span></a>
</li> -->




<!-- <li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
aria-expanded="true" aria-controls="collapseTwo">
<i class="fas fa-th-large"></i>
<span>Products</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">

<a class="collapse-item" href="">Category</a>
<a class="collapse-item" href="#">Product/Services</a>

</div>
</div>
</li>   -->

<!--{% comment %} <li class="nav-item">-->
<!--    <a class="nav-link" href="">-->
<!--        <i class="fas fa-th-large"></i>-->
<!--        <span>Category for Product/Services</span></a>-->
<!--</li> {% endcomment %}-->

<!--{% comment %} <li class="nav-item">-->
<!--    <a class="nav-link" href="">-->
<!--        <i class="fas fa-box-open"></i>-->
<!--        <span>Product/Services</span></a>-->
<!--</li> {% endcomment %}-->

<!-- <li class="nav-item">
<a class="nav-link" href="">
<i class="fas fa-blog"></i>
<span>Blogs</span></a>
</li>  -->
<!-- <li class="nav-item">
<a class="nav-link" href="">
<i class="fas fa-info-circle"></i>
<span>FAQs</span></a>
</li>


<li class="nav-item">
<a class="nav-link" href="">
<i class="fas fa-user-circle"></i>
<span>Profile</span></a>
</li>
<li class="nav-item">
<a class="nav-link" href="">
<i class="fas fa-question-circle"></i>
<span>Help</span></a>
</li> -->
<!-- Divider -->
<!-- <hr class="sidebar-divider"> -->

<!-- Heading -->
<!-- <div class="sidebar-heading">
Interface
</div> -->

<!-- Nav Item - Pages Collapse Menu -->


<!-- Nav Item - Utilities Collapse Menu -->
<!-- <li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-fw fa-wrench"></i>
<span>Utilities</span>
</a>
<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header">Custom Utilities:</h6>
<a class="collapse-item" href="utilities-color.html">Colors</a>
<a class="collapse-item" href="utilities-border.html">Borders</a>
<a class="collapse-item" href="utilities-animation.html">Animations</a>
<a class="collapse-item" href="utilities-other.html">Other</a>
</div>
</div>
</li> -->

<!-- Divider -->
<!-- <hr class="sidebar-divider"> -->

<!-- Heading -->
<!-- <div class="sidebar-heading">
Addons
</div> -->

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
aria-expanded="true" aria-controls="collapsePages">
<i class="fas fa-fw fa-folder"></i>
<span>Pages</span>
</a>
<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
<h6 class="collapse-header">Login Screens:</h6>
<a class="collapse-item" href="login.html">Login</a>
<a class="collapse-item" href="register.html">Register</a>
<a class="collapse-item" href="forgot-password.html">Forgot Password</a>
<div class="collapse-divider"></div>
<h6 class="collapse-header">Other Pages:</h6>
<a class="collapse-item" href="404.html">404 Page</a>
<a class="collapse-item" href="blank.html">Blank Page</a>
</div>
</div>
</li> -->

<!-- Nav Item - Charts -->
<!-- <li class="nav-item">
<a class="nav-link" href="charts.html">
<i class="fas fa-fw fa-chart-area"></i>
<span>Charts</span></a>
</li> -->

<!-- Nav Item - Tables -->
<!-- <li class="nav-item active">
<a class="nav-link" href="tables.html">
<i class="fas fa-fw fa-table"></i>
<span>Tables</span></a>
</li> -->

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->

<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
<i class="fa fa-bars"></i>
</button>



<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none">
<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-search fa-fw"></i>
</a>
<!-- Dropdown - Messages -->
<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
aria-labelledby="searchDropdown">
<form class="form-inline mr-auto w-100 navbar-search">
<div class="input-group">
<input type="text" class="form-control bg-light border-0 small"
placeholder="Search for..." aria-label="Search"
aria-describedby="basic-addon2">
<div class="input-group-append">
<button class="btn btn-primary" type="button">
<i class="fas fa-search fa-sm"></i>
</button>
</div>
</div>
</form>
</div>
</li>



<!-- Nav Item - Messages -->
<li class="nav-item dropdown no-arrow mx-1">
<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-envelope fa-fw"></i>
<!-- Counter - Messages -->
<span class="badge badge-danger badge-counter">7</span>
</a>
<!-- Dropdown - Messages -->
<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
aria-labelledby="messagesDropdown">
<h6 class="dropdown-header">
Message Center
</h6>
<a class="dropdown-item d-flex align-items-center" href="#">
<div class="dropdown-list-image mr-3">
<img class="rounded-circle" src="{{asset('assets/admin_css/img/undraw_profile_1.svg')}}"
alt="...">
<div class="status-indicator bg-success"></div>
</div>
<div class="font-weight-bold">
<div class="text-truncate">Hi there! I am wondering if you can help me with a
problem I've been having.</div>
<div class="small text-gray-500">Emily Fowler 路 58m</div>
</div>
</a>
<a class="dropdown-item d-flex align-items-center" href="#">
<div class="dropdown-list-image mr-3">
<img class="rounded-circle" src="{{asset('assets/admin_css/img/undraw_profile_2.svg')}}"
alt="...">
<div class="status-indicator"></div>
</div>
<div>
<div class="text-truncate">I have the photos that you ordered last month, how
would you like them sent to you?</div>
<div class="small text-gray-500">Jae Chun 路 1d</div>
</div>
</a>
<a class="dropdown-item d-flex align-items-center" href="#">
<div class="dropdown-list-image mr-3">
<img class="rounded-circle" src="{{asset('assets/admin_css/img/undraw_profile_3.svg')}}"
alt="...">
<div class="status-indicator bg-warning"></div>
</div>
<div>
<div class="text-truncate">Last month's report looks great, I am very happy with
the progress so far, keep up the good work!</div>
<div class="small text-gray-500">Morgan Alvarez 路 2d</div>
</div>
</a>
<a class="dropdown-item d-flex align-items-center" href="#">
<div class="dropdown-list-image mr-3">
<img class="rounded-circle" src="{{asset('assets/admin_css/img/undraw_profile_1.svg')}}"
alt="...">
<div class="status-indicator bg-success"></div>
</div>
<div>
<div class="text-truncate">Am I a good boy? The reason I ask is because someone
told me that people say this to all dogs, even if they aren't good...</div>
<div class="small text-gray-500">Chicken the Dog 路 2w</div>
</div>
</a>
<a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
</div>
</li>

<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow"> 
<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

<span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>

<img class="img-profile rounded-circle"
src="{{asset('assets/admin_css/img/undraw_profile.svg')}}">
</a>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
aria-labelledby="userDropdown">
<!-- <a class="dropdown-item" href="#">
<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
Profile
</a>
<a class="dropdown-item" href="#">
<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
Settings
</a>
<a class="dropdown-item" href="#">
<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
Activity Log
</a>
<div class="dropdown-divider"></div> -->
<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
Logout
</a>
</div>
</li>

</ul>

</nav>
<!-- End of Topbar -->