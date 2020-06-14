<?php

  session_start();

  // DATABASE CONNECTION //
  $db = mysqli_connect("localhost" , "root" , "" , "ams");

  if(!$db) {
    die("Connection failed: ".mysqli_connect_error());
  }
  // DATABASE CONNECTION //


  // LOGIN MODULE //
  if(isset($_POST['login'])) {

    try {
          $uid = mysqli_real_escape_string($db,$_POST['emp_id']);
          $password = mysqli_real_escape_string($db,$_POST['u_password']);

          $sql = "SELECT * FROM accounts WHERE emp_id = '$uid' AND u_password = '$password'";
          $result = mysqli_query($db, $sql);

          if (!$row = $result->fetch_assoc()){
            echo "<script>alert('Username or Password is Incorrect ! ');window.location.href='index.php';</script>";
          }

          else {
                  $_SESSION['emp_id'] = $row['id'];
                  $sql = "SELECT * FROM accounts WHERE emp_id = '$uid' and u_password = '$password' ";
                  $result = mysqli_query($db, $sql);
                  $row = $result->fetch_assoc();
                  $_SESSION['username'] = $uid;

                  if ($row['u_type'] === 'admin')
                        header("Location: admin_home.php");

                  elseif ($row['u_type'] === 'faculty')
                        header("Location: faculty_home.php");

                  else
                  echo "<script>alert('ERROR 0x1000');window.location.href='index.php';</script>";

                  die();
              }
        } catch (Exception $e) {
            die("ERROR 0x1000 CONTACT DEVELOPER");
        }
    }
    // LOGIN MODULE //


    // ADD SUBJECT MODULE //
    if(isset($_POST['ADD_SUBJECT'])) {
      $e;
      try {
        $sub_name = $_POST["subject_name"];
        $sub_fac = $_POST["assigned_faculty"];
        $sub_sec = $_POST["subject_section"];

        $sql = "INSERT INTO subject (sub_name, sec_id, emp_id) VALUES ('$sub_name', '$sub_sec', '$sub_fac')";
        $result = mysqli_query($db, $sql);

        echo "<script>alert('SUBJECT HAS BEEN ADDED');window.location.href='admin_subjects.php';</script>";

      } catch (Exception $e) {
          die("ERROR 0x1001 CONTACT DEVELOPER");
      }
    }
    // ADD SUBJECT MODULE //

    // ADD SECTION MODULE //
    if(isset($_POST['ADD_SECTION'])) {
      $e;
      try {
        $sec_name = $_POST["section_name"];
        $sql = "INSERT INTO section (sec_name) VALUES ('$sec_name')";
        $result = mysqli_query($db, $sql);

        echo "<script>alert('SECTION HAS BEEN ADDED');window.location.href='admin_sections.php';</script>";

      } catch (Exception $e) {
          die("ERROR 0x1002 CONTACT DEVELOPER");
      }
    }
    // ADD SECTION MODULE //

    // ADD FACULTY MODULE //
    if(isset($_POST['ADD_FACULTY'])) {
      $e;
      try {
        $fac_id = $_POST["faculty_id"];
        $fac_name = $_POST["faculty_name"];
        $fac_bday = $_POST["faculty_bday"];
        $fac_type = "faculty";

        $sql = "INSERT INTO FACULTY (emp_id, emp_name, emp_bday, emp_type) VALUES ('$fac_id', '$fac_name', '$fac_bday', '$fac_type')";
        $result = mysqli_query($db, $sql);

        $sql2 = "INSERT INTO accounts (emp_id, u_password, u_name, u_type) VALUES ('$fac_id', '$fac_bday', '$fac_name', '$fac_type')";
        $result = mysqli_query($db, $sql2);

        echo "<script>alert('FACULTY HAS BEEN ADDED');window.location.href='admin_faculty.php';</script>";

      } catch (Exception $e) {
          die("ERROR 0x1003 CONTACT DEVELOPER");
      }
    }
    // ADD FACULTY MODULE //

    // ADD STUDENT MODULE //
    if(isset($_POST['ADD_STUDENT'])) {
      $e;
      try {
        $stud_id = $_POST["student_id"];
        $stud_card = $_POST["student_card"];
        $stud_name = $_POST["student_name"];

        $sql = "INSERT INTO students (student_id, student_card, student_name) VALUES ('$stud_id', '$stud_card', '$stud_name')";
        $result = mysqli_query($db, $sql);

        echo "<script>alert('SUBJECT HAS BEEN ADDED');window.location.href='admin_students.php';</script>";

      } catch (Exception $e) {
          die("ERROR 0x1004 CONTACT DEVELOPER");
      }
    }
    // ADD STUDENT MODULE //

    // ADD STUDENT SECTION MODULE //
    if(isset($_POST["student_section_id"]))
    {
      $sec_id = $_POST['student_section_id'];
      $output = '';
      $sql = "SELECT student_name, student_id FROM students WHERE student_id NOT IN (SELECT student_id FROM enrolled)";
      $result = mysqli_query($db, $sql);

      $output .= '
        <div class="table-responsive">
        <table id="example3" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
              <thead align="center">
                <tr>
                  <th>STUDENT NAME</th>
                  <th><input type="checkbox" id="checkAll"></th>
                </tr>
              </thead>
              <tbody align="center">
              <form method="POST">
      ';
      while($row = mysqli_fetch_array($result))
      {
           $output .= '
               <tr>
                 <td>'.$row["student_name"].'</td>
                 <td>
                 <input type="checkbox" name="selected[]" value='.$row['student_id'].'">
                 <input type ="text" name = "sc_id" value = '.$sec_id.' hidden>
                 </td>
               </tr>
                ';
      }
        $output .= "
                </tbody>
              </table>
            </div>
       </form>
       <script>
       $(document).ready(function() {
          $.fn.DataTable.ext.pager.numbers_length = 5;
            $('#example3').DataTable( {
               'pagingType':'full_numbers'
            } );
         } );
       </script>
       <script>
       $('#checkAll').click(function() {
          $('input:checkbox').not(this).prop('checked', this.checked);
       });
       </script>
       ";
      echo $output;
    }

    if(isset($_POST['ADD_STUDENT_SECTION'])) {
      $e;
      try {

        $sec_id = $_POST['sc_id'];
        $checkBox = $_POST['selected'];
        $count = count($checkBox);

        if($count <= 40)
        {
          for ($i=0; $i<sizeof($checkBox); $i++)
          {
            $sql = "INSERT INTO enrolled (sec_id, student_id) VALUES ('$sec_id', '$checkBox[$i]')";
            $result = mysqli_query($db, $sql);
            echo "<script>alert('STUDENT HAS BEEN ADDED TO SECTION');window.location.href='admin_sections.php';</script>";
          }
        }
        else
        {
          echo "<script>alert('YOU SELECTED MORE THAN 40 STUDENTS');window.location.href='admin_sections.php';</script>";
        }

      } catch (Exception $e) {
          die("ERROR 0x1005 CONTACT DEVELOPER");
      }
    }
    // ADD STUDENT SECTION MODULE //

    // DELETE SUBJECT MODULE //
    if(isset($_POST["edit_id"]))
    {
      $subject_id = $_POST['edit_id'];

      $output = '';
      $sql = "SELECT * FROM subject WHERE sub_id = '".$subject_id."'";
      $result = mysqli_query($db, $sql);

      $output .= '<form method="POST">';
      while($row = mysqli_fetch_array($result))
      {
           $output .= '
               <input type ="text" class="form-control" name="del_id" value='.$subject_id.' hidden>
               <h5><p style="color: red;"><i><b>THIS ACTION IS IREVERSABLE ARE YOU SURE WITH THIS ACTION?</b></i></p></h5>
                ';
      }
        $output .= "</form>";
      echo $output;

    }

    if(isset($_POST['UPDATE_SUBJECT'])) {
      $e;
      try {

          $delete = $_POST["del_id"];
          $sql = "DELETE FROM subject WHERE sub_id = '$delete'";
          $result = mysqli_query($db, $sql);

          echo "<script>alert('SUBJECT HAS BEEN DELETED');window.location.href='admin_subjects.php';</script>";

      } catch (Exception $e) {
          die("ERROR 0x1006 CONTACT DEVELOPER");
      }
    }
    // DELETE SUBJECT MODULE //

    // UPDATE STUDENT CARD MODULE //
    if(isset($_POST["register_id"]))
    {
      $stud_id = $_POST['register_id'];

      $output = '';
      $sql = "SELECT * FROM students WHERE student_id = '".$stud_id."'";
      $result = mysqli_query($db, $sql);

      $output .= '<form method="POST">';
      while($row = mysqli_fetch_array($result))
      {
           $output .= '
               <input type ="text" class="form-control" name="stud_id" value='.$stud_id.' hidden>
               <labeL>CARD NUMBER</label>
               <input type ="text" class="form-control" name="reg_id">
                ';
      }
        $output .= "</form>";
      echo $output;

    }

    if(isset($_POST['REGISTER_CARD'])) {
      $e;
      try {

          $stud_id = $_POST["stud_id"];
          $reg_id = $_POST["reg_id"];
          $sql = "UPDATE students SET student_card = '".$reg_id."' WHERE student_id = '".$stud_id."'";
          $result = mysqli_query($db, $sql);

          echo "<script>alert('CARD HAS BEEN REGISTERED');window.location.href='admin_students.php';</script>";

      } catch (Exception $e) {
          die("ERROR 0x1007 CONTACT DEVELOPER");
      }
    }
    // UPDATE STUDENT CARD MODULE //

    // DELETE FACULTY MODULE //
    if(isset($_POST["delete_id"]))
    {
      $faculty_id = $_POST['delete_id'];

      $output = '';
      $sql = "SELECT * FROM faculty WHERE emp_id = '".$faculty_id."'";
      $result = mysqli_query($db, $sql);

      $output .= '<form method="POST">';
      while($row = mysqli_fetch_array($result))
      {
           $output .= '
               <input type ="text" class="form-control" name="del_id" value='.$faculty_id.' hidden>
               <h5><p style="color: red;"><i><b>THIS ACTION IS IREVERSABLE ARE YOU SURE WITH THIS ACTION?</b></i></p></h5>
                ';
      }
        $output .= "</form>";
      echo $output;

    }

    if(isset($_POST['DELETE_FACULTY'])) {
      $e;
      try {

          $delete = $_POST["del_id"];
          $sql = "DELETE FROM faculty WHERE emp_id = '$delete'";
          $result = mysqli_query($db, $sql);

          echo "<script>alert('SUBJECT HAS BEEN DELETED');window.location.href='admin_faculty.php';</script>";

      } catch (Exception $e) {
          die("ERROR 0x1008 CONTACT DEVELOPER");
      }
    }
    // DELETE FACULTY MODULE //

    // SEND MESSAGE MODULE //
    if(isset($_POST['SEND'])) {
      $e;
      try {

          $rep = $_POST['recipient'];
          $title = $_POST['title'];
          $mes = $_POST['messages'];
          $flag = 0;

          $sql = "INSERT INTO message (emp_id, message_title, message, flag) VALUES ('$rep', '$title', '$mes', '$flag')";
          $result = mysqli_query($db, $sql);

          echo "<script>alert('YOUR MESSAGE HAS BEEN SENT');window.location.href='admin_message.php';</script>";

      } catch (Exception $e) {
          die("ERROR 0x1009 CONTACT DEVELOPER");
      }
    }
    // SEND MESSAGE MODULE //

    // ATTENDANCE VIEW //
    if(isset($_POST["attendance_id"]))
    {
      $attendance_id = $_POST['attendance_id'];
      $output = '';
      $sql = "SELECT students.student_name,attendance.attendance FROM attendance,students,section WHERE attendance.stud_id = students.student_id AND attendance.sec_id = section.sec_id AND attendance.sub_id =  '".$attendance_id."'";
      $result = mysqli_query($db, $sql);
      $output .= '
        <div class="table-responsive">
        <table id="example3" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
              <thead align="center">
                <tr>
                  <th>STUDENT NAME</th>
                  <th>ATTENDANCE</th>
                </tr>
              </thead>
              <tbody align="center">
              <form method="POST">
      ';
      while($row = mysqli_fetch_array($result))
      {
           $output .= '
               <tr>
                 <td>'.$row["student_name"].'</td>
                 <td>'.$row["attendance"].'</td>
               </tr>
                ';
      }
        $output .= "
                </tbody>
              </table>
            </div>
       </form>
       <script>
       $(document).ready(function() {
          $.fn.DataTable.ext.pager.numbers_length = 5;
            $('#example3').DataTable( {
               'pagingType':'full_numbers'
            } );
         } );
       </script>
       ";
      echo $output;
    }
    // ATTENDANCE VIEW //

    // CHECK ATTENDANCE SESSION //
    if(isset($_POST["stud_id_attendance"]))
    {
          $_SESSION['stud_id_attendance'] = $_POST["stud_id_attendance"];
    }
    // CHECK ATTENDANCE SESSION //

    // SEND ATTENDANCE SESSION //
    if(isset($_POST["send_attendance"]))
    {
      $sub_id = $_POST['sub_id'];
      $sec_id = $_POST['sec_id'];
      $stud_id = $_POST['stud_id'];
      $date = $_POST['attendance_date'];

      $sql = "INSERT INTO attendance (sub_id, sec_id, stud_id, attendance) VALUES ('$sub_id','$sec_id', '$stud_id', '$date')";
      $result = mysqli_query($db, $sql);

      $sql2 = "SELECT * FROM students WHERE student_card = '$stud_id'";
      $result2 = mysqli_query($db, $sql2);

      if (!$row = $result2->fetch_assoc()){
        echo "<script>alert('No student found');window.location.href='faculty_attendance.php';</script>";
      }
      else{
      require('vendor/autoload.php');
      $MessageBird = new \MessageBird\Client('FCUd4SwytMWlDXRgYeIoJyWdW');
      $Message = new \MessageBird\Objects\Message();
      $Message->originator = +639065186524;
      $Message->recipients = array($row['parents_contact']);
      $Message->body = 'THIS IS A MESSAGE FROM (STA. ELENA ATTENDANCE ALERT), INFORMING YOU THAT YOUR SON/DAUGHTER HAS CHECKED HIS/HER ATTENDANCE FOR HIS/HER SUBJECT.';

      $MessageBird->messages->create($Message);
      }
    }
    // SEND ATTENDANCE SESSION //

    // READ MESSAGE SESSION //
    if(isset($_POST["message_id"]))
    {
      $mes_id = $_POST["message_id"];
      $output = '';
      $sql = "SELECT * FROM message WHERE message_id = '".$mes_id."'";
      $result = mysqli_query($db, $sql);
      $output .= '
      ';
      while($row = mysqli_fetch_array($result))
      {
        $sender = $row['sender_id'];
        $title = $row['message_title'];
        $message = $row['message'];
           $output .= '
                <input type="text" class="form-control" value="'.$sender.'" disabled>
                <br>
                <input type="text" class="form-control" value="'.$title.'" disabled>
                <br>
                <textarea name="messages" style="width: 100%; height: 100px;" cols="50" placeholder="'.$message.'"disabled></textarea>
                ';
      }
        $output .= "
       ";
      echo $output;

    }
    // READ MESSAGE SESSION //

    //UPLOAD STUDENT MODULE//
    $connect = mysqli_connect("localhost", "root", "", "ams");
    $message = '';

    if(isset($_POST["uploadstud"]))
    {
      $e;
      try {
           if($_FILES['importstud']['name'])
           {
            $filename = explode(".", $_FILES['importstud']['name']);
            if(end($filename) == "csv")
            {
             $handle = fopen($_FILES['importstud']['tmp_name'], "r");
             while($data = fgetcsv($handle))
             {
              $stud_id = mysqli_real_escape_string($connect, $data[0]);
              $stud_name = mysqli_real_escape_string($connect, $data[1]);
              $query = "INSERT INTO students (student_id, student_name) VALUES('$stud_id', '$stud_name')";
              mysqli_query($connect, $query);
             }
             fclose($handle);
             echo "<script>alert('STUDENT LIST HAS BEEN IMPORTED');window.location.href='admin_students.php';</script>";
             //header("location: adminmanage.php?updation=1");
            }
            else
            {
              echo "<script>alert('FILE ATTACHED IS NOT CSV');window.location.href='admin_students.php';</script>";
            }
           }
           else
           {
            echo "<script>alert('PLEASE ATTACH A FILE');window.location.href='admin_students.php';</script>";
           }
        } catch (Exception $e) {
            die("ERROR 0x1010 CONTACT DEVELOPER");
        }
      }

    //UPLOAD STUDENT MODULE//

?>
