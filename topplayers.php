<?php
    include 'include/connectDB.php';
    include 'include/header.php';
    include 'include/left-menu.php';

    //finds the characters
    $query = 'SELECT DISTINCT Player_ID, Username, Guild, Playtime, SUM(XP), SUM(GOLD) FROM PLAYERS, USERS, CHARACTERS WHERE PLAYERS.Player_ID=USERS.Acct_ID AND CHARACTERS.Acct_ID = PLAYERS.Player_ID GROUP BY Player_ID ORDER BY SUM(XP) DESC';
    $result = $db->connection->query($query);
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="6">
                                    Top Players (by Total XP)
                                </td>
                            </tr>

                            <tr class="table_players_row">
                                <td class="table_players_header_data">
                                    Ranking
                                </td>
                                <td class="table_players_header_data">
                                    Username
                                </td>
                                <td class="table_players_header_data">
                                    Total Character XP
                                </td>
                                <td class="table_players_header_data">
                                    Total Character Gold
                                </td>
                                <td class="table_players_header_data">
                                    Playtime
                                </td>
                                <td class="table_players_header_data">
                                    Guild
                                </td>  
                            </tr>

                            <?php
                                $i = 1;
                                foreach($result as $player) {
                                    //finds the total XP
                                    echo "
                                    <tr class='table_players_row' colspan='6'>
                                        <td class='table_players_data'>
                                            ".$i."
                                        </td>
                                        <td class='table_players_data'>
                                            <a href='viewplayer.php?acct_id=".$player['Player_ID']."'>".$player['Username']."</a>
                                        </td>
                                        <td class='table_players_data'>
                                            ".$player["SUM(XP)"]."
                                        </td>
                                        <td class='table_players_data'>
                                            ".$player['SUM(GOLD)']."
                                        </td>
                                        <td class='table_players_data'>
                                            ".$player['Playtime']."
                                        </td>
                                        <td class='table_players_data'>
                                            <a href='viewguild.php?guild=".$player['Guild']."'>".$player['Guild']."</a>
                                        </td>
                                    </tr>
                                    ";
                                    $i++;
                                }
                            ?>
                            <tr>
                                <td class='table_players_data' colspan='6'>
                                    Note : Players without characters will not appear in this list.
                                </td>
                            </tr>
                            </table>
                    </div>
                </div>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>