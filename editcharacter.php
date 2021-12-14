<?php
    include 'include/header.php';
    include 'include/left-menu.php';
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="2" >
                                    Edit Character
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Account ID:
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Account ID" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Character Name :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Character Name" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    XP :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Experience" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Location :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Location" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Guild :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Guild" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Race
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Race" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Class
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Class" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Gold
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Gold" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data" colspan="2">
                                    Note: Alteration of Race and Class may corrupt character.
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