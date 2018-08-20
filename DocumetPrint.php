<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 8/20/18
 * Time: 2:53 PM
 */

DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', '12341234');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_DATABASE', 'testbase');

class DocumetPrint
{
    private $connect;

    public function __construct()
    {
        $this->connect = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_errno())
        {
            echo "Ошибка подключения к базе данных ".DB_DATABASE.":({$this->connect->connect_errno}) {$this->connect->connect_error}<br>";
        }
    }


}







//
//if($req = $this->connect->prepare("SELECT * FROM obj_contracts WHERE id_contract=?")) {
//    $var = '1';
//    $req->bind_param("s", $var);
//
//    $req->execute();
//    $req->bind_result($district, $fafa, $fafas, $fafad, $gfdgd);
//    while ($req->fetch()) {
//        echo ($district).'<br>';
//        echo ($fafa).'<br>';
//        echo ($fafas).'<br>';
//        echo ($fafad).'<br>';
//        echo $gfdgd.'<br>';
//    }
//    $req->close();
//}
//else{
//    echo 'error';
//}