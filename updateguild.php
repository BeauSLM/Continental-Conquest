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
                        Update Failed: Guild does not exist in database.
                        <br/>Edit guild: <a href='editguild.php?guild=".$guild."'>".$guild."</a>
                        <br/><a href='selecteditguild.php'>Edit another guild</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
                ";
        }
        else {
            if($checkLeader->num_rows == 0) {
                echo "
                    <div class='center'>
                        <div id='center-content'>
                            Update Failed: The selected leader does not exist or is not a part of the guild.
                            <br/><a href='editguild.php?guild=".$guild."'>Edit guild: ".$guild."</a>
                            <br/><a href='selecteditguild.php'>Edit another guild</a> 
                            <br/><a href='index.php'>Return to Main Menu</a>
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
                                Update Failed: Update did not occur. 
                                <br/><a href='editguild.php?guild=".$guild."'>Edit guild: ".$guild."</a>
                                <br/><a href='selecteditguild.php'>Edit another guild</a> 
                                <br/><a href='index.php'>Return to Main Menu</a>
                            </div>
                        </div>
                        ";
                    } else {
                        echo "
                        <div class='center'>
                            <div id='center-content'>
                                Update Success: Guild successfully updated.
                                <br/><a href='editguild.php?guild=".$guild."'>Edit guild: ".$guild."</a>
                                <br/><a href='selecteditguild.php'>Edit another guild</a> 
                                <br/><a href='index.php'>Return to Main Menu</a>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='center'>
                        <div id='center-content'>
                            Update Failed: XP, Gold or Level values are invalid. Go back to main page.
                            <br/><a href='editguild.php?guild=".$guild."'>Edit guild: ".$guild."</a>
                            <br/><a href='selecteditguild.php'>Edit another guild</a> 
                            <br/><a href='index.php'>Return to Main Menu</a>
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
                    Update Failed: You have not specified the proper fields, this shouldn't happen.
                    <br/><a href='selecteditguild.php'>Edit another guild</a> 
                    <br/><a href='index.php'>Return to Main Menu</a>
                </div>
            </div>
            ";
    }
?>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>