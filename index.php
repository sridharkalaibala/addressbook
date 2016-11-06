<?php
define('ACCESS', TRUE);
include_once 'action.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Address Book </title>
        <link rel="stylesheet" href="static/css/style.css">
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Address Book</h1>
            </div>

            <div id="body">

                <div id="add">

                    <h2>Add New Address: </h2>

                    <form action="index.php?action=add" method="post">

                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name">

                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name">

                        <label for="street">Street</label>
                        <input type="text" id="street" name="street">

                        <label for="city">City</label>
                        <input type="text" id="city" name="city">

                        <label for="zip">Zip</label>
                        <input type="text" id="zip" name="zip">

                        <input type="submit" id="submit" name="submit" value="Submit">


                    </form>

                </div>

                <?php
                    foreach ($display as $value) {
                        include_once $value;
                    }

                ?>


            </div>

            <div id="footer">
                Copyright &copy; Lodur Softwares / lodur.ch
            </div>
        </div>

    </body>

</html>
