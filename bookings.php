<!DOCTYPE html>
<html>
<head>
<title>Room Booking</title>

<style>
body{
    background-color:#0b0b0b;
    font-family: Arial, Helvetica, sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.form-box{
    width:500px;
    padding:30px;
    background:#0b0b0b;
    border:1px solid #222;
}
select{
    background-color:#0b0b0b;
    color:white;
    border:1px solid #444;
    padding:10px;
    width:200px;
}
h1{
    color:goldenrod;
    font-weight:normal;
    text-align:center;
}

.price{
    color:white;
    margin-bottom:20px;
}

label{
    color:goldenrod;
    font-size:16px;
    letter-spacing:1px;
    font-weight:bold;
}

input{
    width:100%;
    padding:12px;
    margin-top:6px;
    margin-bottom:18px;
    background:transparent;
    border:1px solid #333;
    color:white;
}

.buttons{
    display:flex;
    justify-content:space-between;
}

.cancel{
    width:45%;
    padding:12px;
    background:transparent;
    border:1px solid #333;
    color:#aaa;
}

.confirm{
    width:45%;
    padding:12px;
    background:goldenrod;
    border:none;
    color:black;
    font-weight:bold;
}
input[type="date"]::-webkit-calendar-picker-indicator{
filter: invert(1);
cursor: pointer;
}

</style>

<script>
function showPrice() 
{
    var room = document.getElementById("room").value;
    var price = 0;
    if(room == "Single Room with Ac") 
        price = 2999;
    else if(room == "Single Room(Non Ac)") 
        price = 1999;
    else if(room == "Double Room with Ac") 
        price = 4999;
    else if(room == "Double Room(Non Ac)") 
        price = 3999;
    else if(room == "Family Room") 
        price = 5999;
    else if(room =="Deluxe Room")
        price=6999;
    document.getElementById("price").value = price;
    calculateTotal();
}
function calculateTotal() 
{
    var price = parseInt(document.getElementById("price").value);
    var checkin = document.getElementById("checkin").value;
    var checkout = document.getElementById("checkout").value;
    if(checkin && checkout)
    {
        var date1 = new Date(checkin);
        var date2 = new Date(checkout);
        var timeDiff = date2 - date1;
        var days = timeDiff / (1000 * 60 * 60 * 24);
        if(days > 0)
        {
            var total = price * days;
            document.getElementById("total").value = total;
        } 
        else 
        {
            document.getElementById("total").value = "Invalid dates";
        }
    }
}
document.addEventListener("DOMContentLoaded", function()
{
    document.getElementById("checkin").addEventListener("change", calculateTotal);
    document.getElementById("checkout").addEventListener("change", calculateTotal);
    showPrice(); 
});
</script>

</head>

<body>

<div class="form-box">

<h1>Room Booking</h1>
<form method="POST" >
<label>Name</label>
<input type="text" id="name" placeholder="Enter your name" name="name" required>

<label>Email</label>
<input type="email" id="email" name="email" placeholder="Enter your email" required>

<label>Room Type:</label><br>
<select name="room" id="room"  onchange="showPrice()"  >

<option value="Single Room with Ac">Single Room with Ac</option>
<option value="Single Room(Non Ac)">Single Room(Non Ac)</option>
<option value="Double Room with Ac">Double Room with Ac</option>
<option value="Double Room(Non Ac)">Double Room(Non Ac)</option>
<option value="Family Room">Family Room</option>
<option value="Deluxe Room">Deluxe Room</option>
</select>

<br><br>

<label>Room Price:</label><br>
<input type="text" id="price" name="price" readonly>

<br><br>

<label>Check-in Date</label>
<input type="date" id="checkin" name="checkin" required>

<label>Check-out Date</label>
<input type="date" id="checkout" name="checkout" required>

<label>Total Cost:</label><br>
<input type="text" id="total" name="total" readonly>

<div class="buttons">
<button class="cancel" type="button">CANCEL</button>
<button class="confirm" type="submit" name="submit">Confirm</button>
</div>
</form>
</div>
<?php
$conn=mysqli_connect("localhost","root","","rooms");
if(!$conn){
    die("Database connection failed".mysqli_connect_error());
}
if(isset($_POST["submit"]))
{   
    $name=$_POST["name"];
    $email=$_POST["email"];
    $room_type=$_POST["room"];
    $room_price=$_POST["price"];
    $checkin_date=$_POST["checkin"];
    $checkout_date=$_POST["checkout"];
    $sql="INSERT INTO bookings (name,email,room,price,checkin,checkout,total) 
VALUES ('$name','$email','$room_type','$room_price','$checkin_date','$checkout_date','".$_POST['total']."')";
if(mysqli_query($conn,$sql))
{
    echo "<h1 style='color:goldenrod'><b>Booking confirmed</b></h1>";
}
else{
    echo "<h1>Try again later server is not responding</h1>";
 }
}
?>
</body>
</html>
