<?php
    include 'include/connectDB.php';
    if(!isset($_COOKIE["admin"]) || !isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';

    if(isset($_POST["ticket_id"])) {
        $ticket_id = $_POST["ticket_id"];
    } else {
        $ticket_id = $_GET["ticket_id"];
    }

    //finds the ticket
    $stmt = $db->connection->prepare('SELECT * FROM TICKET WHERE Ticket_ID = ?');
    $stmt->bind_param('i', $ticket_id);

    $stmt->execute();
    $result = $stmt->get_result();
?>
    <?php
    if($result->num_rows == 0) {
        echo"
            <div class='center'>
                <div id='center-content'>
                    Update Failed: Ticket does not exist in database. This shouldn't happen.
                    <br/><a href='viewtickets.php'>View all tickets</a> 
                    <br/><a href='index.php'>Return to Main Menu</a>
                </div>
            </div>
            ";
    
    } else {
        $row = $result->fetch_row();
        echo "
            <div class='center'>
                <div id='center-content'>   
                    <table id='table_players'>
                        <tr class='table_players_row'>
                            <td class='table_players_data' id='table_players_title' colspan='3' >
                                Editing Ticket with ID : ".$row[0]."
                            </td>
                        </tr>
                        <form action='updateticket.php' method='post'>
                        <input type='hidden' name='ticket_id' value='".$ticket_id."'/>
                        <tr class='table_players_row'>
                            <td class='table_players_data'>
                                Issue :
                            </td>
                            <td class='table_players_data'>
                                ".$row[1]."
                            </td>
                        </tr>
                        <tr class='table_players_row'>
                            <td class='table_players_data'>
                                Category :
                            </td>
                            <td class='table_players_data'>
                                <select name='category' class='input-fields' id='category-selector'> ";
                                    if($row[2] == 'Character') {
                                        echo "
                                        <option value='Character' selected>Character</option>
                                        <option value='Account'>Account</option>
                                        <option value='Gameplay'>Gameplay</option>
                                        <option value='Other'>Other</option>
                                        ";
                                    }
                                    else if($row[2] == 'Account') {
                                        echo "
                                        <option value='Account' selected>Account</option>
                                        <option value='Character'>Character</option>
                                        <option value='Gameplay'>Gameplay</option>
                                        <option value='Other'>Other</option>
                                        ";
                                    }
                                    else if($row[2] == 'Gameplay') {
                                        echo"
                                        <option value='Gameplay' selected>Gameplay</option>
                                        <option value='Character'>Character</option>
                                        <option value='Account'>Account</option>
                                        <option value='Other'>Other</option>
                                        ";
                                    }
                                    else if($row[2] == 'Other') {
                                        echo"
                                        <option value='Other' selec>Other</option>
                                        <option value='Character'>Character</option>
                                        <option value='Account'>Account</option>
                                        <option value='Gameplay'>Gameplay</option>
                                        ";
                                    }
                                echo"
                                </select>
                            </td>
                        </tr>
                        <tr class='table_players_row'>
                            <td class='table_players_data'>
                                Date :
                            </td>
                            <td class='table_players_data'>
                                ".$row[3]."
                            </td>
                        </tr>
                        <tr class='table_players_row'>
                            <td class='table_players_data'>
                                Submitted by Player ID :
                            </td>
                            <td class='table_players_data'>
                                ".$row[4]."
                            </td>
                        </tr>
                        <tr class='table_players_row'>
                            <td class='table_players_data'>
                                Assigned to Admin ID :
                            </td>
                            <td class='table_players_data'>
                                <input name='admin_id' class='input-fields' type='text' value='".$row[5]."' />
                            </td>
                        </tr>
                        <tr class='table_players_row'>
                            <td class='table_players_data'>
                                Ticket Status :
                            </td>
                            <td class='table_players_data'>
                                <select class='input-fields' name='status' id='status-selector'>
                                    ";
                                    if($row[6] == 'Pending') {
                                        echo "
                                        <option value='Pending' selected>Pending</option>
                                        <option value='Under Review'>Under Review</option>
                                        <option value='Resolved'>Resolved</option>
                                        ";
                                    } else if($row[6] == 'Under Review') {
                                        echo "
                                        <option value='Under Review selected'>Under Review</option>
                                        <option value='Pending'>Pending</option>
                                        <option value='Resolved'>Resolved</option>
                                        ";
                                    }else {
                                        echo "
                                        <option value='Resolved' selected>Resolved</option>
                                        <option value='Pending'>Pending</option>
                                        <option value='Under Review'>Under Review</option>
                                        ";
                                    }
                                echo"
                                </select>
                            </td>
                        </tr>
                        <tr class='table_players_row'>
                            <td class='table_players_data' colspan='2'>
                                <input type ='submit' class='submit-inputs' value='Update Create' />
                            </td>
                        </tr>
                        </form>
                    </table>
                </div>
            </div>
        ";
    }
include 'include/right-menu.php';
include 'include/footer.php';
?>