<?php
    include 'include/connectDB.php';
    include 'include/header.php';
    include 'include/left-menu.php';
    $result = $db->connection->query('SELECT * FROM GUILD ORDER BY XP DESC');
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="5" >
                                    Top Guilds (by Guild XP)
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_header_data">
                                    Ranking
                                </td>    
                                <td class="table_players_header_data">
                                    Guild Name
                                </td>
                                <td class="table_players_header_data">
                                    Guild XP
                                </td>
                                <td class="table_players_header_data">
                                    Guild Level
                                </td>
                                <td class="table_players_header_data">
                                    Guild Gold
                                </td>
                            </tr>
                            <?php
                            $i = 1;
                            foreach($result as $guild) {
                                echo "
                                    <tr class='table_players_row'>
                                        <td class='table_players_data'>
                                            ".$i."
                                        </td>
                                        <td class='table_players_data'>
                                            <a href='viewguild.php?guild=".$guild['Guild_name']."'>".$guild['Guild_name']."</a>
                                        </td>
                                        <td class='table_players_data'>
                                            ".$guild['XP']."
                                        </td>
                                        <td class='table_players_data'>
                                            ".$guild['Level']."
                                        </td>
                                        <td class='table_players_data'>
                                            ".$guild['Gold']."
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