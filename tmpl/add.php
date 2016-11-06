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
                        <select  id="city" name="city">
                        <?php foreach ($cities as $row){ ?>
                                <option value="<?php echo $row['id']; ?>"> <?php echo $row['city']; ?> </option>
                        <?php } ?>
                        </select>

                        <label for="zip">Zip</label>
                        <input type="text" id="zip" name="zip">

                        <input type="submit" id="submit" name="submit" value="Add">


                    </form>

</div>