<div id="form">

    <h2> <?php echo ucfirst($action); ?> Group: </h2>

    <form action="" method="post">
        <label for="parents">Parent Groups</label>
        <select class="multipleSelect" multiple name="parents[]" id="parents">
            <?php foreach ($groups as $row){ ?>
                <option value="<?php echo $row['id']; ?>"
                <?php if(isset($values['parents']) && is_array($values['parents']) && in_array($row['id'],$values['parents'])) echo 'selected'?> > <?php echo $row['name']; ?> </option>
            <?php } ?>
        </select>

        <label for="groups">Group Name</label>
        <input type="text" id="name" name="name" value="<?php if(isset($values['name'])) echo $values['name']; ?>" maxlength="50"  required>
        <input type="submit" id="submit" name="submit" value="Submit">

    </form>

    * Note: All fields are mandatory.

</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('.multipleSelect').fastselect();
    });
</script>