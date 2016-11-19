<?php
    //pagination set up
    include_once 'lib/pagination.php';
    $limit          = 10;
    $start          = getStart($limit);
    $search         = isset($_GET['searchtxt']) ? $_GET['searchtxt'] : null;
    $data           = $group->read_all($search, $start, $limit);
    $total_records  = $group->get_total_number($search);
?>

<form action="" method="GET" name="search">
    <input name="searchtxt" id="searchtxt" type="text" placeholder="Search" value="<?php echo  isset($_GET['searchtxt']) ?  $_GET['searchtxt'] : ''; ?>" >
</form>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        foreach ($data as $value){
    ?>
            <tr>
                <td> <?php echo $value['id']; ?> </td>
                <td> <?php echo $value['name']; ?> </td>
                <td> <a href="index.php?control=group&action=update&edit_id=<?php echo $value['id']; ?>"> Edit </a>   </td>
                <?php if ($value['id'] == 1) echo "<td> N/A </td>"; else { ?>
                <td> <a href="index.php?control=group&action=delete&delete_id=<?php echo $value['id']; ?>" onclick="return confirmDelete()"> Delete </a>   </td>
                <?php } ?>
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

