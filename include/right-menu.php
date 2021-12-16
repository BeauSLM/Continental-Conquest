                <div class="right">
                    <div class="menu-header">
                        User Info
                    </div>
                    <div class="menu-content">
                    <?php
                        if(isset($_COOKIE["admin"]) && isset($_COOKIE['password'])) {
                                echo "Welcome ".$_COOKIE["admin"]."!<br/>";
                                echo "<a href='logout.php'>Logout</a>";
                                echo "
                                    <div class='menu-header'>
                                        Admin Panel
                                    </div>                    
                                    <div class='menu-content'>
                                        <a href='selecteditplayer.php'>Edit Player</a><br>
                                        <a href='selecteditcharacter.php'>Edit Character</a><br>
                                        <a href='selecteditguild.php'>Edit Guild</a><br>
                                        <a href='viewtickets.php'>View Tickets</a><br>
                                    </div>
                                    ";
                        } else {
                            echo "Welcome, guest.<br>
                            <a href='login.php'>Admin Login</a><br>
                            ";
                            
                        }
                    ?>
                    </div>
                    <div>

                    </div>

                </div>