<?php
    include 'include/functions.php';
    $db = new Database();
    $db -> init_connection('localhost', 'CONTINENTAL_CONQUEST', 'ensf409', 'ensf409');
    //cookies code :
    //setcookie($name, $value, $expire, $path, $domain); <-- should appear before HTML TAG.
    //example : setcookie("user", "John Doe", time()+3600); cookies are small files.
    //in order to store information about in a php session you need to first start one. Also before html tag.
    //stores information for all pages in our application
    //session_start(); how to use a cookie : example
    //if(isset($_COOKIE["user"])) { echo "Welcome". $_COOKIE["user"]."!<br/>"}
    //else {echo "Welcome Guest.";}
    //when you delete a cookie you need to just set the expiration date in the past.
    //setcookie("user", "", time()-3600);
    //a cookie is automaticoall URLencoded/decoded. To avoid that just use setrawcookie()
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="include/theme.css">
        <title>
            Welcome to Continental Conquest
        </title>
    </head>
    <body>
        <div class="grid-container">
            <div class="top">
                <div id="web-header">
                    Continental Conquest MMO Webpage
                    <?php
                        if($db->is_connected()) {
                            echo "You have succesfully connected to the db.";
                        } else {
                            echo "You were not able to connect to the db.";
                        }
                    ?>
                </div>
            </div>
                