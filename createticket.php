<?php
    include 'include/connectDB.php';
    if(isset($_COOKIE["admin"]) && isset($_COOKIE["password"])) {
        header("Location: index.php");
        exit("");
    }
    include 'include/header.php';
    include 'include/left-menu.php';
?>

<div class='center'>
<div id='center-content'>
    <table id='table_players'>
        <tr class='table_players_row'>
            <td class='table_players_data' id='table_players_title' colspan='2' >
                Create Ticket : 
            </td>
        </tr>
            <form action='create_ticket.php' method='post'>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Player ID :
                    </td>
                    <td class='table_players_data'>
                        <input class="input-fields" onfocus="this.value=''" type="text" name="player_id" value="Type Username" />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Player Password :
                    </td>
                    <td class='table_players_data'>
                        <input class="input-fields" onfocus="this.value=''" type="password" name="password" value="Type password" />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Issue
                    </td>
                    <td class='table_players_data'>
                        <textarea class="input-fields" onfocus="this.value=''" name="w3review" rows="4" cols="50" value>Type your issue here</textarea>
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Category :
                    </td>
                    <td class='table_players_data'>
                        <input  class='input-fields' onfocus="this.value=''" name='category' type='text' value='Type Category' />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data' colspan='2'>
                        <input type ='submit' class='submit-inputs' value='Create Ticket' />
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