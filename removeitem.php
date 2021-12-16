<?php
    include 'include/connectDB.php';
    if(!isset($_COOKIE["admin"]) || !isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    
    if(isset($_POST["operation"]) && isset($_POST["acct_id"]) && isset($_POST["char_name"]) && isset($_POST["item_id"])) {
        //if we have set all the post variables when calling remove item
        $operation = $_POST["operation"];
        $acct_id = $_POST["acct_id"];
        $char_name = $_POST["char_name"];
        $item_ID = $_POST['item_id'];
        
        if($operation == "bag") {
            $stmt = $db->connection->prepare('DELETE FROM CHAR_BAG WHERE Acc_ID = ? AND Char_Name = ? AND Item_ID=?');
            $stmt->bind_param('isi', $acct_id, $char_name, $item_ID);
            $stmt->execute();
            if($stmt->affected_rows == 0) {
                echo "
                <div class='center'>
                    <div id='center-content'>
                        Delete Failed: Wasn't able to remove item from bag with the given criteria.
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
                        Delete Success: Item with criteria : Account ID -> ".$acct_id."., Character Name-> ".$char_name.", Item ID -> ".$item_ID." was removed from bag.
                        <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                        <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div> ";
            }
        } else if($operation == "slot") {
            $stmt = $db->connection->prepare('DELETE FROM CHAR_SLOTS WHERE Acc_ID = ? AND Char_Name = ? AND Item_ID= ?');
            $stmt->bind_param('isi', $acct_id, $char_name, $item_ID);
            $stmt->execute();
            if($stmt->affected_rows == 0) {
                echo "
                    <div class='center'>
                        <div id='center-content'>
                            Delete Failed: Was not able to remove the item from slots with the given criteria.
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
                            Delete Success: Item with criteria : Account ID -> ".$acct_id."., Character Name-> ".$char_name.", Item ID -> ".$item_ID." was removed.
                            <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                            <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                            <br/><a href='index.php'>Return to Main Menu</a>
                        </div>
                    </div>
                    ";
            }
        } else {
            echo "
            <div class='center'>
                <div id='center-content'>
                    Error: Operation (bag or slot) unspecified, this shouldn't happen.
                    <br/><a href='editcharacter.php?acct_id=".$acct_id."&char_name=".$char_name."'>Edit character: ".$char_name."</a>
                    <br/><a href='selecteditcharacter.php'>Edit another character</a> 
                    <br/><a href='index.php'>Return to Main Menu</a>
                </div>
            </div>
            ";
        }
    } else {

        //not correct fields
        echo "
            <div class='center'>
                <div id='center-content'>
                    Error: You have not specified the proper fields or the user has no items.
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