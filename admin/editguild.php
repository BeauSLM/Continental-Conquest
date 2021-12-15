<?php
    include 'include/connectDB.php';
    include 'include/header.php';
    include 'include/left-menu.php';
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="2" >
                                    Edit Guild
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Name :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Guild Name" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Leader ID :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Leader ID" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    XP :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Guild XP" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Level :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Level" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Gold :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Gold" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data" colspan="2">
                                    Note: Alteration of XP and Level may cause errors.
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data" colspan="2">
                                    <input type ="submit" class="submit-inputs" value="Update" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>