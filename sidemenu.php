<div class="sidemenu">
    <ul>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            echo "<li><a href='login.php'>Log In</a> or <a href='register.php'>Register</a></li>
            <li><a href='#'>Promotions</a></li>
            <li><a href='#'>Shopping Cart</a></li>
            <li><a href='#'>Forums</a></li>
            <li><a href='#'>Settings</a></li>
            <li><a href='#'>Support</a></li>";
        } else {
            echo "<li><a href='#'>" . $_SESSION["uname"] . "</a></li>
            <li><a href='#'>Account</a></li>
            <li><a href='#'>Promotions</a></li>
            <li><a href='#'>Payment</a></li>
            <li><a href='#'>Purchase History</a></li>
            <li><a href='#'>Shopping Cart</a></li>
            <li><a href='#'>Wishlist</a></li>
            <li><a href='#'>Likes</a></li>
            <li><a href='#'>Forums</a></li>
            <li><a href='#'>Settings</a></li>
            <li><a href='#'>Support</a></li>
            <li><a href='logout.php'>Log Out</a></li>";
        }
        ?>
    </ul>
</div>