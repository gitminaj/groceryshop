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

<header class="header">

<div class="flex">
    <a href="Home.php" class="logo">Mart<span>Plaza</span></a>

    <nav>
        <a href="Home.php">Home</a>
        <a href="Orders.php">Orders</a>
        <a href="About.php">About</a>
        <a href="Contact.php">Contact</a>
    </nav>
    <div class="icons">
      <i id="user" class="fa-solid fa-user"></i>
      <a href="Search_Page.php" class="fas fa-search"></a>
        <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
        ?>
        <a href="Wishlist.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
        <a href="Cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
    </div>
    <div class="profile">
    <?php
            $select_profile = $conn -> prepare ("SELECT * FROM `users` WHERE id = ?");
            $select_profile -> execute([$user_id]);
            $fetch_profile = $select_profile -> fetch(PDO::FETCH_ASSOC);
    ?>
    <p><?= $fetch_profile['name'] ?></p>
        <a href="User_Update_Profile.php" class="updtprofile-btn">Update Profile </a>
        <a href="Login.php" class="logout-btn">Logout</a>
        <div class="flex-btn">
            <a href="Login.php" class="login-btn">Login</a>
            <a href="Register.php" class="register-btn">Register</a>
        </div>
    </div>

</div>
</header>
