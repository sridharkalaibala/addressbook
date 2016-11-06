<?php
if(!defined('ACCESS')) {
    die('Direct access not permitted');
}
include_once "lib/db.php";

 $action = $_REQUEST['action'];
 $message = null;
 $display = [];
 $data = [];
 $values = getValues();
 $db = new DB();

 switch ($action) {
     case 'add':
         if(isset($_POST['submit'])) {
             if(validation($values)) {
                 $db->update($values);
             }else {
                 $message = 'All fields ara mandatory';
                 $display[] = 'tmpl/add.php';
             }
         }else {
             $cities = $db->get_cities();
             $display[] = 'tmpl/add.php';
         }
     break;

     case 'update':
         if(isset($_POST['submit'])) {

         }else if(isset($_REQUEST['edit_id'])) {
             $cities = $db->get_cities();
             $display[] = 'tmpl/update.php';
         } else {
             $message = 'Invalid Request';
             $display[] = 'tmpl/add.php';
         }
     break;

     case 'delete':
         if(isset($_REQUEST['delete_id'])) {

         }else {
            $message = 'Invalid Request';
         }
     break;

     case 'export':
         echo "export to xml";
     break;

     default:
         $data = $db->read();
         $display[] = 'tmpl/table.php';

 }


function getValues()
{
    $post = [];
    foreach ($_POST as $index => $value ){
        $post[$index] = trim(htmlentities($_POST[$index], ENT_QUOTES, 'UTF-8'));
    }
    return $post;
}

function validation($values)
{
    if(count($values) < 5 )
        return false;

    foreach ($values as $value)
    {
        if(strlen($value) < 1) return false;
    }

    return true;

}