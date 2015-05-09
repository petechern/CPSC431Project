<?php
include_once "db_connect.php";
include_once "function.php";

$sections = fac_list_sections($mysqli);

$pageTitle = "Faculty";
$pageCSSClass = "fac";
?>

<?php include 'partials/header.php'; ?>

      <div class="row">
        <div class="col-xs-12">
            <?php include 'partials/nav-faculty.php'; ?>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/faculty.php">Faculty</a></li>
                <li class="active">Your Sessions</li>
            </ol>
                <table class='table' >
            	<tr>
            	<th>Department</th>
            	<th>Course Number</th>
            	<th>Course Title</th>
            	<th>Section Number</th>
            	<th>Days</th>
            	<th>Room</th>
            	<th>BeginTime</th>
            	<th>EndTime</th>
            	<th>Capacity</th>
            	</tr>
            <?php while ($section = $sections->fetch_assoc()) { 
                echo '<tr><td>' . $section["Dname"] . '</td><td>' . 
                $section["Cnum"] . '</td><td>' . $section["Title"] . '</td><td>' . 
                $section["Snum"] . '</td><td>' . '</td><td>' .
                $section["Days"] . '</td><td>' . 
                $section["Room"] . '</td><td>' . $section["BeginTime"] . '</td><td>' .
                $section["EndTime"] . '</td><td>' . $section["Capacity"] .'</tr>';
            }
            ?>

        </div>
      </div>
<?php include 'partials/footer.php'; ?>