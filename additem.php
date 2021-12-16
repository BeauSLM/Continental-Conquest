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
                        Item ID does not exist in database. Go back to main page. <a href='index.php'>Index</a>
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
                        User already has item in bag. Go back to main page. <a href='index.php'>Index</a>
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
                        Item with criteria : Account ID -> ".$acct_id."., Character Name-> ".$char_name.", Item ID -> ".$item_ID." was added to bag. Go back to main page. <a href='index.php'>Index</a>
                    </div>
                </div> ";
            }
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