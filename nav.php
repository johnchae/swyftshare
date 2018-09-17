<div class="nav">
    <div class="first">
        <div class="icon-sidemenu" style="margin-top:1px;">
            <i class="fa fa-bars" style="font-size:20px;"></i>
        </div>
        <div class="icon-home" style="width:19px; height:19px; margin-top:-1px;">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                echo "<a href='welcome.php'><img src='img/unnamed.png' style='max-width:100%; max-height:100%;'></a>";
            } else {
                echo "<a href='index.php'><img src='img/unnamed.png' style='max-width:100%; max-height:100%;'></a>";
            }
            ?>
        </div>
        <div class="button-listitem">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                echo "<a href='login.php'>List an Item</a>";
            } else {
                echo "<a href='listitem.php'>List an Item</a>";
            }
            ?>
        </div>
    </div>
    <div class="second">
        <div class="search">
            <b>Search</b><div class="icon"><i class="fa fa-search"></i></div>
        </div>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            echo "<div class='login-register'>
                <b><a href='login.php'>Log In</a> or <a href='register.php'>Register</a></b>
            </div>";
        } else {
            echo "<div class='user-greeting'>
                <b>Welcome, <a href='#'>" . $_SESSION["uname"] . "</a></b> <b><a href='logout.php'>Log Out</a></b>
            </div>";
        }
        ?>
    </div>
</div>