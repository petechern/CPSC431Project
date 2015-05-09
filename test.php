<?php
    include_once 'db_connect.php';
    include_once 'function.php';
// username and password need to be replaced by your username and password

// mysql-ctl start/stop, mysql-ctl cli
// user: petechern / pw: / db: c9
// $link = mysql_connect('ecsmysql', 'cs332s4', 'heidahth');
$link = mysql_connect('0.0.0.0', 'petechern', '');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}
else {
    echo 'Connected successfully<p>';
}

mysql_select_db("cpsc431", $link);

$result = mysql_query("SELECT Fname FROM CSUF_MEMBER",$link);


for($i=0; $i<mysql_numrows($result); $i++)
{
    echo mysql_result($result,$i,"Fname") . '<br>';
}

ad_course_add('CPSC431', 'Database and Web', 3, 1, $mysqli);

?>