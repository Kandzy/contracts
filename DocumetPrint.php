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

function checkboxes_check($status, $services_status){
    if (($services_status == 'connecting' && $status['conn'] == 'true') ||
        ($services_status == 'work' && $status['work'] == 'true') ||
        ($services_status == 'disconnected' && $status['disc'] == 'true') ||
        ($status['conn'] == 'false' && $status['work'] == 'false' && $status['disc'] == 'false')) {
        return true;
    }
    return false;
}

function request($data, $connect, $status,$param){
    $dbreq = "SELECT obj_customers.name_customer, obj_customers.company, obj_contracts.number, obj_contracts.date_sign, obj_contracts.id_contract FROM
        obj_customers LEFT JOIN obj_contracts ON obj_customers.id_customer = obj_contracts.id_customer 
        WHERE obj_customers.{$param}=?";
    if($req = $connect->prepare($dbreq)) {
        $var = $data;
        $req->bind_param("s", $var);
        $req->execute();
        $req->bind_result($name_custonmer, $company, $contract_number, $date_sign, $id);
        $result = array();
        while ($req->fetch()) {
            $temp = [
                "Customer_name" => $name_custonmer,
                "Company" => $company,
                "ContractN" => $contract_number,
                "Date" => $date_sign,
                'id' => $id,
                'services' => array()
            ];
            array_push($result, $temp);
        }
        $req->close();
    }
    $serviceReq = "SELECT obj_services.title_service, obj_services.id_contract, obj_services.status FROM obj_services";
    $services = array();
    if($reqserv = $connect->prepare($serviceReq)) {
        $var = $id;
        $reqserv->bind_param("s", $var);
        $reqserv->execute();
        $reqserv->bind_result($arr, $id, $services_status);
        while ($reqserv->fetch()){
            if (checkboxes_check($status, $services_status)) {
                $service = [
                    'service' => $arr,
                    'id' => $id
                ];
                array_push($services, $service);
            }
        }
        $reqserv->close();
    }
    $k = 0;
    while ($services[$k]) {
        $n = 0;
        while ($result[$n]) {
            if ($services[$k]['id'] == $result[$n]['id']) {
                    array_push($result[$n]['services'], $services[$k]['service']);
            }
            $n++;
        }
        $k++;
    }
    echo json_encode($result);
}

class ContractID {
    public function __construct($data, $connect, $status)
    {
        $dbreq = "SELECT obj_customers.name_customer, obj_customers.company, obj_contracts.number, obj_contracts.date_sign FROM
        obj_contracts LEFT JOIN obj_customers ON obj_customers.id_customer = obj_contracts.id_customer 
        WHERE obj_contracts.id_contract=?";
        if($req = $connect->prepare($dbreq)) {
            $var = $data;
            $req->bind_param("s", $var);
            $req->execute();
            $req->bind_result($name_custonmer, $company, $contract_number, $date_sign);
            $req->fetch();
            $req->close();
        }
        $serviceReq = "SELECT obj_services.title_service, obj_services.status FROM obj_services WHERE obj_services.id_contract =?";
        if($req = $connect->prepare($serviceReq)) {
            $var = $data;
            $req->bind_param("s", $var);
            $req->execute();
            $req->bind_result($arr, $services_status);
            $services = array();
            while ($req->fetch()){
                if (checkboxes_check($status, $services_status)) {
                    array_push($services, $arr);
                }
            }
        }
        $return_data = [
            "Customer_name" => $name_custonmer,
            "Company" => $company,
            "ContractN" => $contract_number,
            "Date" => $date_sign,
            "services" => $services,
        ];
        echo json_encode($return_data);
    }
}

class ClientID {
    public function __construct($data, $connect, $status){
        request($data, $connect, $status,'id_customer');
    }
}

class ClientName {
    public function __construct($data, $connect, $status)
    {
        request($data, $connect, $status, 'name_customer');
    }
}

class DocumetPrint
{
    private $connect;
    private $data;
    private $param;
    private $checkboxes;

    public function __construct($data, $param, $checkboxes)
    {
        $this->connect = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_errno()) {
            echo "Ошибка подключения к базе данных " . DB_DATABASE . ":({$this->connect->connect_errno}) {$this->connect->connect_error}<br>";
        }
        $this->data = $data;
        $this->param = $param;
        $this->checkboxes = $checkboxes;
    }

    public function printContracts()
    {
        if (class_exists($this->param)) {
            return new $this->param($this->data, $this->connect, $this->checkboxes);
        } else {
            echo "Error";
            die();
        }
    }
}