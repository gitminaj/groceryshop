<?php

include 'Config.php';

if(isset($_POST['submit'])){
    
    $name = $_POST['name'];
    $name = filter_var($name , FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email , FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass , FILTER_SANITIZE_STRING);
    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass , FILTER_SANITIZE_STRING);

    $select = $conn -> prepare("SELECT * FROM `users` WHERE email = ?");
    $select -> execute([$email]);

    if($select -> rowCount() > 0){
        $message[] = 'user eamil already exist!';
    }else{
        if($pass != $cpass){
            $message[] = 'confirm password not matched!';
        }else{
            $insert = $conn -> prepare("INSERT INTO `users` (name,email,password)VALUES(?,?,?)");
            $insert -> execute ([$name, $email, $pass]);
            if ($insert) {
                $message[] = 'registered successfully';
            }
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <!-- fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!--Css file link -->
    <link rel="stylesheet" href="css/Component.css">

    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">

</head>
<body>



<?php
if(isset($message)){
    foreach($message as $message){
        echo '   <div class="message">
                     <span>'.$message.'</span>
                     <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                 </div>
        ';
    }
}
?>


<div class="reg-form">
        <form action="" enctype="multipart/form-data" method="POST">
            <h2> Register Yourself </h2>
            <input type="text" name="name" class="field" placeholder="Enter Your Name" required>
            <input type="email" name="email" class="field" placeholder="Enter Your Email" required>
            <input type="password" name="pass" class="field" placeholder="Create Password" required>
            <input type="password" name="cpass" class="field" placeholder="Confirm Password" required>
            <input type="submit" value="Register" class="btn" name="submit">
            <p>Already Registerd? <a href="Login.php">Login</a></p>
        </form>
</div>
</body>
</html>