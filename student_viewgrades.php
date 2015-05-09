<?php

//check user status
session_start();

if($_SESSION['type'] != '3'){ // not an student
    header( 'Location: index.php' ) ;
}

include_once 'db_connect.php';
include_once 'function.php';

$cwid = $_SESSION['cwid'];
$cnum = $_GET['cnum'];
$snum = $_GET['snum'];

$grades = get_gradebysection($cwid, $cnum, $snum, $mysqli);

$pageTitle = "Student - View your grades";
$pageCSSClass = "student";
?>

<?php include 'partials/header.php'; ?>

      <div class="row">
        <div class="col-xs-12">
            <?php include 'partials/nav-student.php'; ?>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/student.php">Student</a></li>
                <li class="active">View Sections</li>
            </ol>
            <table class='table' >
            	<tr>
            	<th>Course Number</th>
            	<th>Section Number</th>
            	<th></th>
            	<th>GRADE</th>
            	</tr>

              <?php while ($grade = $grades->fetch_assoc()) { 
                echo '<tr><td>' . $grade["Cnum"] . '</td><td>' . 
                $grade["Snum"] . '</td><td>' . $grade["SType"] . '</td><td>' . 
                $grade["Score"] . '</td><</td></tr>';
              }
              ?>
              
              </table>

        </div>
      </div>

<?php include 'partials/footer.php'; ?>