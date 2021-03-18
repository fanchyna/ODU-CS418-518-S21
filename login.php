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

 <!-- <div class="main"> -->

 
 <div class="login">
 <div class="main">
<br>
<b>Enter credentials to login </b>
<br>
<br>
<b>Email:<b><br>
<i class="fas fa-user" style="margin-right: 15px;  width: 60%; "></i> <input type="text" name="email" size="30" value="" />
<br>
<br>
 <b>Password:<b><br>
<i class="fas fa-key" style="margin-right: 15px; width: 60%;"></i> <input type="password" name="password" size="30" value="" />
<p> 
<br>
<br>
 <input type="submit" class="btn btn-success " style="color:black; font-weight:bold;"  name="submit" value="Login" />
 <a href="signup.php" class="btn btn-primary" style="color:black; font-weight:bold;">Signup</a>
 <a href="reset.php" class="btn btn-default" style="color:black; font-weight:bold;">Reset password</a>
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
            $password = md5(trim(mysqli_real_escape_string($dbc,$_POST['password'])));
            $table = "loginid";
            $query = "SELECT * from $table where email = '$mail_id' and password = '$password'";
            $result = mysqli_query($dbc, $query);
            
            $affected_rows = mysqli_num_rows($result);
            if($affected_rows == 1){
                $rowg= mysqli_fetch_array($result);
                $_SESSION['email'] = $rowg['email'];
                $_SESSION['name'] = $rowg['name'];
                echo "<div class='main'><br><br><br><br> Login success <br /></div>";
                header("refresh:2; url=home.php");
            }
            else{
                echo 'Incorrect Info..! Enter again..!';
                header("refresh:2; url=login.php");
            }
        }
    ?>

 </body>
</html>
