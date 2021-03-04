<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
	    <title>search</title>
	  </head>
	  <body>
<?php

if(!session_start())
{
  session_start();
}
if(!isset($_SESSION['email']))
  header("Location:index.php");
?>
<label> Name: <?php echo $_SESSION['name'] ?>
<br>
<label> Email: <?php echo $_SESSION['email'] ?>
<br>
<label><a href = 'reset.php'> Change Password </a>
<br>
</body>
</html>