<?php
    include 'include/connectDB.php';
    if(!isset($_COOKIE["admin"]) || !isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    
    if(isset($_POST["guild_name"]) && isset($_POST["leader_id"]) && isset($_POST["xp"]) && isset($_POST["level"]) && isset($_POST["gold"])) {
        //if we have set all the post variables when calling remove item
        $guild = $_POST["guild_name"];
        $leader_id = $_POST["leader_id"];
        $xp = $_POST["xp"];
        $level = $_POST["level"];
        $gold = $_POST["gold"];


        $stmt = $db->connection->prepare('SELECT * FROM GUILD WHERE Guild_name = ?');
        $stmt->bind_param('i', $guild);
        $stmt->execute();
        $checkGuild = $stmt->get_result();

        $stmt = $db->connection->prepare('SELECT * FROM PLAYERS WHERE Player_ID = ? AND Guild = ?');
        $stmt->bind_param('is', $leader_id, $guild);
        $stmt->execute();
        $checkLeader = $stmt->get_result();

        if($checkGuild->num_rows == 0) {
            echo "
                <div class='center'>
                    <div id='center-content'>
                        Guild does not exist in database. Go back to main page. <a href='index.php'>Index</a>
                    </div>
                </div>
                ";
        }
        else {
            if($checkLeader->num_rows == 0) {
                echo "
                    <div class='center'>
                        <div id='center-content'>
                            The selected leader does not exist or is not a part of the guild. Go back to main page. <a href='index.php'>Index</a>
                        </div>
                    </div>
                    ";                
            }
            else {
                if($gold >= 0 && $level >= 0 && $xp >= 0) {
                    $stmt = $db->connection->prepare('UPDATE GUILD SET Leader_ID = ?, XP = ?, Level = ?, Gold = ? WHERE Guild_name = ?');
                    $stmt->bind_param('iiiis', $leader_id, $xp, $level, $gold, $guild);
                    $stmt->execute();
                    if($stmt->affected_rows == 0) {
                        echo "
                        <div class='center'>
                            <div id='center-content'>
                                Error: Update did not occur. <a href='index.php'>Index</a>
                            </div>
                        </div>
                        ";
                    } else {
                        echo "
                        <div class='center'>
                            <div id='center-content'>
                                Guild successfully updated. Go back to main page. <a href='index.php'>Index</a>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='center'>
                        <div id='center-content'>
                            XP, Gold or Level values are invalid. Go back to main page. <a href='index.php'>Index</a>
                        </div>
                    </div>
                    ";                    
                }
            }
        }
    } else {
        //not correct fields
        echo "
            <div class='center'>
                <div id='center-content'>
                    You have not specified the proper fields, this shouldn't happen. Go back to main page. <a href='index.php'>Index</a>
                    ".$_POST["guild_name"]." -
                    ".$_POST["leader_id"]." -
                    ".$_POST["xp"]." -
                    ".$_POST["level"]." -
                    ".$_POST["gold"]."
                </div>
            </div>
            ";
    }
?>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>