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
                                    Search Guild
                                </td>
                            </tr>
                            <form action="viewguild.php" method="post">
                                <tr class="table_players_row">
                                    <td class="table_players_data">
                                        Guild Name :
                                    </td>
                                    <td class="table_players_data">
                                        <input class="input-fields" onfocus="this.value=''" type="text" name="guild" value="Type Name to Search" />
                                    </td>
                                </tr>

                                <tr class="table_players_row">
                                    <td class="table_players_data" colspan="2">
                                        <input type ="submit" class="submit-inputs" value="Search" />
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>