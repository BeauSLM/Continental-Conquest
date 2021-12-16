<?php
    include 'include/connectDB.php';
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewplayer.php?char_name=AlexanderTheGreat&acct_id
    if(isset($_POST["acct_id"])) {
        $acct_id = $_POST["acct_id"];
    } else {
        $acct_id = $_GET["acct_id"];
    }
    //finds the player
    $stmt = $db->connection->prepare('SELECT * FROM PLAYERS, USERS WHERE Player_ID = ? AND Player_ID=Acct_ID');
    $stmt->bind_param('i', $acct_id); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $result = $stmt->get_result();

?>
            <div class='center'>
                <div id='center-content'>
                    <table id='table_players'>
                        <tr class='table_players_row'>
                            <td class='table_players_data' id='table_players_title' colspan='3' >
                                Editing Player : 
                                    <?php 
                                        if ($result->num_rows == 0) { 
                                            echo "<br/>Player not found.</td></tr>";
                                        } else {
                                            $row = $result->fetch_row();
                                            echo $row[7];
                        echo "
                                </td>
                            </tr>
                            <tr class='table_players_row'>
                                <td class='table_players_data'>
                                    Username :
                                </td>
                                <td class='table_players_data'>
                                    <input class='input-fields' type='text' value='".$row[7]."' />
                                </td>
                            </tr>
                            <tr class='table_players_row'>
                                <td class='table_players_data'>
                                    First Name :
                                </td>
                                <td class='table_players_data'>
                                    <input class='input-fields' type='text' value='".$row[5]."' />
                                </td>
                            </tr>
                            <tr class='table_players_row'>
                                <td class='table_players_data'>
                                    Last Name :
                                </td>
                                <td class='table_players_data'>
                                    <input class='input-fields' type='text' value='".$row[6]."' />
                                </td>
                            </tr>
                            <tr class='table_players_row'>
                                <td class='table_players_data'>
                                    Guild :
                                </td>
                                <td class='table_players_data'>
                                    ".$row[3]."
                                </td>
                            </tr>
                            <tr class='table_players_row'>
                                <td class='table_players_data'>
                                    Email :
                                </td>
                                <td class='table_players_data'>
                                    <input class='input-fields' type='text' value='".$row[10]."' />
                                </td>
                            </tr>
                            <tr class='table_players_row'>
                                <td class='table_players_data'>
                                    Subcription Status:
                                </td>
                                <td class='table_players_data'>
                                    <select class='input-fields'id='subscription-selector'> ";
                                        if($row[2] == 'Subscribed') {
                                            echo "
                                            <option value='Subscribed' selected>Subscribed</option>
                                            <option value='Unsubscribed'>Unsubscribed</option>
                                            <option value='Trial'>Trial</option>
                                            ";
                                        }
                                        else if($row[2] == 'Unsubscribed') {
                                            echo "
                                            <option value='Unsubscribed' selected>Unsubscribed</option>
                                            <option value='Subscribed'>Subscribed</option>
                                            <option value='Trial'>Trial</option>
                                            ";
                                        }
                                        else if($row[2] == 'Trial') {
                                            echo"
                                            <option value='Trial' selected>Trial</option>
                                            <option value='Subscribed'>Subscribed</option>
                                            <option value='Unsubscribed'>Unsubscribed</option>
                                            ";
                                        }
                                    echo"
                                    </select>
                                </td>
                            </tr>
                            <tr class='table_players_row'>
                                <td class='table_players_data' colspan='2'>
                                    <input type ='submit' class='submit-inputs' value='Update' />
                                </td>
                            </tr>
                            ";
                            }
                        ?>
                        </table>
                    </div>
                </div>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>