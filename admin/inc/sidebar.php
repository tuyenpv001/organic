 <?php 
    ob_start();
    $page = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'],'=')+1);
 ?>


 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://localhost/ogranic/admin/">
         <img src="../public/img/logo.svg" height="60px">
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item <?= $page == '' ? 'active': ''  ?>">
         <a class="nav-link" href="http://localhost/ogranic/admin/">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Thống kê</span></a>
     </li>



     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <!--  <div class="sidebar-heading">
                Trang
            </div> -->

     <!-- Nav Item - Order Collapse Menu -->
     <li class="nav-item <?= $page == 'orders' ? 'active': ''  ?>">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true"
             aria-controls="collapsePages">
             <i class="fas fa-fw fa-folder"></i>
             <span>Đơn hàng</span>
         </a>
         <div id="collapseOrder" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="?page=orders">Tất cả</a>
                 <a class="collapse-item" href="?page=orders&status=pending">Đang duyệt</a>
                 <a class="collapse-item" href="?page=orders&status=success">Thành công</a>
                 <a class="collapse-item" href="?page=orders&status=cancel">Thất bại</a>

             </div>
         </div>
     </li>


     <!-- Nav Item - Product Collapse Menu -->
     <li class="nav-item <?= $page == 'products' ? 'active': ''  ?>">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
             aria-expanded="true" aria-controls="collapseProduct">
             <i class="fas fa-fw fa-folder"></i>
             <span>Sản phẩm</span>
         </a>
         <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="?page=products">Tất cả</a>
                 <a class="collapse-item" href="?page=add-product">Thêm mới</a>
                 <a class="collapse-item" href="?page=sale-product">Giảm giá</a>
             </div>
         </div>
     </li>


     <!-- User -->
     <li class="nav-item <?= $page == 'users' ? 'active': ''  ?>">
         <a class="nav-link" href="?page=users">
             <i class="fas fa-fw fa-table"></i>
             <span>Khách hàng</span></a>
     </li>

     <!-- Staff -->

     <li class="nav-item <?= $page == 'members' ? 'active': ''  ?>">

         <a class="nav-link" href="?page=members"
             style=" <?php if(isset($_COOKIE['user_ad']) && $_COOKIE['user_ad']['role'] == 'member') echo 'display:none';?>">
             <i class="fas fa-fw fa-table"></i>
             <span>Nhân viên</span></a>
     </li>

     <!-- Admin -->
     <li class="nav-item <?= $page == 'account' ? 'active': ''  ?>">
         <a class="nav-link" href="?page=account">
             <i class="fas fa-fw fa-table"></i>
             <span>Cài đặt tài khoản</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>



 </ul>
 <!-- End of Sidebar -->

 <?php ob_flush(); ?>