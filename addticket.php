<?php
    include 'include/connectDB.php';
    if(isset($_COOKIE["admin"]) || isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    
    if(isset($_POST["player_id"]) && isset($_POST["password"]) && isset($_POST["category"]) && isset($_POST["issue"])) {
        //if we have set all the post variables when calling remove item
        $player_id = $_POST["player_id"];
        $password = $_POST["password"];
        $category = $_POST["category"];
        $issue = $_POST["issue"];

        $stmt = $db->connection->prepare('SELECT * FROM USERS, PLAYERS WHERE Acct_ID=Player_ID AND Acct_ID = ? AND Password = ?');
        $stmt->bind_param('is', $player_id, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0) {
            echo "
                <div class='center'>
                    <div id='center-content'>
                        Create Ticket Failed: Player ID doesn't exist or password was invalid.
                        <br/><a href='createticket.php'>Create Ticket</a>
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
                ";
        }
        else {
            $null_value = NULL;
            $status = 'Pending';
            $date = date("Y-m-d");
            $stmt = $db->connection->prepare('INSERT INTO TICKET(Issue, Category, Date, Player_ID, Admin_ID, Status) VALUES(?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssiis', $issue, $category, $date, $player_id, $null_value, $status);
            $stmt->execute();
            if($stmt->affected_rows == 0) {
                echo "
                <div class='center'>
                    <div id='center-content'>
                        Ticket failed. Please try again.
                        <br/><a href='createticket.php'>Create another ticket</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div> ";
            } else {
                echo "
                <div class='center'>
                    <div id='center-content'>
                        Ticket successfully created.
                        <br/><a href='createticket.php'>Create another ticket</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div> ";
            }
        }
    } else {
        //not correct fields
        echo "
            <div class='center'>
                <div id='center-conte
                nt'>
                    Create Ticket Failed: You have not specified the proper fields.
                    <br/><a href='createticket.php'>Create a ticket</a>
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