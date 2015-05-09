<?php

function login($email, $password, $mysqli){
    if($result = $mysqli->prepare("select CWID, Email, Password, AType
        from ACCOUNT
        where Email = ? ")){
        $result->bind_param('s', $email);
        $result->execute();
        $result->store_result();
 
        // get data from result
        $result->bind_result($user_cwid, $user_email, $user_password, $type);
        $result->fetch();
        
        if($result->num_rows ==1){ // user exists
    
            if($user_password == $password){
                //store data into session
                session_start();
                $_SESSION['cwid'] = $user_cwid;
                $_SESSION['type'] = $type;
                return true;
            } else{
                // incorrect password
                return false;
            }
        } else{
            // account doesn't exit
            return false;
        }
 
        }
}// end login
 
function logout(){
    session_destroy();
    header( 'Location: /index.php' ) ;
}// end logout
 
// this function will print our all  section of a specific course
function ad_list_course_section($cnum, $mysqli){
    $query = "select S.Cnum, S.Snum, S.Days,S.Room,
        S.BeginTime, S.EndTime, S.Capacity, C.Fname + ' ' + C.Lname as Name
        from SECTION S, FACULTY F, CSUF_MEMBER C 
        where S.FCWID = F.CWID and
            F.CWID = C.CWID and
            S.Cnum ='" .$cnum."'";
    
    if($result = $mysqli->query($query)){
       echo "<table class='table' >
            	<tr>
            	<th>Course</th>
            	<th>Section</th>
            	<th>Days</th>
            	<th>Room</th>
            	<th>Begin time</th>
            	<th>End Time</th>
            	<th>Capacity</th>
            	<th>Professor</th>
            	</tr>";
         /* now you can fetch the results into an array */
        while ($myrow = $result->fetch_array()) {
            echo "<tr>";
            echo "<td>". $myrow[0] ."</td>";
            echo "<td>". $myrow[1] ."</td>";
            echo "<td>". $myrow[2] ."</td>";
            echo "<td>". $myrow[3] ."</td>";
            echo "<td>". $myrow[4] ."</td>";
            echo "<td>". $myrow[5] ."</td>";
            echo "<td>". $myrow[6] ."</td>";
            echo "<td>". $myrow[7] ."</td>";
            echo "</tr>";
    
        }
        echo "</table>"; 
    }    
        
    
}// end ad_course_schedule()


// this function will print out all course
function ad_list_course($mysqli){
    
        $query = "select c.Cnum, c.Title, c.Unit, d.Dname from COURSE AS c, DEPARTMENT AS d WHERE c.Dnum = d.Dnum";
        if($result = $mysqli->query($query)){
            echo "<table class='table' >
            	<tr>
            	<th>Course</th>
            	<th>Course Name</th>
            	<th>Units</th>
            	<th>Department </th>
            	<th>Action</th>
            	</tr>";
            
            while($row = $result->fetch_assoc()){
                echo "<tr>";
            echo "<td>". $row["Cnum"] ."</td>";
            echo "<td>". $row["Title"] ."</td>";
            echo "<td>". $row["Unit"] ."</td>";
            echo "<td>". $row["Dname"] ."</td>";
            echo "<td>";
            echo "<a class='btn btn-primary'
            href='/administrator_editcourse.php?courseid=" .$row["Cnum"] . "'>Edit</a>  " ;
            echo "<a class='btn btn-danger' href='/administrator.php?action=delete&courseid=" . $row["Cnum"] . "'>Delete</a>";
            
            echo "</td>";
            echo "</tr>";
            }
            echo "</table>";
        }
        
        
    
}// end ad_list_course


// this function will return detail of a specific course
function ad_course_review($cnum, $mysqli){
    if($result = $mysqli->prepare("select Cnum,Title, Unit, Dnum
        from COURSE 
        where Cnum=?")){
        $result->bind_param('s', $cnum);
        $result->execute();
        $result->store_result();
        // get data from result
        $result->bind_result($cnum, $title, $unit, $dnum);
        $result->fetch();
        return array($cnum, $title, $unit, $dnum);
        // to retrive data from this function:
        // list($cnum,$title,$unit,$dnum) = ad_course_review($cnum, $mysqli);
        
    }else{
        //can not find that course in the database
        // error handling 
    }
}// end ad_course_review()

function ad_course_edit($cnum, $title, $unit, $dnum, $mysqli) {
    $update_sql = "UPDATE COURSE SET title = '" . $title . "', unit = " . $unit . ", dnum = " . $dnum
        . " WHERE cnum = '" . $cnum . "'";
        
    echo $update_sql;
    
    if($mysqli->query($update_sql)){
        return true;
    }
    return false;
}// end add course

function ad_course_add($cnum, $title, $unit, $dnum, $mysqli) {
    $insert_sql = "INSERT INTO COURSE VALUES ('" . $cnum . "', '" . $title . 
                    "', " . $unit . ", " . $dnum . ")";
    if($mysqli->query($insert_sql)){
        return true;
    }
    return false;
}// end add course


// delete a course
function ad_course_delete($cnum, $mysqli){
    $query = "delete from COURSE where Cnum='". $cnum ."'";
    echo $query;
    
    if($mysqli->query($query)){
        //succes
        return true;
    } else{
        // error 
        return false;
    }
    
}// end delete course


//=============================================Section==========================
//
//==============================================================================
// this function will return detail of a specific section
function ad_section_review($cnum, $snum, $mysqli){
    $query = "select * from SECTION where Cnum='" . $cnum . "' and Snum='" .$snum . "'";
    if($result = $mysqli->query($query)){
        return $result;
    }
}// end ad_section_review()


function ad_section_add($cnum,$snum,$day,$room,$btime,$etime,$capacity,$cwid,$mysqli){
    $insert_sql = "INSERT INTO SECTION VALUES('".$cnum. "', '" .$snum."','".
            $day. "','". $room. "','". $btime. "','". $etime. "'," . $capacity
            . ",'" .$cwid. "')";
            
    if($mysqli->query($insert_sql)){
        return true;
    }
    return false;
} // end add section

// delete a section
function ad_section_delete($cnum, $snum, $mysqli){
    $query = "delete from SECTION where Cnum='". $cnum. "' and Snum='".
            $snum. "'";
    if($mysqli->query($query)){
        return true;
    } else {
        return false;
    }
}// end delete section


// update a section
function ad_section_update($cnum,$snum,$days,$room,$begin,$end,$capacity,$fcwid,$mysqli){
    $query = "update SECTION set Cnum='". $cnum."', Snum='".$snum."', 
    Days='". $days."', Room='".$room."', BeginTime='". $begin."', 
    EndTime='". $end."', Capacity='". $capacity."', FCWID='".$fcwid."'";
    if($mysqli->query($query)){
        return true;
    }
    return false;
}

// this function will get all of the departments
function get_departments($mysqli){
    $query = "SELECT * FROM DEPARTMENT";

    if ($result = $mysqli->query($query)) {
        return $result;
    }
}

// this function will get all course offered by a department
function get_course_by_department($dnum,$mysqli){
    $query = "select * from COURSE where Dnum='". $dnum. "'";
    if($result = $mysqli->query($query)){
        return $result;
    }
}

// this function will get all section of a course
function get_section_by_course($cnum, $mysqli){
    $query = "select * from SECTION where Cnum='". $cnum. "'";
    if($result = $mysqli->query($query)){
        return result;
    }
}

// this function will get all of the faculties
function get_faculties($mysqli){
    $query = "SELECT f.CWID, c.Fname, c.Lname  FROM FACULTY AS f, CSUF_MEMBER AS c WHERE f.CWID = c.CWID";

    if ($result = $mysqli->query($query)) {
        return $result;
    }
}

// this function will get all of the courses
function get_courses($mysqli){
    $query = "SELECT c.Cnum, c.Title, c.Unit, d.Dnum, d.Dname  FROM COURSE AS c, DEPARTMENT AS d WHERE d.Dnum = c.Dnum ORDER BY d.Dname, c.Title";

    if ($result = $mysqli->query($query)) {
        return $result;
    }
}

function get_sections($mysqli){
    $query = "SELECT d.Dname, c.Cnum, c.Title, s.Snum, s.Days, s.Room, s.BeginTime, s.EndTime, s.Capacity, s.FCWID, cm.Fname, cm.Lname  FROM DEPARTMENT d, COURSE c, SECTION s, CSUF_MEMBER cm  WHERE d.Dnum = c.Dnum AND c.Cnum = s.Cnum AND s.FCWID = cm.CWID;";
    
    if($result = $mysqli->query($query)){
        return $result;
    }
}


// this function will return all sections taught by a faculty
function list_section_by_faculty($cwid, $mysqli){
    $query="SELECT d.Dname, c.Cnum, c.Title, s.Snum, s.Days, s.Room, s.BeginTime, s.EndTime, s.Capacity, s.FCWID, cm.Fname, cm.Lname  
    FROM DEPARTMENT d, COURSE c, SECTION s, CSUF_MEMBER cm  
    WHERE d.Dnum = c.Dnum AND c.Cnum = s.Cnum AND s.FCWID = cm.CWID AND s.FCWID='".$cwid ."'";
    if($result=$mysqli->query($query)){
        return $result;
    }
}

//=============================================Faculty==========================
//
//==============================================================================
// this function will print out the details of a specific course section
function fac_list_session($mysqli){

        $query = "select s.Cnum, s.Snum, s.Days, s.Room, s.BeginTime, s.EndTime, s.Capacity, f.Fname, f.Lname from SECTION AS s, CSUF_MEMBER AS f WHERE s.FCWID = f.CWID";
        if($result = $mysqli->query($query)){
            echo "<table class='table' >
            	<tr>
            	<th>Course</th>
            	<th>Course Name</th>
            	<th>Units</th>
            	<th>Department </th>
            	<th>Action</th>
            	</tr>";
            
            while($row = $result->fetch_assoc()){
                echo "<tr>";
            echo "<td>". $row["Cnum"] ."</td>";
            echo "<td>". $row["Title"] ."</td>";
            echo "<td>". $row["Unit"] ."</td>";
            echo "<td>". $row["Dname"] ."</td>";
            echo "<td>";
            echo "<a class='btn btn-primary'
            href='/administrator_editcourse.php?courseid=" .$row["Cnum"] . "'>Edit</a>  " ;
            echo "<a class='btn btn-danger' href='/administrator.php?action=delete&courseid=" . $row["Cnum"] . "'>Delete</a>";
            
            echo "</td>";
            echo "</tr>";
            }
            echo "</table>";
        }
        
        
    
}// end fac_list_course


// save material of a course
function save_material($cnum, $snum, $filename, $path, $mysqli){
    $insert_sql = "INSERT INTO MATERIAL VALUES('".$cnum. "', " .$snum.",'".
            $filename. "','". $path. "')";
    echo $insert_sql;        
    if($mysqli->query($insert_sql)){
        return true;
    }
    return false;
    
}

// save student_file
function save_student_file($gid, $filename, $path){
    $insert_sql = "INSERT INTO STUDENT_FILE VALUES('".$gid. "', '" .
            $filename. "','". $path. "')";
            
    if($mysqli->query($insert_sql)){
        return true;
    }
    return false;
}



/*** Student ***/

function get_open_sections($mysqli){
    $query = "SELECT d.Dname, c.Cnum, c.Title, s.Snum, s.Days, s.Room, s.BeginTime, s.EndTime, s.Capacity, s.FCWID, cm.Fname, cm.Lname  
    FROM DEPARTMENT d, COURSE c, SECTION s, CSUF_MEMBER cm  
    WHERE d.Dnum = c.Dnum AND c.Cnum = s.Cnum AND s.FCWID = cm.CWID AND s.Capacity > 0";
    
    if($result = $mysqli->query($query)){
        return $result;
    }
}

function get_sectionsenrolled($mysqli, $cwid){
    $query = "SELECT d.Dname, c.Cnum, c.Title, s.Snum, s.Days, s.Room, s.BeginTime, s.EndTime, s.Capacity, s.FCWID, cm.Fname, cm.Lname  
    FROM DEPARTMENT d, COURSE c, SECTION s, ENROLL e, CSUF_MEMBER cm  
    WHERE d.Dnum = c.Dnum AND c.Cnum = s.Cnum AND s.FCWID = cm.CWID AND e.CWID = '" . $cwid . "' AND e.Cnum = c.Cnum AND e.Snum = s.Snum";
    
    if($result = $mysqli->query($query)){
        return $result;
    }
}

function enroll($cwid, $cnum, $snum, $mysqli) {
    $insert_sql = "INSERT INTO ENROLL VALUES('". $cwid . "', '" .
            $cnum. "','". $snum. "',null)";
            
    if($mysqli->query($insert_sql)){
        return true;
    }
    return false;
}

function get_gradebysection($cwid, $cnum, $snum, $mysqli) {

    $query = "SELECT c.Cnum, c.Title, s.Snum, st.SType, g.Score
    FROM COURSE c, SECTION s, GRADE g, SCORE_TYPE st  
    WHERE c.Cnum = s.Cnum AND g.CWID = '" . $cwid . "' AND g.Stype = st.Sid";
    
    if($result = $mysqli->query($query)){
        return $result;
    }
}

function get_materialbysection($cnum, $snum, $mysqli) {
    $query = "SELECT c.Cnum, c.Title, s.Snum, m.Location, m.FileName
    FROM COURSE c, SECTION s, MATERIAL m
    WHERE c.Cnum = s.Cnum AND m.Snum = s.Snum AND s.Cnum = m.Cnum AND m.Cnum = '" . $cnum . "' AND m.Snum = '" . $snum . "'";
    
    if($result = $mysqli->query($query)){
        return $result;
    }
}

?>


