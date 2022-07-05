<header class="header-area">
    <nav class="navbar navbar-expand-lg main-menu">
        <div class="container">

            <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" class="d-inline-block align-top" alt=""></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="menu-toggle"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="events.php">Events</a>
                    <li class="nav-item"><a class="nav-link" href="index.php#location">Location/Hours</a></li>
                </ul>
                <div class="header-btn justify-content-end">
                    <?php
                    if (isset($_COOKIE['client_id']) && $_COOKIE['client_id'] != "") {
                    ?>
                        <a href="my-order.php" class="bttn-mid btn-emt login-button">Hello, <?php echo $_COOKIE['client_name']; ?></a>
                    <?php
                    }else{
                    ?>
                    <a href="login.php" class="bttn-mid btn-emt login-button">Login/SignUp</a>
                    <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </nav>
</header>