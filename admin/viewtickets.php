<?php
    include 'include/connectDB.php';
    include 'include/header.php';
    include 'include/left-menu.php';
    
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="7" >
                                    Tickets
                                </td>
                            </td>
                            <tr class="table_players_row">
                                <td class="table_players_header_data">
                                    ID
                                </td>
                                <td class="table_players_header_data">
                                    Issue
                                </td>
                                <td class="table_players_header_data">
                                    Category
                                </td>
                                <td class="table_players_header_data">
                                    Date
                                </td>
                                <td class="table_players_header_data">
                                    Player ID
                                </td>
                                <td class="table_players_header_data">
                                    Admin ID
                                </td>
                                <td class="table_players_header_data">
                                    Status
                                </td>                
                            </tr>
                            <?php
                                $result = $db->connection->query('SELECT * from TICKET');
                                foreach($result as $row) {
                                    echo "  <tr class='table_players_row'>
                                                <td class='table_players_data'>
                                                    ".$row['Ticket_ID']."
                                                </td>
                                                <td class='table_players_data'>
                                                    ".$row['Issue']."
                                                </td>
                                                <td class='table_players_data'>
                                                    ".$row['Category']."
                                                </td>
                                                <td class='table_players_data'>
                                                    ".$row['Date']."
                                                </td>
                                                <td class='table_players_data'>
                                                    ".$row['Player_ID']."
                                                </td>
                                                <td class='table_players_data'>
                                                    ".(($row['Admin_ID'] == "") ? ("NULL") : ($row['Admin_ID'])) ."
                                                </td>
                                                <td class='table_players_data'>
                                                    ".$row['Status']."
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