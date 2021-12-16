<?php
    include 'include/connectDB.php';
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewplayer.php?char_name=AlexanderTheGreat&acct_id
    if(isset($_POST["guild"])) {
        $guild = $_POST["guild"];
    } else {
        $guild = $_GET["guild"];
    }

    //finds the player
    $stmt = $db->connection->prepare('SELECT * FROM GUILD WHERE Guild_name = ?');
    $stmt->bind_param('s', $guild); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $result = $stmt->get_result();
?>

<div class='center'>
<div id='center-content'>
    <table id='table_players'>
        <tr class='table_players_row'>
            <td class='table_players_data' id='table_players_title' colspan='3' >
                Editing Guild : 
                    <?php 
                        if ($result->num_rows == 0) { 
                            echo "<br/>Guild not found.</td></tr>";
                        } else {
                            $row = $result->fetch_row();
                            echo $row[0];
        echo "
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data'>
                    Guild Name :
                </td>
                <td class='table_players_data'>
                    ".$row[0]."
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data'>
                    Leader ID :
                </td>
                <td class='table_players_data'>
                    <input class='input-fields' type='text' value='".$row[1]."' />
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data'>
                    Experience :
                </td>
                <td class='table_players_data'>
                    <input class='input-fields' type='text' value='".$row[2]."' />
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data'>
                    Level :
                </td>
                <td class='table_players_data'>
                    ".$row[3]."
                </td>
            </tr>
            <tr class='table_players_row'>
                <td class='table_players_data'>
                    Gold :
                </td>
                <td class='table_players_data'>
                    <input class='input-fields' type='text' value='".$row[4]."' />
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