<?php
include("core.php");
date_default_timezone_set('Asia/Manila');
$mix = date("Y-m-d h:i:s");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AMS | ATTENDANCE</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/font.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="">

  <div class="container">
    <br />
    <br />
    <br />
    <br />
    <br />
    <form method="POST">
    <?php 
    $id = $_SESSION['stud_id_attendance'];
    $sql = "SELECT * FROM subject WHERE sub_id = '".$id."' ";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result))
    {
        $sub_name = $row['sub_name'];
        $sub_id = $row['sub_id'];
    
    ?>
    <h1 align='center'><div id='time'></div></h1>
    <h1 align="center"> <b><?php echo $sub_name; ?></b> </h1>
    <input type="text" class="form-control" placeholder="ATTENDANCE CARD GOES HERE" name="stud_id" autofocus>
    <input type="text" value="<?php echo $row['sub_id']; ?>" name="sub_id" hidden>
    <input type="text" value="<?php echo $row['sec_id']; ?>" name="sec_id" hidden>
    <input type="text" value="<?php echo $mix; ?>" name="attendance_date" hidden>
    <input type="submit" name="send_attendance" hidden>
    <?php 
    }
    ?>
    </form>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script type="text/javascript">
    setInterval(function (){
    $('#time').load('timestamp.php').fadeIn("slow");
    }, 1000); // refresh every 10000 milliseconds
  </script>

</body>

</html>
