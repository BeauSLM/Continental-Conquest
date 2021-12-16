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

    //finds the character
    $stmt = $db->connection->prepare('SELECT * FROM PLAYERS, USERS WHERE Player_ID = ? AND Player_ID=Acct_ID');
    $stmt->bind_param('i', $acct_id); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $result = $stmt->get_result();
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="7" >
                                    Viewing Player : 
                                    <?php 
                                        if ($result->num_rows == 0) { 
                                            echo "<br/>Player not found.";
                                        } else {
                                            $row = $result->fetch_row();
                                            echo $row[7];
                                        ?>
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_header_data">
                                    Username
                                </td>
                                <td class="table_players_header_data">
                                    Account ID
                                </td>
                                <td class="table_players_header_data">
                                    Playtime
                                </td>
                                <td class="table_players_header_data">
                                    Subscription
                                </td>
                                <td class="table_players_header_data">
                                    Characters
                                </td>
                                <td class="table_players_header_data">
                                    Guild
                                </td>
                                <td class="table_players_header_data">
                                    Friended Players
                                </td>                
                            </tr>
                            <?php
                                //1-Name, 2-Lvl, 3-XP, 4-Gold, 5-Location, 6-Race, 7-Class
                                echo "  <tr class='table_players_row'>
                                            <td class='table_players_data'>
                                                ".$row[7]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[0]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[1]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[2]."
                                            </td>
                                            <td class='table_players_data'>
                                ";

                                //selects their characters
                                $stmt = $db->connection->prepare('SELECT * FROM CHARACTERS WHERE Acct_ID = ?');
                                $stmt->bind_param('i', $row[0]); // 's' specifies the variable type => 'string'

                                $stmt->execute();
                                $characters = $stmt->get_result();   
                                
                                if($characters->num_rows != 0) { //if character in party show the party members.
                                ?>  <form method="post">
                                        <select class="input-fields" id="view-character-selector" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                            <?php
                                                echo "<option>Select...</option>";
                                                foreach($characters as $character) {
                                                    echo "<option value='viewcharacter.php?acct_id=".$row[0]."&char_name=".$character['Name']."'>".$character['Name']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </form>
                                <?php
                                } else { //if no chars
                                    echo "No Characters";
                                }
                            ?>
                                    </td>
                                    <td class='table_players_data'>
                                        <?php
                                        if($row[3] != "") {
                                            echo "<a href='viewguild.php?guild=".$row[3]."'>".$row[3]."</a>";
                                        } else {
                                            echo "No Guild";
                                        }
                                        ?>
                                    </td>
                                    <td class='table_players_data'>
                                    <?php
                                        $stmt = $db->connection->prepare('SELECT * FROM FRIEND_LIST, PLAYERS, USERS WHERE FRIEND_LIST.Acct_ID = ? AND Friend_ID = Player_ID AND Player_ID=USERS.Acct_ID;');
                                        $stmt->bind_param('i', $row[0]);
        
                                        $stmt->execute();
                                        $friends = $stmt->get_result();

                                        if($friends->num_rows != 0) { //if character in party show the party members.
                                            ?>  <form method="post">
                                                    <select class="input-fields" id="view-friend-selector" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                                        <?php
                                                            echo "<option>Select...</option>";
                                                            foreach($friends as $friend) {
                                                                echo "<option value='viewplayer.php?acct_id=".$friend['Friend_ID']."'>".$friend['Username']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </form>
                                            <?php
                                            } else { //if no chars
                                                echo "No Friends";
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