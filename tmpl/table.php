<?php
    //pagination set up
    include_once 'pagination.php';
    $limit          = 10;
    $start          = getStart($limit);
    $search         = isset($_GET['searchtxt']) ? $_GET['searchtxt'] : null;
    $data           = $contact->read_all($search, $start, $limit);
    $total_records  = $contact->get_total_number($search);
?>

<form action="" method="GET" name="search">
    <input name="searchtxt" id="searchtxt" type="text" placeholder="Search" value="<?php echo  isset($_GET['searchtxt']) ?  $_GET['searchtxt'] : ''; ?>" >
</form>

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

<div id="pagination" align="center">

    <?php
    echo '<br> Showing '. count($data).' out of '.$total_records. ' records. <br> <br>';
    $page_name = isset($_GET['searchtxt']) ? 'index.php?searchtxt='.$_GET['searchtxt'].'&' : 'index.php?';
    echo getPagination($limit, $total_records, $page_name);
    ?>

</div>

