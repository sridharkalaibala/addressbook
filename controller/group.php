<?php
if(!defined('ACCESS')) {
    die('Direct access not permitted');
}
include_once "model/group.php";

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '' ;
$message = null;
$display = [];
$data = [];
$values = getValues();
$group = new Group();
$groups = $group->getGroups();

switch ($action) {
    case 'add':
        $display['form'] = 'tmpl/group/form.php';
        if(isset($_POST['submit'])) {
            if(validation($values)) {
                if($group->insert($values)) {
                    $message = 'Group added successfully';
                    $display['table'] = 'tmpl/group/table.php';
                    unset($display['form']);
                }else {
                    $message = 'Group addition failed';
                }
            }else {
                $message = 'Please fill all fields';
            }
        }
        break;

    case 'update':
        $groups = $group->getGroups($_REQUEST['edit_id']);
        $display['form'] = 'tmpl/group/form.php';
        if(isset($_POST['submit']) && isset($_REQUEST['edit_id'])) {
            if(validation($values)) {
                if($group->update($values,$_REQUEST['edit_id'])) {
                    $message = 'Group updated successfully';
                    $data = $group->read_all();
                    $display['table'] = 'tmpl/group/table.php';
                    unset($display['form']);
                }else {
                    $message = 'Group update failed';
                }
            }else {
                $message = 'Please fill all fields';
            }
        }else if(isset($_REQUEST['edit_id'])) {
            $values = $group->read($_REQUEST['edit_id']);
        } else {
            $message = 'Invalid Request';
        }
        break;

    case 'exportXML':
        $data = $group->read_all(null,0,10000);
        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="groups.xml"');
        echo array_to_xml($data, new SimpleXMLElement('<root/>'))->asXML();
        exit;

        break;

    case 'exportCSV':
        $data = $group->read_all(null,0,10000);
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=groups.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "Id,First Name,Last Name,Street,City,Zip\n";
        echo array_to_csv($data);
        exit;

        break;

    case 'exportExcel':
        $data = $group->read_all(null,0,10000);
        header("Content-Disposition: attachment; filename=\"groups.xls\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "Id,First Name,Last Name,Street,City,Zip\n";
        echo array_to_csv($data);
        exit;

        break;

    case 'delete':
        if(isset($_REQUEST['delete_id'])) {
            if($group->delete($_REQUEST['delete_id']))
                $message = 'Group deleted successfully.';
            else
                $message = 'Group delete failed.';

        }else {
            $message = 'Invalid Request';
        }

    default:
        $display['table'] = 'tmpl/group/table.php';
}


/*
 *  Filtering POST values for security
 */

function getValues()
{
    $post = [];
    foreach ($_POST as $index => $value ){
        if(!is_array($_POST[$index]))
            $post[$index] = trim(htmlentities($_POST[$index], ENT_QUOTES, 'UTF-8'));
        else
            $post[$index] = $_POST[$index];
    }
    return $post;
}

/*
 *   Basic Validation for required fields
 */
function validation($values)
{
    if(count($values) < 2 )
        return false;

    foreach ($values as $value)
    {
        if(!is_array($value) && strlen($value) < 1) return false;
    }

    return true;

}

/*
 *   Converting PHP associative array to XML
 */
function array_to_xml(array $arr, SimpleXMLElement $xml)
{
    foreach ($arr as $k => $v) {
        if(is_array($v)) {
            array_to_xml($v, $xml->addChild('group'));
        }else {
            $xml->addChild($k, $v);
        }
    }
    return $xml;
}

/*
 *   Converting PHP associative array to CSV
 */
function array_to_csv($data) {
    $outputBuffer = fopen("php://output", 'w');
    foreach($data as $val) {
        fputcsv($outputBuffer, $val);
    }
    fclose($outputBuffer);
}
