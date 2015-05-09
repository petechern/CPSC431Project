<?php
include_once "db_connect.php";
include_once "function.php";
session_start();
if($_SESSION['type'] != '2'){ // not an faculty
    header( 'Location: index.php' ) ;
}
$cwid = $_SESSION['cwid'];
$cnum = $_GET['cnum'];
$snum = $_GET['snum'];

$pageTitle = "Faculty";
$pageCSSClass = "fac";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $folder = "files/materials/";
    move_uploaded_file($_FILES["filep"]["tmp_name"] , "$folder".$_FILES["filep"]["name"]);
    
    $path = "files/materials/" . $_FILES['filep']['name'];
    $filename = $_FILES['filep']['name'];
    
    
    if(save_material($cnum, $snum, $filename, $path, $mysqli)){
        echo "success";
    } else{
        // error
    }
    header( 'Location: faculty.php' ) ;
}


?>

<?php include 'partials/header.php'; ?>
        
      <div class="row">
        <div class="col-xs-12">
            <?php include 'partials/nav-faculty.php'; ?>
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/faculty.php">Faculty</a></li>
                <li class="active">Your Session</li>
            </ol>
            

            
            
            <form action="faculty_singlesection.php?cnum=<?php echo $_GET['cnum']; ?>&snum=<?php echo $_GET['snum']; ?>" method=post enctype="multipart/form-data">
                <input type="file" name="filep" size=4500>
                <input role="button" class="btn btn-success" type=submit name=action value="Upload Course Material">
            </form>
            
            
               
                <p></p>
                <table class='table' >
            	<tr>
            	<th>Last Name</th>
            	<th>First Name</th>
            	<th>Assignments</th> //Access Student's assignment table to download them
            	</tr>
            <?php
                include_once 'function.php';
                include_once 'db_connect.php';
            ?>

        </div>
      </div>
<?php include 'partials/footer.php'; ?>