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
            <td class='table_players_data' id='table_players_title' colspan='3' >
                Create Ticket : 
                    <?php 
                        if ($result->num_rows == 0) { 
                            echo "<br/>Character not found.</td></tr>";
                        } else {
                            $row = $result->fetch_row();
                            echo $row[1];
        echo "
                </td>
            </tr>
            <form action='updatecharacter.php' method='post'>
                <input type='hidden' name='acct_id' value='".$acct_id."'/>
                <input type='hidden' name='char_name' value='".$char_name."'/>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Player ID :
                    </td>
                    <td class='table_players_data'>
                        ".$row[0]."
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Character Name :
                    </td>
                    <td class='table_players_data'>
                        ".$row[1]."
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Level :
                    </td>
                    <td class='table_players_data'>
                        <input name='level' class='input-fields' type='text' value='".$row[2]."' />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Experience :
                    </td>
                    <td class='table_players_data'>
                        <input name='xp' class='input-fields' type='text' value='".$row[3]."' />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Gold :
                    </td>
                    <td class='table_players_data'>
                        <input name='gold' class='input-fields' type='text' value='".$row[4]."' />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Location :
                    </td>
                    <td class='table_players_data'>
                        <input name='location' class='input-fields' type='text' value='".$row[5]."' />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Race :
                    </td>
                    <td class='table_players_data'>
                        <input name='race' class='input-fields' type='text' value='".$row[6]."' />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data'>
                        Class :
                    </td>
                    <td class='table_players_data'>
                        <input name='class' class='input-fields' type='text' value='".$row[7]."' />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data' colspan='2'>
                        <input type ='submit' class='submit-inputs' value='Update Character' />
                    </td>
                </tr>
                <tr class='table_players_row'>
                    <td class='table_players_data' colspan='2'>
                        Note: Changing race or class can result in equipped items with requirements being unequipped when the player enters the game.
                    </td>
                </tr>
            </form>
            ";
            ?>
            <br/>
            <br/>
            <table id="table_players">
                <tr class="table_players_row">
                    <td class="table_players_data" id="table_players_title" colspan="7" >
                        Remove Item
                    </td>
                </td>

                <?php
                    //fetch all equipped items
                    $stmt = $db->connection->prepare('SELECT * FROM ITEM NATURAL JOIN CHAR_SLOTS WHERE Acc_ID = ? AND Char_name = ? ORDER BY Item_ID');
                    $stmt->bind_param('is', $acct_id, $char_name);

                    $stmt->execute();
                    $equipped = $stmt->get_result();

                    $stmt = $db->connection->prepare('SELECT * FROM ITEM NATURAL JOIN CHAR_BAG WHERE Acc_ID = ? AND Char_name = ? ORDER BY Item_ID');
                    $stmt->bind_param('is', $acct_id, $char_name);

                    $stmt->execute();
                    $bag = $stmt->get_result();
                echo "
                <tr class='table_players_row'>
                    <form action='removeitem.php' method='post'>
                    <td class='table_players_data'>
                        Equipped: ";
                        if($equipped->num_rows != 0) {
                            echo"
                            <input type='hidden' name='acct_id' value='".$acct_id."'/>
                            <input type='hidden' name='char_name' value='".$char_name."'/>
                            <input type='hidden' name='operation' value='slot' />
                            <select name = 'item_id' class='input-fields' id='view-slot-items-selector'>
                            <option value='select'>Select Item...</option>
                            ";
                            foreach($equipped as $item) {
                                echo "<option value='".$item['Item_ID']."'>".$item['Item_ID']." : ".$item['Name']."</option>";
                            }
                            echo "</select>";
                        } else { //if char isn't in party, tells them that
                            echo "No Items";
                        }
                        echo"
                    </td>
                    <td class='table_players_data' colspan='2'>
                        <input type ='submit' class='submit-inputs' value='Remove Item' />
                    </td>
                    </form>
                </tr>
                <tr class='table_players_row'>
                    <form action='removeitem.php' method='post'>
                    <td class='table_players_data'>
                        Bag: ";
                        if($bag->num_rows != 0) {
                            echo"
                            <input type='hidden' name='acct_id' value='".$acct_id."'/>
                            <input type='hidden' name='char_name' value='".$char_name."'/>
                            <input type='hidden' name='operation' value='bag' />
                            <select name='item_id' class='input-fields' id='view-bag-items-selector'>
                            <option value='select'>Select Item...</option>
                            ";
                            foreach($bag as $item) {
                                echo "<option value='".$item['Item_ID']."'>".$item['Item_ID']." : ".$item['Name']."</option>";
                            }
                            echo "</select>";
                        } else { //if char isn't in party, tells them that
                            echo "No Items";
                        }
                        echo"
                    </td>
                    <td class='table_players_data' colspan='2'>
                        <input type ='submit' class='submit-inputs' value='Remove' />
                    </td>
                    </form>
                </tr>
                ";
                ?>
            </table>
            
            <table id="table_players">
                <tr class="table_players_row">
                    <td class="table_players_data" id="table_players_title" colspan="2" >
                        Add Item to Bag
                    </td>
                </tr>
                <tr class='table_players_row'>
                <form action='additem.php' method='post'>
                    <td class='table_players_data'>
                        <input type="hidden" name="acct_id" value="<?php echo $acct_id; ?>" />
                        <input type="hidden" name="char_name" value="<?php echo $char_name; ?>" />
                        <input class="input-fields" onfocus="this.value=''" name="item_id" type="text" value="Type Item ID..." />
                    </td>   
                    <td class='table_players_data' colspan='2'>
                        <input type ='submit' class='submit-inputs' value='Add Item' />
                    </td>
                </form>   
                </tr>

            <?php
            }
            ?>
        </table>
    </div>
</div>

<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>