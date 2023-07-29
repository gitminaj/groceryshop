<?php

include 'Config.php';

session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $email = filter_var($email , FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass , FILTER_SANITIZE_STRING);

    $select = $conn -> prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select -> execute([$email , $pass]);
    $row = $select -> fetch(PDO::FETCH_ASSOC);

    if($select -> rowCount() > 0){
       if($row['user_type'] == 'admin'){

        $_SESSION['admin_id'] = $row['id'];
        header('location:admin_page.php');

       }elseif($row['user_type'] == 'user'){

        $_SESSION['user_id'] = $row['id'];
        header('location:Home.php');
        
       }else{
        $message[] = 'no user found!';
       }

    }else{
        $message[] = 'incorrect email or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
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
            <h2> Login </h2>
            <input type="email" name="email" class="field" placeholder="Enter Your Email" required>
            <input type="password" name="pass" class="field" placeholder="Enter Password" required>
            <input type="submit" name="submit" value="login" class="btn">
            <p>New Here Register Your Self! <a href="Register.php">Register</a></p>
        </form>
    </div>
</body>
</html>