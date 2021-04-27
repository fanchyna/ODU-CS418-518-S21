@extends('layouts.app')
@section('content')
<h3>
Saved Items
</h3>

<?php



$thisID= auth()->user()->id;
$title=Request('title');
$sourceURL=Request('sourceURL');
$description=Request('description');
$publisher=Request('publisher');

echo "$title";

$mysqli = new mysqli("127.0.0.1", "root", "root","web1");
$link = mysqli_connect("127.0.0.1", "root", "root", "web1");

$sql = "INSERT INTO save (user_id, title, url, description_abstract, publisher) VALUES ('$thisID','$title','$sourceURL','$description','$publisher')";
if(mysqli_query($link, $sql)){
    echo "Successful";
    } 
    else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
@endsectioN
