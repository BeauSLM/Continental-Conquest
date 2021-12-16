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
    $stmt->bind_param('i', ticket_id);

    $stmt->execute();
    $result = $stmt->get_result();
?>

<div class='center'>
<div id='center-content'>
    <table id='table_players'>
        <tr class='table_players_row'>
            <td class='table_players_data' id='table_players_title' colspan='3' >
                Editing Ticket : ID = 
                    <?php
                        if ($result->num_rows == 0) { 
                            echo "<br/>Ticket not found.</td></tr>";
                        } else {
                            $row = $result->fetch_row();
                            echo $row[0];
        echo "
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
                    <input name='category' class='input-fields' type='text' value='".$row[1]."' />
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data'>
                    Experience :
                </td>
                <td class='table_players_data'>
                    <input name='xp' class='input-fields' type='text' value='".$row[2]."' />
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data'>
                    Level :
                </td>
                <td class='table_players_data'>
                    <input name='level' class='input-fields' type='text' value='".$row[3]."' />
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data'>
                    Gold :
                </td>
                <td class='table_players_data'>
                    <input name='gold' class='input-fields' type='text' value='".$row[4]."' />
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data' colspan='2'>
                    <input type ='submit' class='submit-inputs' value='Update Guild' />
                </td>
            </tr>
            </form>
            ";
            }
        ?>
        </table>
    </div>
</div>