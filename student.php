<?php
//check user status
session_start();






$pageTitle = "Student";
$pageCSSClass = "stu";
?>

<?php include 'partials/header.php'; ?>

<div class="row">
    <div class="col-xs-12">
        <?php include 'partials/nav-student.php'; ?>
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Student</li>
        </ol>
          
        <h2>Welcome Student.</h2>
    </div>
</div>

<?php include 'partials/footer.php'; ?>