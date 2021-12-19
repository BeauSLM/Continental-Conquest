<?php
    include 'include/connectDB.php';
    include 'include/header.php';
    include 'include/left-menu.php';
    //viewcharacter.php?char_name=AlexanderTheGreat&acct_id
    if(isset($_POST["acct_id"])) {
        $acct_id = $_POST["acct_id"];
        $char_name = $_POST["char_name"];
    } else {
        $acct_id = $_GET["acct_id"];
        $char_name = $_GET["char_name"];    }

    //finds the character
    $stmt = $db->connection->prepare('SELECT * FROM CHARACTERS WHERE Acct_ID = ? AND Name = ?');
    $stmt->bind_param('is', $acct_id, $char_name); // 's' specifies the variable type => 'string'

    $stmt->execute();
    $result = $stmt->get_result();
?>
                <div class="center">
                    <div id="center-content">
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="8" >
                                    Viewing Character : 
                                    <?php 
                                        if ($result->num_rows == 0) { 
                                            echo "<br/>Character not found.";
                                        } else {
                                            $row = $result->fetch_row();
                                            echo $row[1];
                                        ?>
                                </td>
                            </tr>
                            <tr class="table_players_row">
                                <td class="table_players_header_data">
                                    Character Name
                                </td>
                                <td class="table_players_header_data">
                                    Level
                                </td>
                                <td class="table_players_header_data">
                                    Experience
                                </td>  
                                <td class="table_players_header_data">
                                    Gold
                                </td>
                                <td class="table_players_header_data">
                                    Location
                                </td>
                                <td class="table_players_header_data">
                                    Race
                                </td>
                                <td class="table_players_header_data">
                                    Class
                                </td>
                                <td class="table_players_header_data">
                                    Party Members List
                                </td>                  
                            </tr>
                            <?php
                                //1-Name, 2-Lvl, 3-XP, 4-Gold, 5-Location, 6-Race, 7-Class
                                echo "  <tr class='table_players_row'>
                                            <td class='table_players_data'>
                                                ".$row[1]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[2]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[3]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[4]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[5]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[6]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$row[7]."
                                            </td>
                                                
                                            <td class='table_players_data'>
                                ";
                                        //finds the party they're in
                                        $stmt = $db->connection->prepare('SELECT * FROM PARTY WHERE Acct_ID = ? AND Ch_name = ?');
                                        $stmt->bind_param('is', $acct_id, $char_name); // 's' specifies the variable type => 'string'

                                        $stmt->execute();
                                        $result2 = $stmt->get_result()->fetch_row();    
                                        
                                        //
                                        $party_id = $result2[0];//fetches Party_id, FIRST ATTRIBUTE OF PARTY table.

                                        //finds their party members
                                        $stmt = $db->connection->prepare('SELECT * FROM PARTY WHERE Party_id = ?');
                                        $stmt->bind_param('i', $party_id); // 's' specifies the variable type => 'string'

                                        $stmt->execute();
                                        $partyresult = $stmt->get_result();
                                        if($partyresult->num_rows != 0) { //if character in party show the party members.
                            ?>
                                    <select class="input-fields"id="view-party-selector">
                                    <?php
                                        
                                            foreach($partyresult as $pmember) {
                                                echo "<option value=".$pmember['Ch_name'].">".$pmember['Ch_name']."</option>";
                                            }
                                    ?>
                                    </se
                                    lect>
                                    <?php
                                        } else { //if char isn't in party, tells them that
                                            echo "No Party.";
                                        }
                                    ?>
                                    </td>
                                </tr>
                            </table>
                            <br/>
                            <br/>
                            <table id="table_character_stats">
                                            <tr class="table_players_row">
                                                <td class="table_players_data" id="table_players_title" colspan="5" >
                                                    Character Stats
                                                </td>
                                            </tr>
                                            <tr class="table_players_row">
                                                <td class="table_players_header_data">
                                                    Attack
                                                </td>
                                                <td class="table_players_header_data">
                                                    Defense
                                                </td>
                                                <td class="table_players_header_data">
                                                    Hit Points
                                                </td>
                                                <td class="table_players_header_data">
                                                    Magic Power
                                                </td>
                                                <td class="table_players_header_data">
                                                    Speed
                                                </td>
                                            </tr>
                                            <?php
                                                //finds the party they're in
                                                $stmt = $db->connection->prepare('SELECT * FROM CHAR_STATS WHERE Acc_ID = ? AND Char_name = ?');
                                                $stmt->bind_param('is', $acct_id, $char_name); // 's' specifies the variable type => 'string'

                                                $stmt->execute();
                                                $stats = $stmt->get_result()->fetch_row();
                                                //1-Name, 2-Lvl, 3-XP, 4-Gold, 5-Location, 6-Race, 7-Class
                                                echo "
                                                <tr class='table_players_row'>
                                                    <td class='table_players_data'>
                                                        ".$stats[2]."
                                                    </td>
                                                    <td class='table_players_data'>
                                                        ".$stats[3]."
                                                    </td>
                                                    <td class='table_players_data'>
                                    
                                                    ".$stats[4]."
                                                    </td>
                                                    <td class='table_players_data'>
                                                        ".$stats[5]."
                                                    </td>
                                                    <td class='table_players_data'>
                                                        ".$stats[6]."
                                                    </td>
                                                </tr>
                                                ";
                                            ?>
                                        </table>
                        <br/>
                        <br/>
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="7" >
                                    Equipped Items
                                </td>
                            </td>

                            <?php
                                //fetch all equipped items
                                $stmt = $db->connection->prepare('SELECT * FROM CHAR_SLOTS WHERE Acc_ID = ? AND Char_name = ?');
                                $stmt->bind_param('is', $acct_id, $char_name);

                                $stmt->execute();
                                $equipped = $stmt->get_result();

                                //for each item equipped
                                foreach($equipped as $eqitem) {
                                    $item_id = $eqitem['Item_ID'];

                                    //grab the information about the item
                                    $stmt = $db->connection->prepare('SELECT * FROM ITEM NATURAL JOIN ITEM_STATS WHERE Item_ID = ?');
                                    $stmt->bind_param('i', $item_id); 

                                    $stmt->execute();
                                    $equippeditem = $stmt->get_result()->fetch_row();
                                    
                                    //and grab its class requirements
                                    $stmt = $db->connection->prepare('SELECT * FROM ITEM_CLASS_REQ WHERE Item_ID = ?');
                                    $stmt->bind_param('i', $item_id);

                                    $stmt->execute();
                                    $itemclasses = $stmt->get_result();

                                    //and display it all
                                    echo "
                                        <tr class='table_players_row'>
                                            <td class='table_players_data' id='table_players_title' colspan='7'>
                                                ".$eqitem['Slot_Type']."
                                            </td>           
                                        </tr>

                                        <tr class='table_players_row' colspan='7'>
                                            <td class='table_players_header_data'>
                                                Name
                                            </td>
                                            <td class='table_players_header_data'>
                                                Type
                                            </td>
                                            <td class='table_players_header_data'>
                                                Rarity
                                            </td>
                                            <td class='table_players_header_data'>
                                                Sell Price
                                            </td>
                                            <td class='table_players_header_data' colspan='2'>
                                                Description
                                            </td>
                                            <td class='table_players_header_data'>
                                                Usable By
                                            </td>          
                                        </tr>
                                        
                                        <tr class='table_players_row' colspan='6'>
                                            <td class='table_players_data'>
                                                ".$equippeditem[1]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[2]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[4]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[3]."
                                            </td>
                                            <td class='table_players_data' colspan='2'>
                                                ".$equippeditem[5]."
                                            </td>       
                                            <td class='table_players_data'>";
                                                if($itemclasses->num_rows != 0) {
                                                    echo"
                                                        <select class='input-fields' id='view-classreq-selector'>
                                                        ";
                                                        foreach($itemclasses as $class) {
                                                            echo "<option value=".$class['Class'].">".$class['Class']."</option>";
                                                        }
                                                    echo "</select>";
                                                } else { //if char isn't in party, tells them that
                                                    echo "No Requirements";
                                                }
                                    echo "
                                            </td>
                                        </tr>
                                        
                                        <tr class='table_players_row' colspan='7'>
                                            <td class='table_players_header_data'>
                                                Base Damage
                                            </td>
                                            <td class='table_players_header_data'>
                                                Base Defense
                                            </td>
                                            <td class='table_players_header_data'>
                                                Attack Bonus
                                            </td>
                                            <td class='table_players_header_data'>
                                                Defense Bonus
                                            </td>
                                            <td class='table_players_header_data'>
                                                HP Bonus
                                            </td>
                                            <td class='table_players_header_data'>
                                                MP Bonus
                                            </td>
                                            <td class='table_players_header_data'>
                                                Speed Bonus
                                            </td>                
                                        </tr>

                                        <tr class='table_players_row' colspan='7'>
                                            <td class='table_players_data'>
                                                ".$equippeditem[7]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[8]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[9]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[10]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[11]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[12]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[13]."
                                            </td>                
                                        </tr>
                                    ";
                                }
                            ?>
                        </table>

                        <br/>
                        <br/>
                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="7" >
                                    Equipment in Bag
                                </td>
                            </tr>

                            <?php
                                //fetch all equipped items
                                $stmt = $db->connection->prepare('SELECT * FROM CHAR_BAG WHERE Acc_ID = ? AND Char_name = ?');
                                $stmt->bind_param('is', $acct_id, $char_name);

                                $stmt->execute();
                                $equipped = $stmt->get_result();

                                //for each item equipped
                                foreach($equipped as $eqitem) {
                                    $item_id = $eqitem['Item_ID'];

                                    //grab the information about the item
                                    $stmt = $db->connection->prepare('SELECT * FROM ITEM NATURAL JOIN ITEM_STATS WHERE Item_ID = ?');
                                    $stmt->bind_param('i', $item_id); 

                                    $stmt->execute();
                                    $equippeditem = $stmt->get_result()->fetch_row();
                                    
                                    //and grab its class requirements
                                    $stmt = $db->connection->prepare('SELECT * FROM ITEM_CLASS_REQ WHERE Item_ID = ?');
                                    $stmt->bind_param('i', $item_id);

                                    $stmt->execute();
                                    $itemclasses = $stmt->get_result();

                                    //and display it all
                                    echo "
                                        <tr class='table_players_row'>
                                            <td class='table_players_data' id='table_players_title' colspan='7'>
                                                ".$equippeditem[1]."
                                            </td>           
                                        </tr>

                                        <tr class='table_players_row' colspan='7'>
                                            <td class='table_players_header_data'>
                                                Item Category
                                            </td>
                                            <td class='table_players_header_data'>
                                                Type
                                            </td>
                                            <td class='table_players_header_data'>
                                                Rarity
                                            </td>
                                            <td class='table_players_header_data'>
                                                Sell Price
                                            </td>
                                            <td class='table_players_header_data' colspan='2'>
                                                Description
                                            </td>
                                            <td class='table_players_header_data'>
                                                Usable By
                                            </td>          
                                        </tr>
                                        
                                        <tr class='table_players_row' colspan='6'>
                                            <td class='table_players_data'>
                                                ".$equippeditem[6]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[2]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[4]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[3]."
                                            </td>
                                            <td class='table_players_data' colspan='2'>
                                                ".$equippeditem[5]."
                                            </td>       
                                            <td class='table_players_data'>";
                                                if($itemclasses->num_rows != 0) {
                                                    echo"
                                                        <select class='input-fields' id='view-classreq-selector'>
                                                        ";
                                                        foreach($itemclasses as $class) {
                                                            echo "<option value=".$class['Class'].">".$class['Class']."</option>";
                                                        }
                                                    echo "</select>";
                                                } else { //if char isn't in party, tells them that
                                                    echo "No Requirements";
                                                }
                                    echo "
                                            </td>
                                        </tr>
                                        
                                        <tr class='table_players_row' colspan='7'>
                                            <td class='table_players_header_data'>
                                                Base Damage
                                            </td>
                                            <td class='table_players_header_data'>
                                                Base Defense
                                            </td>
                                            <td class='table_players_header_data'>
                                                Attack Bonus
                                            </td>
                                            <td class='table_players_header_data'>
                                                Defense Bonus
                                            </td>
                                            <td class='table_players_header_data'>
                                                HP Bonus
                                            </td>
                                            <td class='table_players_header_data'>
                                                MP Bonus
                                            </td>
                                            <td class='table_players_header_data'>
                                                Speed Bonus
                                            </td>                
                                        </tr>

                                        <tr class='table_players_row' colspan='7'>
                                            <td class='table_players_data'>
                                                ".$equippeditem[7]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[8]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[9]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[10]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[11]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[12]."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$equippeditem[13]."
                                            </td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </table>
                        <br/>
                        <br/>

                        <table id="table_players">
                            <tr class="table_players_row">
                                <td class="table_players_data" id="table_players_title" colspan="8" >
                                    Known Abilities
                                </td>
                            </tr>
                            <?php
                                $lvl = $row[2];
                                $race = $row[6];
                                $class = $row[7];

                                //fetch all known abilities
                                $stmt = $db->connection->prepare('SELECT * FROM ABILITY JOIN RACE_ABILITY WHERE Abil_name = Name AND Race = ? AND Lv_Req <= ? UNION ALL SELECT * FROM ABILITY JOIN CLASS_ABILITY WHERE Abil_name = Name AND Class = ? AND Lv_Req <= ? ORDER BY Lv_Req ASC');
                                $stmt->bind_param('sisi', $race, $lvl, $class, $lvl);
                                $stmt->execute();
                                $abilities = $stmt->get_result();



                                echo "                                
                                    <tr class='table_players_row' colspan='8'>
                                        <td class='table_players_header_data'>
                                            Name
                                        </td>
                                        <td class='table_players_header_data'>
                                            Description
                                        </td>
                                        <td class='table_players_header_data'>
                                            Mana Cost
                                        </td>
                                        <td class='table_players_header_data'>
                                            Damage
                                        </td>
                                        <td class='table_players_header_data'>
                                            Unlocked at Level
                                        </td>
                                        <td class='table_players_header_data'>
                                            Cooldown (s)
                                        </td>
                                        <td class='table_players_header_data'>
                                            Requirement
                                        </td>
                                    </tr>
                                ";
                                foreach($abilities as $ability) {
                                    echo "
                                        <tr class='table_players_row' colspan='8'>
                                            <td class='table_players_data'>
                                                ".$ability['Name']."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$ability['Description']."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$ability['Mana_Cost']."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$ability['Damage']."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$ability['Lv_Req']."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$ability['Cooldown']."
                                            </td>
                                            <td class='table_players_data'>
                                                ".$ability['Race']."
                                            </td>
                                        </tr>
                                        ";
                                }
                            ?>
                        </table>
                        <br/>
                        <br/>

                        <?php } ?>
                    </div>
                </div>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>