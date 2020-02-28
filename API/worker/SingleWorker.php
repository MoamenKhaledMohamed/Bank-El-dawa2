<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/Worker.php';

// connect to data base
$Conn = new DataBase();
$db = $Conn->dbconnect();


$worker= new Worker($db);
$worker->ID=isset($_GET['ID']) ? $_GET['ID']:die();

$worker->read_single();
$worker_arr=array(
    'ID'=>$worker->ID,
    'employ_name'=>$worker->Name,
    'Phone'=>$worker->Phone,
    'Job'=>$worker->Job,
    'Qualification'=>$worker->Qualification,
    'Age'=>$worker->Age,
    'Salary'=>$worker->Salary,
    'Department_id'=>$worker->ID_Dep,
    'Image_profile'=>$worker->Image_profile,
    'name_of_department'=>$worker->Name_dep,
    'department_manager_id'=>$worker->manager_id
);

print_r(json_encode($worker_arr));
