<?php
    // This page requires a course 
    if(!$_GET['courseid']) {
      header( 'Location: administrator.php' ) ;
    }

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
        
        if(ad_course_edit($cnum, $title, $unit, $dnum,$mysqli)) {
            header('Location: administrator_viewcourse.php');
        } else {
            $error = "Please check your input.";   
        }
    }

    $departments = get_departments($mysqli);

    $courseid = $_GET['courseid'];
    $course = ad_course_review($courseid, $mysqli);

    $pageTitle = "Administrator - Edit Course";
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
                <li class="active">Edit Course</li>
            </ol>

            <h1>Edit Course</h1>

            <form method="POST" action="/administrator_editcourse.php?courseid=<?php echo $course[0]; ?>">
              <div class="form-group">
                <label for="cnum">Course Id</label>
                <input type="text" class="form-control" id="cnum" name="cnum" placeholder="Enter Course Id" value="<?php echo $course[0]; ?>">
              </div>
              <div class="form-group">
                <label for="title">Course Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Course Title" value="<?php echo $course[1]; ?>">
              </div>
              <div class="form-group">
                <label for="unit">Units</label>
                
                <select class="form-control" id="unit" name="unit" selected="<?php echo $course[2]; ?>">
                  <?php
                    for($i = 1; $i <= 5; $i++) {
                      if($i == $course[2]) {
                        echo '<option selected>' . $i . '</option>'; 
                      } else {
                        echo '<option>' . $i . '</option>';
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="dnum">Department</label>
                <select class="form-control" id="dnum" name="dnum">
                  <?php while ($department = $departments->fetch_assoc()) { 
                      if($department["Dnum"] == $course[3]) {
                        echo '<option value=' . $department["Dnum"] . ' selected>' . $department["Dname"] . '</option>';
                      } else {
                        echo '<option value=' . $department["Dnum"] . '>' . $department["Dname"] . '</option>';
                      }
                  }
                  ?>
                </select>
              </div>

                <button type="submit" class="btn btn-primary pull-right">Submit</button>

            </form>

        </div>
      </div>

<?php include 'partials/footer.php'; ?>