<?php
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
        header( 'Location: /index.php' ) ;
    }
    
?>