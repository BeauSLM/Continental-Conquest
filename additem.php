<?php
    include 'include/connectDB.php';
    if(!isset($_COOKIE["admin"]) || !isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    
    if(isset($_POST["acct_id"]) && isset($_POST["char_name"]) && isset($_POST["item_id"])) {
        //if we have set all the post variables when calling remove item
        $acct_id = $_POST["acct_id"];
        $char_name = $_POST["char_name"];
        $item_ID = $_POST["item_id"];

        $stmt = $db->connection->prepare('SELECT * FROM ITEM WHERE Item_ID = ?');
        $stmt->bind_param('i', $item_ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0) {
            echo "
                <div class='center'>
                    <div id='center-content'>
                        Insert Failed: Item ID does not exist in database.
                        <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                        <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
                ";
        }
        else {
            $stmt = $db->connection->prepare('SELECT * FROM CHAR_BAG WHERE Acc_ID = ? AND Char_Name = ? AND Item_ID = ?');
            $stmt->bind_param('isi', $acct_id, $char_name, $item_ID);
            $stmt->execute();
            $checkItem = $stmt->get_result();

            if($checkItem->num_rows > 0) {
                echo "
                <div class='center'>
                    <div id='center-content'>
                        Insert Failed: User already has item in bag. Go back to main page. <a href='index.php'>Index</a>
                        <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                        <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
                ";
            } else {
                $stmt = $db->connection->prepare('INSERT INTO CHAR_BAG(Acc_ID, Char_Name, Item_ID) VALUES(?, ?,  ?)');
                $stmt->bind_param('isi', $acct_id, $char_name, $item_ID);
                $stmt->execute();
                echo "
                <div class='center'>
                    <div id='center-content'>
                        Insert Success: Item with criteria : Account ID -> ".$acct_id."., Character Name-> ".$char_name.", Item ID -> ".$item_ID." was added to bag.
                        <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                        <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div> ";
            }
        }
    } else {
        //not correct fields
        echo "
            <div class='center'>
                <div id='center-content'>
                    Error: You have not specified the proper fields, this shouldn't happen.
                    <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
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