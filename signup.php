<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
<link rel ="stylesheet" a href="css\signup.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
        crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">
</head>
<body>
    <div class="signup">
    <div class="alignsignup">
    <form method="POST" >
	Name:<br>
	<input type="text" name="name" size="30" value="" required/> <br><br>
	Email:<br>
	<input type="email" name="email_id" size="30" value="" required/> <br><br>
	Password:<br>
	<input type="Password" name="pass" size="30" value="" required/> <br><br>
	Confirm Password:<br>
	<input type="Password" name="cpass" size="30" value="" required/> <br><br>
	<input type="submit" class="btn btn-success " style="color:black; font-weight:bold; margin-left: 80px;"  name="submit" value="SignIn" />
</form>
    
<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); 
  session_start();
  require_once('dbConnection.php');
if(isset($_POST['submit'])){
    global $dbc;
    $name =htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['name']));
    $mail_id=htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['email_id']));
    $pass=htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['pass']));
    $cpass=htmlspecialchars(mysqli_real_escape_string($dbc,$_POST['cpass']));
    $userTable = "users";
    $user_query = "SELECT email FROM $userTable WHERE email='$mail_id'";
    $user_result= mysqli_query($dbc,$user_query);
    $row= mysqli_fetch_array($user_result);
    $existing_email_id= $row['email'];
    $password = md5($pass);
    if($pass != $cpass){
        echo "<br>Oops!! password does not match";
    }

    else if($mail_id ==$existing_email_id){

        echo "<div class='main'><br>Email already exists";

    }
    else{
        $insert = "insert into `users`(`name`,`email`,`password`) values('$name','$mail_id', '$password')";
        $run = mysqli_query($dbc,$insert);
        echo "<div class='main' style='margin-left:60px;'> sign in success</div>";
        header("refresh:2, url=login.php");
    }

    
  
} 
  
?>
</div>
   </div>
</body>
</html>