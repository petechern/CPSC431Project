<?php

//check user status
session_start();

if($_SESSION['type'] != '3'){ // not an student
    header( 'Location: index.php' ) ;
}

include_once 'db_connect.php';
include_once 'function.php';

$cwid = $_SESSION['cwid'];

$sections = get_sectionsenrolled($mysqli, $cwid);

$pageTitle = "Student - View your courses";
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
            	<th>Department</th>
            	<th>Course Number</th>
            	<th>Course Title</th>
            	<th>Section Number</th>
            	<th>Faculty</th>
            	<th>Days</th>
            	<th>Room</th>
            	<th>BeginTime</th>
            	<th>EndTime</th>
            	<th>Action</th>
            	</tr>

              <?php while ($section = $sections->fetch_assoc()) { 
                echo '<tr><td>' . $section["Dname"] . '</td><td>' . 
                $section["Cnum"] . '</td><td>' . $section["Title"] . '</td><td>' . 
                $section["Snum"] . '</td><td>' . $section["Fname"] . ' ' . $section["Lname"] . '</td><td>' .
                $section["Days"] . '</td><td>' . 
                $section["Room"] . '</td><td>' . $section["BeginTime"] . '</td><td>' .
                $section["EndTime"] . '</td><td><a class="btn btn-primary" href="/student_viewcoursematerial.php?cnum=' 
                . $section["Cnum"] . '&snum=' . $section["Snum"] . '">MATERIALS</a><a class="btn btn-primary" href="/student_viewgrades.php?cnum=' 
                . $section["Cnum"] . '&snum=' . $section["Snum"] . '">GRADES</a></td></tr>';
              }
              ?>
              
              </table>

        </div>
      </div>

<?php include 'partials/footer.php'; ?>