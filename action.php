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
         $cities = $db->get_cities();
         $display['form'] = 'tmpl/form.php';
         if(isset($_POST['submit'])) {
             if(validation($values)) {
                 if($db->insert($values)) {
                     $message = 'Address added successfully';
                     $display['table'] = 'tmpl/table.php';
                     unset($display['form']);
                 }else {
                     $message = 'Address addition failed';
                 }
             }else {
                 $message = 'Please fill all fields';
             }
         }
     break;

     case 'update':
         $cities = $db->get_cities();
         $display['form'] = 'tmpl/form.php';
         if(isset($_POST['submit']) && isset($_REQUEST['edit_id'])) {
             if(validation($values)) {
                 if($db->update($values,$_REQUEST['edit_id'])) {
                     $message = 'Address updated successfully';
                     $data = $db->read_all();
                     $display['table'] = 'tmpl/table.php';
                     unset($display['form']);
                 }else {
                     $message = 'Address update failed';
                 }
             }else {
                 $message = 'Please fill all fields';
             }
         }else if(isset($_REQUEST['edit_id'])) {
             $values = $db->read($_REQUEST['edit_id']);
         } else {
             $message = 'Invalid Request';
         }
     break;

     case 'exportXML':
         $data = $db->read_all(null,0,10000);
         header('Content-type: text/xml');
         header('Content-Disposition: attachment; filename="addressbook.xml"');
         echo array_to_xml($data, new SimpleXMLElement('<root/>'))->asXML();
         exit;

     break;

     case 'exportCSV':
         $data = $db->read_all(null,0,10000);
         header("Content-type: text/csv");
         header("Content-Disposition: attachment; filename=addressbook.csv");
         header("Pragma: no-cache");
         header("Expires: 0");
         echo "Id,First Name,Last Name,Street,City,Zip\n";
         echo array_to_csv($data);
         exit;

     break;

     case 'exportExcel':
         $data = $db->read_all(null,0,10000);
         header("Content-Disposition: attachment; filename=\"addressbook.xls\"");
         header("Content-Type: application/vnd.ms-excel;");
         header("Pragma: no-cache");
         header("Expires: 0");
         echo "Id,First Name,Last Name,Street,City,Zip\n";
         echo array_to_csv($data);
         exit;

         break;

     case 'delete':
         if(isset($_REQUEST['delete_id'])) {
             if($db->delete($_REQUEST['delete_id']))
                 $message = 'Address deleted successfully.';
             else
                 $message = 'Address delete failed.';

         }else {
             $message = 'Invalid Request';
         }

     default:
         $display['table'] = 'tmpl/table.php';
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

function array_to_xml(array $arr, SimpleXMLElement $xml)
{
    foreach ($arr as $k => $v) {
        if(is_array($v)) {
            array_to_xml($v, $xml->addChild('address'));
        }else {
            $xml->addChild($k, $v);
        }
    }
    return $xml;
}

function array_to_csv($data) {
    $outputBuffer = fopen("php://output", 'w');
    foreach($data as $val) {
        fputcsv($outputBuffer, $val);
    }
    fclose($outputBuffer);
}
