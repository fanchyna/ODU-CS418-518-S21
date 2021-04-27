<!DOCTYPE html>
<head>
	 <font face="AR CHRISTY" color="black" size="150">Poodle.com</font> 
     <link href="style.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="stylemain.css" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Amatic+SC" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Amatic+SC" />
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	
</head>
<body>
<?php
session_start();

// Turn off all error reporting
error_reporting(0);

// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!--login/logout module-->


<?php 
if(isset($_SESSION['uId']))
{ 
  include "navigation2.html";           
} 
else 
{ 
  include "navigation1.html"; 
}
 ?>
<?php
function test($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>
</body>

</html>