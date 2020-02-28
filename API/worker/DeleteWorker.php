<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
//including files that needs
include_once '../../Config/Database.php';
include_once '../../Models/Worker.php';
//get connection
$Conn = new DataBase();
$db = $Conn->dbconnect();

//instantiat new object from model

$worker = new Worker($db);
//encoding file into json

$data = json_decode(file_get_contents("php://input"));
//getting data ready!!

$worker->ID=$data->ID;

//execute !!!
$worker->delete();