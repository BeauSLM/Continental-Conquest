<?php
    include 'include/connectDB.php';
    include 'include/header.php';
    include 'include/left-menu.php';

    //finds the characters
    $result = $db->connection->query('SELECT * FROM CHARACTERS ORDER BY XP DESC');
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="9">
                                    Top Characters (by XP)
                                </td>
                            </tr>

                            <tr class="table_players_row">
                            <td class="table_players_header_data">
                                    Ranking
                                </td>
                                <td class="table_players_header_data">
                                    Character Name
                                </td>
                                <td class="table_players_header_data">
                                    Player Name
                                </td>
                                <td class="table_players_header_data">
                                    Race
                                </td>
                                <td class="table_players_header_data">
                                    Class
                                </td>   
                                <td class="table_players_header_data">
                                    Total Experience
                                </td>
                                <td class="table_players_header_data">
                                    Level
                                </td> 
                                <td class="table_players_header_data">
                                    Gold
                                </td>                  
                            </tr>
                            <?php
                                $i = 1;
                                foreach($result as $char) {
                                    //finds the character
                                    $stmt = $db->connection->prepare('SELECT * FROM USERS WHERE Acct_ID = ?');
                                    $stmt->bind_param('i', $char['Acct_ID']);

                                    $stmt->execute();
                                    $username = $stmt->get_result()->fetch_row()[3];
                                    echo "
                                    <tr class='table_players_row' colspan='9'>
                                        <td class='table_players_data'>
                                            ".$i."
                                        </td>
                                        <td class='table_players_data'>
                                            <a href='viewcharacter.php?acct_id=".$char['Acct_ID']."&char_name=".$char['Name']."'>".$char['Name']."</a>
                                        </td>
                                        <td class='table_players_data'>
                                            <a href='viewplayer.php?acct_id=".$char['Acct_ID']."'>".$username."</a>
                                        </td>
                                        <td class='table_players_data'>
                                            ".$char['Class']."
                                        </td>
                                        <td class='table_players_data'>
                                            ".$char['Race']."
                                        </td>
                                        <td class='table_players_data'>
                                            ".$char['XP']."
                                        </td>
                                        <td class='table_players_data'>
                                            ".$char['Lvl']."
                                        </td>
                                        <td class='table_players_data'>
                                            ".$char['Gold']."
                                        </td>
                                    </tr>
                                    ";
                                    $i++;
                                }
                            ?>
                            </table>
                    </div>
                </div>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>