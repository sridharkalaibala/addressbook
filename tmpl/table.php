<table>
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Street</th>
        <th>City</th>
        <th>Zip</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        foreach ($data as $value){
    ?>
            <tr>
                <td> <?php echo $value['first_name']; ?> </td>
                <td> <?php echo $value['last_name']; ?> </td>
                <td> <?php echo $value['street']; ?> </td>
                <td> <?php echo $value['city']; ?> </td>
                <td> <?php echo $value['zip']; ?> </td>
                <td> <a href="index.php?action=update&edit_id=<?php echo $value['id']; ?>"> Edit </a>   </td>
                <td> <a href="index.php?action=delete&delete_id=<?php echo $value['id']; ?>" onclick="return confirmDelete()"> Delete </a>   </td>
            </tr>

    <?php
        }
    ?>
</table>