<?php

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include_once 'db_connect.php';
  include_once 'function.php';
  
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  if(login($email, $password, $mysqli) == true){
    echo $_SESSION['type'];
    if($_SESSION['type'] == 1){// administrator
      header('Location: /administrator.php');
    } elseif($_SESSION['type'] == 2){// faculty
      header('Location: /faculty.php');
    } else{// student
     header('Location: /student.php');
    }
  }else{// fail to login
    $error = "Invalid Account";
  }
}

$pageTitle = "Login";
$pageCSSClass = "login";

?>

<?php include 'partials/header.php'; ?>

<div class="row">
  <div class="col-xs-4 col-xs-offset-4">
    <?php if($error != null) { ?>
      <p class="well text-danger">
        <span class="glyphicon glyphicon-ban-circle"></span> <?php echo $error; ?>
      </p>
    <?php } ?>  

    <form class="form-horizontal well well-lg" method="POST" action="index.php" >
      <fieldset>
        <legend>Login</legend>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-2 control-label">Email</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-lg-2 control-label">Password</label>
          <div class="col-lg-10">
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
          </div>
        </div>
        <div class="form-group center">
          <button type="submit" class="btn btn-primary">Login <span class="glyphicon glyphicon-log-in"></span></button>
        </div>
      </fieldset>
    </form>
  </div>
</div>

<?php include 'partials/footer.php'; ?>