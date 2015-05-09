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
      if($_POST["cnum"] && $_POST["snum"] && $_POST["days"] && $_POST["room"] 
        && $_POST["beginTime"] && $_POST["endTime"] && $_POST["capacity"] 
        && $_POST["cwid"]) {
        $cnum = $_POST["cnum"];
        $snum = $_POST["snum"];
        $days = $_POST["days"];
        $room = $_POST["room"];
        $beginTime = $_POST["beginTime"];
        $endTime = $_POST["endTime"];
        $capacity = $_POST["capacity"];
        $cwid = $_POST["cwid"];
        
        
        if(ad_section_update($cnum,$snum,$day,$room,$beginTime,$endTime,$capacity,$cwid,$mysqli)) {
            $message = "Record Updated";
            header('Location: administrator_viewsection.php');
        } else {
            $error = "Please check your input.";   
        }
      }
    }
    
    $cnum = $_GET['cnum'];
    $snum = $_GET['snum'];
    
    $section = ad_section_review($cnum, $snum, $mysqli);
    $section = $section->fetch_array();
    $courses = get_courses($mysqli);
    $faculties = get_faculties($mysqli);
    
    $pageTitle = "Administrator - Edit Section";
    $pageCSSClass = "admin-edit-section";
?>

<?php include 'partials/header.php'; ?>

      <div class="row">
        <div class="col-xs-12">
            <?php include 'partials/nav-admin.php'; ?>

            <h1>Edit Section</h1>
            <form method="POST" action="/administrator_editsection.php">
              <div class="form-group">
                <label for="cnum">Course</label>
                <select class="form-control" id="cnum" name="cnum">
                  <?php while ($course = $courses->fetch_assoc()) { 
                    echo '<option value=' . $course["Cnum"] . '>' . $course["Dname"] . ' - ' . $course["Title"] . '</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="snum">Section Number</label>
                <input type="text" class="form-control" id="snum" name="snum" placeholder="Enter Section Name" value="<?php echo $section[1]; ?>">
              </div>
              <div class="form-group">
                <label for="days">Meeting Days</label>
                <input type="text" class="form-control" id="days" name="days" placeholder="Enter Meeting Days" value="<?php echo $section[2]; ?>">
              </div>
              <div class="form-group">
                <label for="room">Room</label>
                <input type="text" class="form-control" id="room" name="room" placeholder="Enter Room" value="<?php echo $section[3]; ?>">
              </div>
              <div class="form-group">
                <label for="beginTime">Begin Time</label>
                <input type="text" class="form-control" id="beginTime" name="beginTime" placeholder="hh:mm:ss" value="<?php echo $section[4]; ?>">
              </div>
              <div class="form-group">
                <label for="endTime">End Time</label>
                <input type="text" class="form-control" id="endTime" name="endTime" placeholder="hh:mm:ss" value="<?php echo $section[5]; ?>">
              </div>
              <div class="form-group">
                <label for="capacity">Capacity</label>
                <select class="form-control" id="capacity" name="capacity" >
                  <?php for($i = 1; $i < 51; $i++) { 
                    echo '<option value=' . $i . '>' . $i . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="cwid">Faculty</label>
                <select class="form-control" id="cwid" name="cwid">
                  <?php while ($faculty = $faculties->fetch_assoc()) { 
                    echo '<option value=' . $faculty["CWID"] . '>' . $faculty["Fname"] . ' ' . $faculty["Lname"] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div>
      </div>

<?php include 'partials/footer.php'; ?>