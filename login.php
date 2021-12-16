<?php
    include 'include/connectDB.php';

    if(isset($_COOKIE['admin']) && isset($_COOKIE['password'])) {
        header("Location: index.php");
        exit();
    }

    if(isset($_POST['username']) && isset($_POST['password'])) {
        //$_POST['username'] represents account ID only for this page.
        $process = true;
        $stmt = $db->connection->prepare('SELECT * FROM USERS, ADMINS WHERE Acct_ID = Admin_ID AND USERS.Acct_ID = ? AND USERS.Password = ?');
        $stmt->bind_param('ss', $_POST['username'], $_POST['password']); // 's' specifies the variable type => 'string'
    
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 0) {
            $success = false;
        } else {
            $account = $result->fetch_row();
            $success = true;
            setcookie('admin', $account[3], time()+3600);
            setcookie('password', $account[4], time()+3600);
        }
    } else {
        $process = false;
    }
    include 'include/header.php';
    include 'include/left-menu.php';
?>
                <div class="center">
                    <div id="center-content">
                        <?php
                        if($process == true) {
                            if($success == true) {
                                echo "You have successfully logged in as an Administrator.";
                                header("Location: index.php");
                            } else {
                                echo "You cannot login with the given credentials. Please try again.";
                            }
                        } else {
                            echo "
                                <table id='table_players'>
                                <tr class='table_players_row'>
                                    <td class='table_players_data' id='table_players_title' colspan='2' >
                                        Admin Login
                                    </td>
                                </tr>
                                <form action='login.php' method='post'>
                                <tr class='table_players_row'>
                                    
                                    <td class='table_players_data'>
                                        Admin ID :
                                    </td>
                                    <td class='table_players_data'>
                                        <input class='input-fields' onfocus=\"this.value=''\" name='username' type='text' value='Enter Admin ID' />
                                    </td>
                                </tr>
                                <tr class='table_players_row'>
                                    <td class='table_players_data'>
                                        Password :
                                    </td>
                                    <td class='table_players_data'>
                                        <input class='input-fields' onfocus=\"this.value=''\" name='password' type='password' value='password' />
                                    </td>
                                </tr>

                                <tr class='table_players_row'>
                                    <td class='table_players_data' colspan='2'>
                                        <input type ='submit' class='submit-inputs' value='Login' />
                                    </td>
                                </tr>
                                </form>
                            </table>
                            ";
                        }
                        ?>
                    </div>
                </div>
<?php
    include 'include/right-menu.php';
    include 'include/footer.php';
?>