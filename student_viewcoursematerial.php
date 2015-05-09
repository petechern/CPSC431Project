<?php

//check user status
session_start();

if($_SESSION['type'] != '3'){ // not an student
    header( 'Location: index.php' ) ;
}

include_once 'db_connect.php';
include_once 'function.php';

$cnum = $_GET['cnum'];
$snum = $_GET['snum'];

$materials = get_materialbysection($cnum, $snum, $mysqli);

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
            	<th>Location</th>
            	<th>File Name</th>
            	</tr>

              <?php while ($material = $materials->fetch_assoc()) { 
                echo '<tr><td>' . $material["Cnum"] . '</td><td>' . 
                $material["Snum"] . '</td><td>' . $material["Location"] . '</td><td>' . 
                $material["FileName"] . '</td><</td></tr>';
              }
              ?>
              
              </table>

        </div>
      </div>

<?php include 'partials/footer.php'; ?>