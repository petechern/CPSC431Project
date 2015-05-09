<?php

//check user status
session_start();

if($_SESSION['type'] != '2'){ // not a faculty member
    header( 'Location: index.php' ) ;
}

include_once 'db_connect.php';
include_once 'function.php';



$pageTitle = "Faculty";
$pageCSSClass = "fac";
?>

<?php include 'partials/header.php'; ?>

<div class="row">
    <div class="col-xs-12">
        <?php include 'partials/nav-faculty.php'; ?>
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Faculty</li>
        </ol>
          
        <h2>Welcome Faculty Member.</h2>
    </div>
</div>

<?php include 'partials/footer.php'; ?>