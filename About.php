<?php

@include 'Config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:Login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

     <!-- fontawesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!--Css file link -->
<link rel="stylesheet" href="css/Style.css">

<!-- font link -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">

</head>
<body>
<?php include 'Header.php' ?>
<div class="aboutimg">
    <img src="./images/aboutimg.jpg" alt="image">
    <img src="./images/aboutimg1.jpg" alt="image">
</div>

<div class="aboutContent">
    <h1>About us</h1>
    <p> We have been in this business for last 50 years , The grocery are hand picked by workers and
         fresh form the farm , vegitables and fruits are pestisides free they are grown organically</p><br>
    <p>Our main aim coustomer satisfaction and their health , we are loyal to our coustomers, we buy vegitables form local farmers and help them 
        , we have good network of farmers , and try to empower local farmers, and we loans to them also.  </p><br>
</div>


<?php include 'Footer.php'?>
<script src="javascript/script.js"></script>
    
</body>
</html>