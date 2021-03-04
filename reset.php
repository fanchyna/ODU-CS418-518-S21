<!DOCTYPE html>
<html>
 <head>
  <title>login</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link  rel="stylesheet" href = "css/login.css">
 </head>
 <body>
 <form method="POST" >

<!--   -->
 <div class="Reset">
<div class="main">
<b>Reset password</b>
<br>
<br>
Email:<br>
<i class="fas fa-user" style="margin-right: 5px;"></i> <input type="text" name="email" size="30" value="" />
<br>
<br>
 Password:<br>
<i class="fas fa-key" style="margin-right: 5px;"></i> <input type="password" name="pass" size="30" value="" />
<p> 
Confirm Password:<br>
<i class="fas fa-key" style="margin-right: 5px;"></i> <input type="password" name="cpass" size="30" value="" />
<br>
<br>
 <input type="submit" class="btn btn-success " style="color:black; font-weight:bold;"  name="submit" value="Reset" />
 </p>
</div>

 </form>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        session_start();
        require_once('dbConnection.php');
        if(isset($_POST['submit'])){
            global $dbc;
            $mail_id = trim(mysqli_real_escape_string($dbc,$_POST['email']));
            $password = trim(mysqli_real_escape_string($dbc,$_POST['pass']));
            $confirmPassword = trim(mysqli_real_escape_string($dbc,$_POST['cpass']));
            if($password != $confirmPassword){
                echo "<br>Oops!! password does not match";
            }
            
            $password = md5($password);
            $table = "users";
            $query = "UPDATE $table SET password = '$password' where email = '$mail_id'";
            $result = mysqli_query($dbc, $query);
            if($result){
                echo "<div class='main'><br> Your password has been reset successfully <br /></div>";
                header("refresh:2; url=login.php");
            }
            else{
                echo 'Incorrect email..! Enter again..!';
                header("refresh:2; url=reset.php");
            }
        }
    ?>

 </body>
</html>
