<?php
?>
                <div class="left">
                    <div class="menu-header">
                        Player Menu
                    </div>
                    <div class="menu-content">
                        <a href="topplayers.php">View Top Players</a><br>
                        <a href="searchplayer.php">Search Player</a><br>
                    </div>
                    <div class="menu-header">
                        Character Menu
                    </div>
                    <div class="menu-content">
                        <a href="topcharacters.php">View Top Characters</a><br>
                        <a href="searchcharacter.php">Search Character</a><br>
                    </div>
                    <div class="menu-header">
                        Guild Menu
                    </div>
                    <div class="menu-content">
                        <a href="topguilds.php">View Top Guilds</a><br>
                        <a href="searchguild.php">Search Guilds</a><br>
                    </div>
                    <?php
                        if(isset($_COOKIE["admin"]) || isset($_COOKIE["password"])) {
                        
                        } else {
                            echo "
                            <div class='menu-header'>
                                Ticket Menu
                            </div>
                            <div class='menu-content'>
                                <a href='createticket.php'>Create Ticket</a><br>
                            </div>
                            ";
                        }
                    ?>
                </div>