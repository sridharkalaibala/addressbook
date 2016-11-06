<?php

if(!defined('ACCESS')) {
    die('Direct access not permitted');
}

 $action = $_REQUEST['action'];
 $message = '';
 $display = [];
 $data = [];

 switch ($action) {
     case 'add':
         if(isset($_POST['submit'])) {

         }else {
             $display[] = 'tmpl/add.php';
         }
     break;

     case 'update':
         if(isset($_POST['submit'])) {

         }else if(isset($_REQUEST['edit_id'])) {
             $display[] = 'tmpl/update.php';
         } else {
             $message = 'Invalid Request';
         }
     break;

     case 'delete':
         if(isset($_REQUEST['delete_id'])) {

         }else {
            $message = 'Invalid Request';
         }
     break;

     default:
         $display[] = 'tmpl/table.php';
     break;

 }

