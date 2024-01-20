<?php

session_start();
$type = "staff";
$type2 = "admin";
?>
<style>
   #link:hover
    {
     background-color: gold;
    }
</style>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
 
        <li class="nav-item">
            <a id="link" class="nav-link" href="../login/dashboard.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../reservation/reservation.php">
                <i class='bx bx-notepad'></i>
                <span>Reservation</span>
            </a>
        </li>  
        
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../archive-reservation/archive.php">
                <i class="bi bi-person"></i>
                <span>Archive Reservation</span>
            </a>
        </li>
        

        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../sales/sales.php">
                <i class='bx bx-receipt'></i>
                <span>Sales</span>
            </a>
        </li>


        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../calendar/index.php">
            <i class="bi bi-calendar"></i>
                <span>Calendar</span>
            </a>
        </li> 

        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../reports/index.php">
                <i class='bx bxs-report'></i>
                <span>Reports</span>
            </a>
        </li>
        

       
     
        <li class="nav-heading">Maintenance</li>
       
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../admin/admin-user.php">
                <i class="bi bi-person"></i>
                <span>Admin</span>
            </a>
        </li>    

        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../admin/archive.php">
                <i class="bi bi-person"></i>
                <span>Archive Admin</span>
            </a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../user_account/user_account.php">
                <i class="bi bi-person"></i>
                <span>User Account  </span>
            </a>
        </li>
  
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../user_account/archive.php">
                <i class="bi bi-person"></i>
                <span>Archive Account  </span>
            </a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../package/package.php">
                <i class='bx bx-package' ></i>
                <span>Package</span>
            </a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../maintenance/menu.php">
                <i class="bi bi-menu-button"></i>
                <span>Menu</span>
            </a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../maintenance/review.php">
                <i class="bi bi-star"></i>
                <span>Review</span>
            </a>
        </li>
        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../maintenance/about.php">
                <i class="bi bi-card-list"></i>
                <span>About Us</span>
            </a>
        </li>

        <li class="nav-item">
            <a id="link" class="nav-link collapsed" href="../maintenance/contact.php">
                <i class="bi bi-telephone-fill"></i>
                <span>Contact Us</span>
            </a>
        </li>

        <li class="nav-item">
            <a  id="link" class="nav-link collapsed" href="../maintenance/maintenance.php">
                <i class="bi bi-gear-fill"></i>
                <span>Maintenance</span>
            </a>
        </li>  

        <li class="nav-item">
            <a  id="link" class="nav-link collapsed" href="../archive/archive.php">
                <i class="bi bi-archive"></i>
                <span>Archive</span>
            </a>
        </li>
      
      
     
    </ul>

</aside><!-- End Sidebar-->
<?php include '../include/top.php'; ?>