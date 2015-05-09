<?php
//check user status
session_start();

if($_SESSION['type'] != '1'){ // not an administrator
    header( 'Location: index.php' ) ;
}

include_once 'db_connect.php';
include_once 'function.php';

if($_GET['action']==='delete' && isset($_GET['courseid'])) {
    $courseid = $_GET['courseid'];
    ad_course_delete($courseid, $mysqli);
    header('Location: administrator_viewcourse.php');
}

if($_GET['action']==='delete' && isset($_GET['snum']) && isset($_GET['cnum'])) {
    $snum = $_GET['snum'];
    $cnum = $_GET['cnum'];
    ad_section_delete($cnum, $snum, $mysqli);
    header('Location: administrator_viewsection.php');
}

$pageTitle = "Administrator";
$pageCSSClass = "admin";
?>

<?php include 'partials/header.php'; ?>

<div class="row">
    <div class="col-xs-12">
        <?php include 'partials/nav-admin.php'; ?>
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Administrator</li>
        </ol>
          
        <h2>Welcome Administrator.</h2>
    </div>
</div>

<?php include 'partials/footer.php'; ?>