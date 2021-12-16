<?php
    include 'include/connectDB.php';
    if(!isset($_COOKIE["admin"]) || !isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    
    if(isset($_POST["ticket_id"]) && isset($_POST["category"]) && isset($_POST["admin_id"]) && isset($_POST["status"]) ) {
        //if we have set all the post variables when calling remove item
        $ticket_id = $_POST["ticket_id"];
        $category = $_POST["category"];
        $status = $_POST["status"];
        $admin_id = $_POST["admin_id"];

        $stmt = $db->connection->prepare('SELECT * FROM TICKET WHERE Ticket_ID = ?');
        $stmt->bind_param('i', $ticket_id);
        $stmt->execute();
        $checkTicket = $stmt->get_result();
        
        $stmt = $db->connection->prepare('SELECT * FROM ADMINS WHERE Admin_ID = ?');
        $stmt->bind_param('i', $admin_id);
        $stmt->execute();
        $checkAdmin = $stmt->get_result();

        

        if($checkTicket->num_rows == 0) {
            echo "
                <div class='center'>
                    <div id='center-content'>
                        Update Failed: Ticket selected to update does not exist. This shouldn't happen.
                        <br/><a href='viewtickets.php'>View all tickets</a> 
                        <br/><a href='index.php'>Return to Main Menu</a>
                    </div>
                </div>
                ";
        }
        else {
            if($checkAdmin->num_rows == 0) {
                echo "
                    <div class='center'>
                        <div id='center-content'>
                            Update Failed: The Admin selected does not exist.
                            <br/><a href='editticket.php?ticket_id=".$ticket_id."'>Edit ticket: ".$ticket_id."</a>
                            <br/><a href='viewtickets.php'>View all tickets</a> 
                            <br/><a href='index.php'>Return to Main Menu</a>
                        </div>
                    </div>
                    ";                
            }
            else {

                $stmt = $db->connection->prepare('UPDATE TICKET SET Category = ?, Admin_ID = ?, Status = ? WHERE Ticket_ID = ?');
                $stmt->bind_param('sisi', $category, $admin_id, $status, $ticket_id);
                $stmt->execute();
                if($stmt->affected_rows == 0) {
                    echo "
                    <div class='center'>
                        <div id='center-content'>
                            Update Failed: Update did not occur. (Did you change any values?) 
                            <br/><a href='editticket.php?ticket_id=".$ticket_id."'>Edit ticket: ".$ticket_id."</a>
                            <br/><a href='viewtickets.php'>View all tickets</a> 
                            <br/><a href='index.php'>Return to Main Menu</a>
                        </div>
                    </div>
                    ";
                } else {
                    echo "
                    <div class='center'>
                        <div id='center-content'>
                            Update Success: Ticket successfully updated.
                            <br/><a href='editticket.php?ticket_id=".$ticket_id."'>Edit ticket: ".$ticket_id."</a>
                            <br/><a href='viewtickets.php'>View all tickets</a> 
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
                    <br/><a href='viewtickets.php'>View all tickets</a> 
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