<?php

include_once 'db_connect.php';
include_once 'function.php';

if ($_POST["action"] == "Load")
{
    $folder = "../files/";
    $cnum = $_POST["cnum"];
    $snum = $_POST["snum"];
    move_uploaded_file($_FILES["filep"]["tmp_name"] , "$folder".$_FILES["filep"]["name"]);
    
    echo "<p align=center>File ".$_FILES["filep"]["name"]." uploaded...";
    $path = "../files/" + $_FILES['filep']['name'];
    $gid = 1; 
    $filename = $_FILES['filep']['name'];
    if(save_student_file($gid, $filename, $path)){
        // success
    } else{
        // error
    }
    
}
?>

<form action="upload.php" method=post enctype="multipart/form-data">
    <table border="0" cellspacing="0" align=center cellpadding="3" bordercolor="#cccccc">
        <tr>
        <td>File:</td>
        <td><input type="file" name="filep" size=4500></td>
        </tr>
        <tr>
        <td colspan=2><p align=center>
        <input type=submit name=action value="Load">
        </td>
    </tr>
    </table>
</form>