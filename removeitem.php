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
                        Wasn't able to remove the item with the given criteria. Go back to main page. <a href='index.php'>Index</a>
                    </div>
                </div>
                ";
            } else {
                echo "
                <div class='center'>
                    <div id='center-content'>
                        Item with criteria : Account ID -> ".$acct_id."., Character Name-> ".$char_name.", Item ID -> ".$item_ID." was removed. Go back to main page. <a href='index.php'>Index</a>
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
                            Was not able to remove the item with the given criteria. Go back to main page. <a href='index.php'>Index</a>
                        </div>
                    </div>
                    ";
            } else {
                echo "
                    <div class='center'>
                        <div id='center-content'>
                            Item with criteria : Account ID -> ".$acct_id."., Character Name-> ".$char_name.", Item ID -> ".$item_ID." was removed. Go back to main page. <a href='index.php'>Index</a>
                        </div>
                    </div>
                    ";
            }
        } else {
            echo "
            <div class='center'>
                <div id='center-content'>
                    Operation unspecified, this shouldn't happen. Go back to main page. <a href='index.php'>Index</a>
                </div>
            </div>
            ";
        }
    } else {
        //not correct fields
        echo "
            <div class='center'>
                <div id='center-content'>
                    You have not specified the proper fields, this shouldn't happen. Go back to main page. <a href='index.php'>Index</a>
                </div>
            </div>
            ";
    }
?>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>