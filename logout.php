<?php
    include 'include/connectDB.php';

    if(!isset($_COOKIE['admin']) && !isset($_COOKIE['password'])) {
        header("Location: index.php");
        exit();
    }
    setcookie('admin', '', time()-3600);
    setcookie('password', '', time()-3600);

    include 'include/header.php';
    include 'include/left-menu.php';
?>
                <div class="center">
                    <div id="center-content">
                            You have successfully logged out. Go to <a href="index.php">main page.</a>
                            <?php
                            header("Location: index.php");
                            exit();
                            ?>
                    </div>
                </div>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>