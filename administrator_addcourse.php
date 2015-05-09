<?php
    include_once 'db_connect.php';
    include_once 'function.php';

    $error = "";
    $message = "";

    //check user status
    session_start();
    
    if($_SESSION['type'] != '1'){ // not an administrator
        header( 'Location: index.php' ) ;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cnum = $_POST["cnum"];
        $title = $_POST["title"];
        $unit = $_POST["unit"];
        $dnum = $_POST["dnum"];
        
        if(ad_course_add($cnum, $title, $unit, $dnum,$mysqli)) {
            $message = "Record Added";
            header('Location: administrator_viewcourse.php');
        } else {
            $error = "Please check your input.";   
        }
    }
    
    $departments = get_departments($mysqli);

    $pageTitle = "Administrator - Add Course";
    $pageCSSClass = "admin-add-course";
?>

<?php include 'partials/header.php'; ?>

<div class="row">
  <div class="col-xs-12">
      <?php include 'partials/nav-admin.php'; ?>
      <ol class="breadcrumb">
          <li><a href="/">Home</a></li>
          <li><a href="/administrator.php">Administrator</a></li>
          <li><a href="/administrator_viewcourse.php">Courses</a></li>
          <li class="active">Add Course</li>
      </ol>
      <h1>Add Course</h1>

      <form method="POST" action="/administrator_addcourse.php">
        <div class="form-group">
          <label for="cnum">Course Id</label>
          <input type="text" class="form-control" id="cnum" name="cnum" placeholder="Enter Course Id">
        </div>
        <div class="form-group">
          <label for="title">Course Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter Course Title">
        </div>
        <div class="form-group">
          <label for="unit">Units</label>
          <select class="form-control" id="unit" name="unit">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="form-group">
          <label for="dnum">Department</label>
          <select class="form-control" id="dnum" name="dnum">
            <?php while ($department = $departments->fetch_assoc()) { 
              echo '<option value=' . $department["Dnum"] . '>' . $department["Dname"] . '</option>';
            }
            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
      </form>

  </div>
</div>

<?php include 'partials/footer.php'; ?>