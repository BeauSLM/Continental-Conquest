<?php
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    if(isset($_POST["guild"])) {
        $guild = $_POST["guild"];
    } else {
        $guild = $_GET["guild"];
    }

    //finds the guild
    $stmt = $db->connection->prepare('SELECT * FROM GUILD WHERE Guild_name = ?');
    $stmt->bind_param('s', $guild); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $result = $stmt->get_result();

    //finds the guild leader
    $stmt = $db->connection->prepare('SELECT * FROM USERS, GUILD WHERE Guild_name = ? AND Leader_ID = Acct_ID');
    $stmt->bind_param('s', $guild); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $leader = $stmt->get_result()->fetch_row()[3];
?>

                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="6" >
                                    Viewing Guild : 
                                    <?php 
                                        if ($result->num_rows == 0) { 
                                            echo "<br/>Guild not found.";
                                        } else {
                                            $row = $result->fetch_row();
                                            echo $row[0];
                                        ?>
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_header_data">
                                    Name
                                </td>
                                <td class="table_players_header_data">
                                    Leader
                                </td>
                                <td class="table_players_header_data">
                                    XP
                                </td>
                                <td class="table_players_header_data">
                                    Level
                                </td>
                                <td class="table_players_header_data">
                                    Gold
                                </td>
                                <td class="table_players_header_data">
                                    Guild Members
                                </td>                
                            </tr>
                            <?php
                                //1-Name, 2-Lvl, 3-XP, 4-Gold, 5-Location, 6-Race, 7-Class
                                echo "  <tr class='table_players_row' colspan='6'>
                                            <td class='table_players_data'>
                                                ".$row[0]."
                                            </td>
                                            <td class='table_players_data'>
                                                <a href='viewplayer.php?acct_id=".$row[1]."'>".$leader."</a>
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[2]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[3]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[4]."
                                            </td>
                                            <td class='table_players_data'>
                                ";

                                //selects all members of the guild
                                $stmt = $db->connection->prepare('SELECT * FROM PLAYERS, USERS WHERE Guild = ? AND Player_ID = Acct_ID');
                                $stmt->bind_param('s', $row[0]); // 's' specifies the variable type => 'string'

                                $stmt->execute();
                                $players = $stmt->get_result();   
                                
                                if($players->num_rows != 0) { //if there is a member of the guild
                                ?>  <form method="post">
                                        <select class="input-fields" id="view-character-selector" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                            <?php
                                                echo "<option>Select...</option>";
                                                foreach($players as $player) {
                                                    echo "<option value='viewplayer.php?acct_id=".$player['Acct_ID']."'>".$player['Username']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </form>
                                <?php
                                } else { //if no members
                                    echo "This shouldn't happen.";
                                }
                            ?>
                                    </td>
                                </tr>
                            </table>
                            <br/>
                            <br/>
                        <?php } ?>
                    </div>
                </div>
                
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>