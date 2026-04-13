<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn=mysqli_connect("localhost","root","","rooms");
if(!$conn){
     die("Database connection failed".mysqli_connect_error());
}
if(isset($_POST["submit"]))
{   
    $name=$_POST["name"];
    $email=$_POST["email"];
    $subject=$_POST["subject"];
    $message=$_POST["message"];
    $sql="INSERT INTO contact_message(name,email,subject,message) VALUES ('$name','$email','$subject','$message')";
if(mysqli_query($conn,$sql))
{
    echo "<h3 style='color:goldenrod'>Message recived</h3>";
}
else{
    echo "<h3>Try again later server is not responding</h3>";
 }
}
?>