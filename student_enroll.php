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
$cwid = $_SESSION['cwid'];

$enroll_success = enroll($cwid, $cnum, $snum, $mysqli);

$pageTitle = "Student - Enroll";
$pageCSSClass = "student";
?>

<?php include 'partials/header.php'; ?>

      <div class="row">
        <div class="col-xs-12">
            <?php include 'partials/nav-student.php'; ?>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/student.php">Student</a></li>
                <li class="active">Enroll</li>
            </ol>
            
            <?php if($enroll_success) { ?>
            <p class="alert alert-success">
                You are now enrolled.
            </p>
            <?php } else { ?>
            <p class="alert alert-warning">
                You are unable to enroll.
            </p>
            <?php } ?>
            
        </div>
      </div>

<?php include 'partials/footer.php'; ?>