<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/20/18
 * Time: 5:32 PM
 */
require_once "DocumetPrint.php";
//var_dump($_POST);
//echo $_POST['inp'];
//$obj = new DocumetPrint("123")
//;
test();
function test(){
    $data = [
        'ID' => "Hello"
    ];
    echo json_encode($data);
}
?>