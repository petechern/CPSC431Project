<?php
$pageTitle = "Administrator";
$pageCSSClass = "admin";
?>

<?php include 'partials/header.php'; ?>

      <div class="row">
        <div class="col-xs-12">
            <?php include 'partials/nav-admin.php'; ?>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/administrator.php">Administrator</a></li>
                <li class="active">Courses</li>
            </ol>
            <?php
                include_once 'function.php';
                include_once 'db_connect.php';
                ad_list_course($mysqli);
            ?>

        </div>
      </div>

<?php include 'partials/footer.php'; ?>