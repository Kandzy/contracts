<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/20/18
 * Time: 5:32 PM
 */
require_once "DocumetPrint.php";
//
$checkboxes = [
  "conn" => $_POST['conn'],
    "work" => $_POST['work'],
    "disc" => $_POST['disc']
];
$obj = new DocumetPrint($_POST['inp'], $_POST['type'], $checkboxes);
$obj->printContracts();

?>