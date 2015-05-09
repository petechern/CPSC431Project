<?php

include_once 'db_connect.php';
include_once 'function.php';

$sections = get_sections($mysqli);

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
                <li class="active">Section</li>
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
            	<th>Capacity</th>
            	<th>Action</th>
            	</tr>

              <?php while ($section = $sections->fetch_assoc()) { 
                echo '<tr><td>' . $section["Dname"] . '</td><td>' . 
                $section["Cnum"] . '</td><td>' . $section["Title"] . '</td><td>' . 
                $section["Snum"] . '</td><td>' . $section["Fname"] . ' ' . $section["Lname"] . '</td><td>' .
                $section["Days"] . '</td><td>' . 
                $section["Room"] . '</td><td>' . $section["BeginTime"] . '</td><td>' .
                $section["EndTime"] . '</td><td>' . $section["Capacity"] . 
                '</td><td><a class="btn btn-primary" href="/administrator_editsection.php?cnum=' 
                . $section["Cnum"] . '&snum=' . $section["Snum"] . '">Edit</a>
                <a class="btn btn-danger" href="/administrator.php?action=delete&cnum=' 
                . $section["Cnum"] . '&snum=' . $section["Snum"] . '">Delete</a></td>
                </tr>';
              }
              ?>
              
              </table>

        </div>
      </div>

<?php include 'partials/footer.php'; ?>