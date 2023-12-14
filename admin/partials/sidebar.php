<style>
 

  /* Set the height of the sidebar */
  .main-sidebar .sidebar {
    height: 100vh; /* Adjust the height as needed */
    overflow-y: auto; /* Add scrollbars if the content exceeds the height */
  }
</style>


<?php 
$currentURL = $_SERVER['REQUEST_URI'];
?>


<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    
      <img src="partials/logos.jpg" alt="AdminLTE Logo" width="150px" class="brand-image img-circle elevation-3 mx-auto d-block mb-3 mt-5" style="opacity: .8">
     
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <?php
      require 'session.php';
      ?>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="dashboard" class="nav-link <?php if (strpos($currentURL, 'dashboard.php') || strpos($currentURL, 'dashboard') !== false) echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="question.php" class="nav-link <?php if (strpos($currentURL, 'question.php') !== false || strpos($currentURL, 'question') !== false) echo 'active'; ?>">
              <i class="nav-icon fas fa-question"></i>
              <p>
               Question

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="ccresponse" class="nav-link <?php if (strpos($currentURL, 'ccresponse.php') !== false || strpos($currentURL, 'ccresponse') !== false) echo 'active'; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
               CC Response

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sqresponse" class="nav-link <?php if (strpos($currentURL, 'sqresponse.php') !== false || strpos($currentURL, 'sqresponse') !== false) echo 'active'; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
               SQ Response

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="comments" class="nav-link <?php if (strpos($currentURL, 'comments.php') !== false || strpos($currentURL, 'comments') !== false) echo 'active'; ?>">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
               Comments

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a  class="nav-link tran">
            <i class="fas fa-times-circle nav-icon"></i>  
              <p>
              Empty Response
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="adminaccounts" class="nav-link <?php if (strpos($currentURL, 'adminaccounts.php') !== false || strpos($currentURL, 'adminaccounts') !== false) echo 'active'; ?>">
            <i class="fas fa-users  nav-icon"></i>  
              <p>
              Administrator Accounts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout" class="nav-link">
            <i class="fas fa-arrow-left nav-icon"></i>  
              <p>
              Log Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script>
    $(document).ready(function(){
        $('.tran').click(function(){
        //swalfire confirmation if yes got to delete.php else do nothing
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to empty all response?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Empty it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "emptyresponse";
            }
        })

        })
    })
  </script>