<div id="add">

                    <h2>Update Address: </h2>

                    <form action="index.php?action=update" method="post">

                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="<?php if(isset($values['first_name'])) echo $values['first_name']; ?>">

                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="<?php if(isset($values['last_name'])) echo $values['first_name']; ?>">

                        <label for="street">Street</label>
                        <input type="text" id="street" name="street" value="<?php if(isset($values['street'])) echo $values['first_name']; ?>">

                        <select  id="city" name="city">
                            <?php foreach ($cities as $row){ ?>
                                <option value="<?php echo $row['id']; ?>"> <?php echo $row['city']; ?> </option>
                            <?php } ?>
                        </select>

                        <label for="zip">Zip</label>
                        <input type="text" id="zip" name="zip" value="<?php if(isset($values['zip'])) echo $values['first_name']; ?>">

                        <input type="submit" id="submit" name="submit" value="Update">

                    </form>

</div>