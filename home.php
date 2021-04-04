<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8">
	 <title>search</title>
	  <link  rel="stylesheet" href = "css/index.css">
	  </head>
    <style>
 

</style>
	  <body>
      <?php

if(!session_start())
{
  session_start();
}
if(!isset($_SESSION['email']))
  header("Location:index.php");
  ?>
   <div class='welcome' style = 'background-color:white; padding-top:10px;'>
  <?php echo "Welcome " . $_SESSION['name']; ?>
  <br>
  <a href='profile.php' >profile</a>
  <a href= 'logout.php'> logout</a>
  </div>
	    <div class="header">

 
		<form>
           
     
		  <div class="form-box">
		  <input type ="text" class="search" placeholder = "Search a book">
      <br>
		  <button class ="search-btn" type="button"> Search</button>


		  </form>
		  </div>
		  </body>
		  </html>


