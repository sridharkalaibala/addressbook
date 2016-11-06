<table>
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Street</th>
        <th>Zip</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        foreach ($data as $value){
    ?>
            <tr>
                <td> <?php echo $row['first_name']; ?> </td>
                <td> <?php echo $row['last_name']; ?> </td>
                <td> <?php echo $row['street']; ?> </td>
                <td> <?php echo $row['zip']; ?> </td>
                <td> <a href="index.php?action=update&edit_id=<?php echo $row['id']; ?>"> Edit </a>   </td>
                <td> <a href="index.php?action=update&delete_id=<?php echo $row['id']; ?>"> Delete </a>   </td>
            </tr>

    <?php
        }
    ?>
</table>