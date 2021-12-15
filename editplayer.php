<?php
    include 'include/header.php';
    include 'include/left-menu.php';
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="2" >
                                    Edit Player
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Username :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Username" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    First Name :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter First Name" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Last Name :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Last Name" />
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
                                    Email :
                                </td>
                                <td class="table_players_data">
                                    <input class="input-fields" type="text" value="Enter Email" />
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data">
                                    Subcription Status:
                                </td>
                                <td class="table_players_data">
                                    <select class="input-fields"id="subscription-selector">
                                        <option value="Subscribed">Subscribed</option>
                                        <option value="Unsubscribed">Unsubscribed</option>
                                        <option value="Trial">Trial</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_data" colspan="2">
                                    Note: Alteration of Username may corrupt account.
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