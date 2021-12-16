<?php
    include 'include/connectDB.php';
    if(!isset($_COOKIE["admin"]) || !isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    
    if(isset($_POST["acct_id"]) && isset($_POST["char_name"]) && isset($_POST["level"]) && isset($_POST["xp"]) && isset($_POST["location"])
        && isset($_POST["gold"]) && isset($_POST["race"]) && isset($_POST["class"])) 
    {
        //if we have set all the post variables when calling remove item
        $acct_id = $_POST["acct_id"];
        $char_name = $_POST["char_name"];
        $level = $_POST["level"];
        $xp = $_POST["xp"];
        $gold = $_POST["gold"];
        $location = $_POST["location"];
        $race = $_POST["race"];
        $class = $_POST["class"];


        $stmt = $db->connection->prepare('SELECT * FROM CHARACTERS WHERE Acct_ID = ? AND Name = ?');
        $stmt->bind_param('is', $acct_id, $char_name);
        $stmt->execute();
        $checkChar = $stmt->get_result();

        $stmt = $db->connection->prepare('SELECT * FROM RACE WHERE Name = ?');
        $stmt->bind_param('s', $race);
        $stmt->execute();
        $checkRace = $stmt->get_result();

        $stmt = $db->connection->prepare('SELECT * FROM CLASS WHERE Name = ?');
        $stmt->bind_param('s', $class);
        $stmt->execute();
        $checkClass = $stmt->get_result();


        if($checkChar->num_rows == 0) {
            echo "
                <div class='center'>
                    <div id='center-content'>
                    Update failed: Character does not exist in database. This should not happen. Go back to main page. <a href='index.php'>Index</a>
                    </div>
                </div>
            ";
        }
        else if($checkRace->num_rows == 0) {
            echo "
                <div class='center'>
                    <div id='center-content'>
                        Update failed: Cannot change to race that does not exist.
                        <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                        <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
            ";
        }
        else if($checkClass->num_rows == 0) {
            echo "
                <div class='center'>
                    <div id='center-content'>
                        Update failed: Cannot change to class that does not exist.
                        <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                        <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
            ";
        }
        else if($level < 1 || $gold < 0 || $xp < 0) {
            echo "
            <div class='center'>
                <div id='center-content'>
                    Update failed: Invalid level, gold, or xp value. Go back to main page.
                    <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                    <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                    <br/><a href='index.php'>Return to Main Menu</a>
                </div>
            </div>
        ";
        }
        else {
            $stmt = $db->connection->prepare('UPDATE CHARACTERS SET Lvl = ?, XP = ?, Gold = ?, Location = ?, Race = ?, Class = ? WHERE Acct_ID = ? AND Name = ?');
            $stmt->bind_param('iiisssis', $level, $xp, $gold, $location, $race, $class, $acct_id, $char_name);
            $stmt->execute();

            if($stmt->affected_rows == 0) {
                echo "
                <div class='center'>
                    <div id='center-content'>
                        Update Failed: Update did not occur.
                        <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                        <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
                ";
            } else {
                echo "
                <div class='center'>
                    <div id='center-content'>
                        Update Success: Character successfully updated.
                        <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                        <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
                ";
            }
        }
    } else {
        //not correct fields
        echo "
            <div class='center'>
                <div id='center-content'>
                    Update Failed: You have not specified the proper fields, this shouldn't happen. 
                    <br/><a href='selecteditcharacter.php'>Edit another character</a> 
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