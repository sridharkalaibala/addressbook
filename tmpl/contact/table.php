<?php
    //pagination set up
    include_once 'lib/pagination.php';
    $limit          = 10;
    $start          = getStart($limit);
    $search         = isset($_GET['searchtxt']) ? $_GET['searchtxt'] : null;
    if(isset($_GET['parent'])){
        $parent_groups = $group->getAllParents($_GET['parent']);
        $parent_groups[] = $_GET['parent'];
        $data           = $contact->readByGroup($parent_groups, $search, $start, $limit);
        $total_records  = $contact->readByGroupTotal($parent_groups, $search);
    }
    else {
        $data           = $contact->read_all($search, $start, $limit);
        $total_records  = $contact->get_total_number($search);
    }

?>

<form action="" method="GET" name="group" id="group">
    <select  name="parent" id="parent">
        <?php foreach ($groups as $row){ ?>
            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
        <?php } ?>
    </select>
    <input id="group_submit" type="submit" value="View Group Contacts" />
</form>
<?php if(isset($_GET['parent'])) echo '<script> document.getElementById(\'parent\').value = \''.$_GET['parent'].'\'</script>'; ?>
<form action="" method="GET" name="search" id="search">
    <input name="searchtxt" id="searchtxt" type="text" placeholder="Search" value="<?php echo  isset($_GET['searchtxt']) ?  $_GET['searchtxt'] : ''; ?>" >
</form>
<table>

    <?php
    if(isset($_GET['parent'])) {
        $inheritGroups = '<caption> <strong>Linked Groups: </strong> [';
        foreach ($groups as $value) {
            if(in_array($value['id'],$parent_groups))
                $inheritGroups .= $value['name'].',';
        }
        echo rtrim($inheritGroups,',').']</caption>';
    }
    ?>
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Street</th>
        <th>City</th>
        <th>Zip</th>
        <th>Group</th>
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
                <td> <?php echo $value['group_name']; ?> </td>
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
    $page_name = isset($_GET['parent']) ? $page_name.'&parent='.$_GET['parent'].'&' : $page_name;
    echo getPagination($limit, $total_records, $page_name);
    ?>

</div>

