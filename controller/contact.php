<?php
if(!defined('ACCESS')) {
    die('Direct access not permitted');
}
include_once "modal/contact.php";
include_once "modal/group.php";

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '' ;
$message = null;
$display = [];
$data = [];
$values = getValues();
$contact = new Contact();
$group = new Group();

switch ($action) {
    case 'add':
        $cities = $contact->get_cities();
        $groups = $group->getGroups();
        $display['form'] = 'tmpl/contact/form.php';
        if(isset($_POST['submit'])) {
            if(validation($values)) {
                if($contact->insert($values)) {
                    $message = 'Address added successfully';
                    $display['table'] = 'tmpl/contact/table.php';
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
        $cities = $contact->get_cities();
        $groups = $group->getGroups();
        $display['form'] = 'tmpl/contact/form.php';
        if(isset($_POST['submit']) && isset($_REQUEST['edit_id'])) {
            if(validation($values)) {
                if($contact->update($values,$_REQUEST['edit_id'])) {
                    $message = 'Address updated successfully';
                    $data = $contact->read_all();
                    $display['table'] = 'tmpl/contact/table.php';
                    unset($display['form']);
                }else {
                    $message = 'Address update failed';
                }
            }else {
                $message = 'Please fill all fields';
            }
        }else if(isset($_REQUEST['edit_id'])) {
            $values = $contact->read($_REQUEST['edit_id']);
        } else {
            $message = 'Invalid Request';
        }
        break;

    case 'exportXML':
        $data = $contact->read_all(null,0,10000);
        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="addressbook.xml"');
        echo array_to_xml($data, new SimpleXMLElement('<root/>'))->asXML();
        exit;

        break;

    case 'exportCSV':
        $data = $contact->read_all(null,0,10000);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=addressbook.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "Id,First Name,Last Name,Street,City,Zip\n";
        echo array_to_csv($data);
        exit;

        break;

    case 'exportExcel':
        $data = $contact->read_all(null,0,10000);
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
            if($contact->delete($_REQUEST['delete_id']))
                $message = 'Contact deleted successfully.';
            else
                $message = 'Contact delete failed.';

        }else {
            $message = 'Invalid Request';
        }

    default:
        $display['table'] = 'tmpl/contact/table.php';
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
