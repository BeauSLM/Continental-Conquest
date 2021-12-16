<?php
    include 'include/connectDB.php';
    if(!isset($_COOKIE["admin"]) || !isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    
    if(isset($_POST["acct_id"]) && isset($_POST["username"]) && isset($_POST["password"]) &&  isset($_POST["fname"]) && isset($_POST["lname"]) 
        && isset($_POST["guild"]) && isset($_POST["email"]) && isset($_POST["sub_status"])) 
    {
        //if we have set all the post variables when calling remove item
        $acct_id = $_POST["acct_id"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $guild = $_POST["guild"];
        $email = $_POST["email"];
        $sub_status = $_POST["sub_status"];



        $stmt = $db->connection->prepare('SELECT * FROM USERS, PLAYERS WHERE Acct_ID = Player_ID AND Acct_ID = ?');
        $stmt->bind_param('i', $acct_id);
        $stmt->execute();
        $checkUser = $stmt->get_result();
        
        if($checkUser->num_rows == 0) 
        {
            echo "
                <div class='center'>
                    <div id='center-content'>
                        User does not exist in database or is not a player. This shouldn't happen. Go back to main page. <a href='index.php'>Index</a>
                    </div>
                </div>
                ";
        } 
        else {
            $stmt = $db->connection->prepare('SELECT * FROM GUILD WHERE Leader_ID = ?');
            $stmt->bind_param('i', $acct_id);
            $stmt->execute();
            $checkLeader = $stmt->get_result();

            //if we're switching guild
            if($checkUser->fetch_row()[10] != $guild) {
                //if we're changing them to an empty guild
                if($guild == '') {
                    //if they're the leader of another guild
                    if($checkLeader->num_rows > 0) {
                        echo "
                        <div class='center'>
                            <div id='center-content'>
                                Cannot remove guild association as the selected user is the leader of a guild. Go back to main page. <a href='index.php'>Index</a>
                            </div>
                        </div>
                        ";  
                    }
                    //if they aren't a leader
                    else {
                        $stmt1 = $db->connection->prepare('UPDATE USERS SET Fname = ?, Lname = ?, Username = ?, Password = ?, Email = ? WHERE Acct_ID = ?');
                        $stmt1->bind_param('sssssi', $fname, $lname, $username, $password, $email, $acct_id);
                        $stmt1->execute();
                        $nullvalue = NULL;
                        $stmt2 = $db->connection->prepare('UPDATE PLAYERS SET Sub_status = ?, Guild = ? WHERE Player_ID = ?');
                        $stmt2->bind_param('ssi', $sub_status, $nullvalue, $acct_id);
                        $stmt2->execute();

                        echo "
                        <div class='center'>
                            <div id='center-content'>
                                Player successfully updated. Go to main page. <a href='index.php'>Index</a>
                            </div>
                        </div>
                        ";
                    }
                }
                //we're changing them to another existing guild
                else {
                    $stmt = $db->connection->prepare('SELECT * FROM GUILD WHERE Guild_name = ?');
                    $stmt->bind_param('s', $guild);
                    $stmt->execute();
                    $checkGuild = $stmt->get_result();
                    //if the guild exists
                    if($checkGuild->num_rows > 0) {
                        //if they're the leader of another guild
                        if($checkLeader->num_rows > 0) {
                            echo "
                            <div class='center'>
                                <div id='center-content'>
                                    Cannot change player's guild as the selected user is the leader of a guild. Go back to main page. <a href='index.php'>Index</a>
                                </div>
                            </div>
                            ";  
                        }
                        //if they aren't a leader
                        else {
                            $stmt1 = $db->connection->prepare('UPDATE USERS SET Fname = ?, Lname = ?, Username = ?, Password = ?, Email = ? WHERE Acct_ID = ?');
                            $stmt1->bind_param('sssssi', $fname, $lname, $username, $password, $email, $acct_id);
                            $stmt1->execute();
            
                            $stmt2 = $db->connection->prepare('UPDATE PLAYERS SET Sub_status = ?, Guild = ? WHERE Player_ID = ?');
                            $stmt2->bind_param('ssi', $sub_status, $guild, $acct_id);
                            $stmt2->execute();

                            echo "
                            <div class='center'>
                                <div id='center-content'>
                                    Player successfully updated. Go to main page. <a href='index.php'>Index</a>
                                </div>
                            </div>
                            ";
                        }
                    }
                    //if the guild doesnt exist
                    else {
                        echo "
                            <div class='center'>
                                <div id='center-content'>
                                    Cannot update to guild that does not exist. Go to main page. <a href='index.php'>Index</a>
                                </div>
                            </div>
                            ";
                    }
                }
            }
            //we aren't switching guild, no worries
            else {
                $stmt1 = $db->connection->prepare('UPDATE USERS SET Fname = ?, Lname = ?, Username = ?, Password = ?, Email = ? WHERE Acct_ID = ?');
                $stmt1->bind_param('sssssi', $fname, $lname, $username, $password, $email, $acct_id);
                $stmt1->execute();

                $stmt2 = $db->connection->prepare('UPDATE PLAYERS SET Sub_status = ?, Guild = ? WHERE Player_ID = ?');
                $stmt2->bind_param('ssi', $sub_status, $guild, $acct_id);
                $stmt2->execute();

                echo "
                <div class='center'>
                    <div id='center-content'>
                        [4] Player successfully updated. (No guild switch) Go to main page. <a href='index.php'>Index</a>
                    </div>
                </div>
                ";
            }

//-------------------------------------------

/*
            //if they're a leader of any guild but we're switching their guild, returns error
            if($checkLeader->num_rows > 0 && $checkUser->get_row()[10] != $guild) {
                echo "
                    <div class='center'>
                        <div id='center-content'>
                            Cannot change guild as the selected user is a leader of a guild. Go back to main page. <a href='index.php'>Index</a>
                        </div>
                    </div>
                    ";              
            } else {
                //They aren't a leader of a guild and it checks if the guild doesn't exist (but isn't empty.)
                if($checkGuild->num_rows == 0 && $guild != "") {
                    echo "
                    <div class='center'>
                        <div id='center-content'>
                            Trying to change to guild that doesn't exist. Try again. <a href='index.php'>Index</a>
                        </div>
                    </div>
                    ";
                }
                else {
                    //guild exists or guild=""
                    $stmt1 = $db->connection->prepare('UPDATE USERS SET Fname = ?, Lname = ?, Username = ?, Password = ?, Email = ? WHERE Acct_ID = ?');
                    $stmt1->bind_param('sssssi', $fname, $lname, $username, $password, $email, $acct_id);
                    $stmt1->execute();
    
                    $stmt2 = $db->connection->prepare('UPDATE PLAYERS SET Sub_status = ?, Guild = ? WHERE Player_ID = ?');
                    $stmt2->bind_param('ssi', $sub_status, $guild, $acct_id);
                    $stmt2->execute();

                    echo "
                    <div class='center'>
                        <div id='center-content'>
                            Player successfully updated. Go to main page. <a href='index.php'>Index</a>".$guild."
                        </div>
                    </div>
                    ";
                }
            }*/
        }
    }
    else {
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