<?php
include("core.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AMS | FACULTY</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/font.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script src="assets/1.js"></script>
  <script src="assets/2.js"></script>
  <script src="assets/3.js"></script>

  <style>
    .a-tooltip {
      position: relative;
      display: inline-block;
    }

    .a-tooltip .tooltiptext {
      visibility: hidden;
      width: 120px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;

      /* Position the tooltip */
      position: absolute;
      z-index: 1;
      bottom: 100%;
      left: 50%;
      margin-left: -60px;
    }

    .a-tooltip:hover .tooltiptext {
      visibility: visible;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AMS <sup>|</sup> FACULTY</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="faculty_home.php">
          <i class="fas fa-book"></i>
          <span>SUBJECTS</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="faculty_inbox.php">
          <i class="fas fa-inbox"></i>
          <span>MESSAGES</span></a>
      </li>

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

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <div class="input-group-append">

              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">

                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                $try = $_SESSION['username'];
                $sql = "SELECT * FROM accounts WHERE emp_id = '".$try."'";
                $result = mysqli_query($db, $sql);
                while($row = mysqli_fetch_array($result))
                {
                ?>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b><?php echo strtoupper($row['u_name']); ?></b></span>
                <?php
                }
                ?>
                <img class="img-profile rounded-circle" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">SUBJECT LIST</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <br>
                  <thead align="center">
                    <tr>
                      <th><b>SUBJECT NAME</b></th>
                      <th><b>SECTION NAME</b></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody align="center">
                    <?php
                    $try = $_SESSION['username'];
                    $sql = "SELECT subject.sub_id,subject.sub_name , section.sec_name FROM subject,section WHERE emp_id = '".$try."' AND subject.sec_id = section.sec_id";
                    $result = mysqli_query($db, $sql);
                    while($row = mysqli_fetch_array($result))
                    {
                    ?>
                    <tr>
                      <td><?php echo strtoupper($row["sub_name"]); ?></td>
                      <td><?php echo strtoupper($row["sec_name"]); ?></td>
                      <td>
                        <button id="<?php echo $row['sub_id']; ?>" class="btn btn-primary btn-xs attendance_view a-tooltip">
                          <i class = "fa fa-users"></i>
                          <span class="tooltiptext">ATTENDANCE</span>
                        </button>
                        <button id="<?php echo $row['sub_id']; ?>" class="btn btn-success btn-xs check_attendance a-tooltip">
                          <i class = "fa fa-check"></i>
                          <span class="tooltiptext">CHECK ATTENDANCE</span>
                        </button>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Logout Modal-->

  <!-- ADD SECTION Modal-->
  <div class="modal fade" id="add_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADDING -> SECTION</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST">
            <div class="modal-body">
              <b><label>SECTION NAME</label></b>
              <input type = "text" class = "form-control" name = "section_name" placeholder = "NAME OF SECTION">
              <br>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">CANCEL</button>
              <input type = "submit" class="btn btn-primary" value = "ADD" name = "ADD_SECTION"></a>
        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- ADD SECTION MODAL -->

  <!-- VIEW STUDENT ATTENDANCE Modal-->
  <div id="attendance_modal" class="modal fade">
       <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">ATTENDANCE</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form action="core.php" method="POST" >
                 <div class="modal-body" id="attendance_details">
                 </div>
                 <div class="modal-footer">
                 </div>
                 </form>
            </div>
       </div>
  </div>

  <script>
  $(document).ready(function(){
       $('.attendance_view').click(function(){
         var attendance_id = $(this).attr("id");
            $.ajax({
                 url:"core.php",
                 method:"post",
                    data:{attendance_id:attendance_id},
                 success:function(data){
                      $('#attendance_details').html(data);
                      $('#attendance_modal').modal("show");
                 }
            });
       });
  });
  </script>
  <!-- VIEW STUDENT ATTENDANCE Modal-->

  <!-- CHECK ATTENDANCE SCRIPT -->
  <script>
  $(document).ready(function(){
       $('.check_attendance').click(function(){
            var stud_id_attendance = $(this).attr("id");
            $.ajax({
                 url:"core.php",
                 method:"post",
                 data:{stud_id_attendance:stud_id_attendance},
                 success:function(data){
                   window.location="faculty_attendance.php";
                 }
            });
       });
  });
  </script>
  <!-- CHECK ATTENDANCE SCRIPT --> 

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

</body>

</html>
