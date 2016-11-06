<?php
define('ACCESS', TRUE);
include_once 'action.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Address Book </title>
        <link rel="stylesheet" href="static/css/style.css">
        <script src="static/js/script.js" type="application/javascript" ></script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Address Book</h1>
                <ul>
                    <li><a href="index.php">Home / List</a></li>
                    <li><a href="index.php?action=add">Add New</a></li>
                    <li><a href="index.php?action=export">Export as XML</a></li>
                </ul>
            </div>

            <div id="body">
                <?php
                    if(isset($message)) echo "<div id='message'> $message </div>";
                    foreach ($display as $value) {
                        if (!include_once($value)) {
                            echo('<strong>Error:</strong> Failed to include tempalate');
                            die();
                        }
                    }
                ?>

            </div>

            <div id="footer">
                Copyright &copy; Lodur Softwares / lodur.ch
            </div>
        </div>

    </body>

</html>
