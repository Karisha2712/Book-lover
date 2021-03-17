<?php
require('../database/connection.php');
require('functions.php');

$msg='';

if(isset($_POST['submit'])){

    $db= new DBConnection();
    $con = $db->GetConnection();
   // $username=get_safe_value($con,$_POST['username']);
   // $password=get_safe_value($con,$_POST['password']);
    $username = $con->prepare($_POST['username']);
    $password = $con->prepare($_POST['password']);
    $sql="select count(*) from admins where Name='$username' and Password='$password'";
    $numberOfRows  = $con->query($sql)->fetchColumn();

    if($numberOfRows > 0){
        echo 'yes';
        $_SESSION['ADMIN_LOGIN']='yes';
        $_SESSION['ADMIN_USERNAME']=$username;
        header('location:genres.php');

        die();
    }else{
        $msg='Please enter correct login details';
    }

}
?>


<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="admin_login.css">
</head>
<?php
require('header.php');
?>
<body class="body">

            <div>
                <form method="post" action="#">
                    <div >
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" name="submit">Sign in</button>
                </form>
                <div class="field_error"><?php echo $msg?></div>
            </div>

</body>
<?php
require('footer.php');
?>
</html>