<div id="form">

    <h2> <?php echo ucfirst($action); ?> Address: </h2>

    <form action="" method="post">

        <label for="parents">Group</label>
        <select name="group_id" id="group_id">
            <?php foreach ($groups as $row){ ?>
                <option value="<?php echo $row['id']; ?>"
                    <?php if(isset($values['group_id']) && $row['id'] == $values['group_id']) echo 'selected'?> > <?php echo $row['name']; ?> </option>
            <?php } ?>
        </select>

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?php if(isset($values['first_name'])) echo $values['first_name']; ?>" maxlength="50"  required>

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?php if(isset($values['last_name'])) echo $values['last_name']; ?>" maxlength="50"  required>

        <label for="street">Street</label>
        <input type="text" id="street" name="street" value="<?php if(isset($values['street'])) echo $values['street']; ?>" maxlength="250"  required>

        <label for="city">City</label>
        <select  id="city" name="city"  required>
            <?php foreach ($cities as $row){ ?>
                <option value="<?php echo $row['id']; ?>"> <?php echo $row['city']; ?> </option>
            <?php } ?>
        </select>

        <?php if(isset($values['city'])) echo '<script> document.getElementById(\'city\').value = \''.$values['city'].'\'</script>'; ?>

        <label for="zip">Zip</label>
        <input type="text" id="zip" name="zip" value="<?php if(isset($values['zip'])) echo $values['zip']; ?>" maxlength="10"  required>

        <input type="submit" id="submit" name="submit" value="Submit">

    </form>

    * Note: All fields are mandatory.

</div>