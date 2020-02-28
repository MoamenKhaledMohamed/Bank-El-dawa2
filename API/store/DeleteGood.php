<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Models/Store.php';

// connect to data base
$Conn = new DataBase();
$db = $Conn->dbconnect();

// create Store
$store = new Store($db);

//Get Data From Body OF Header
$data =  json_decode(file_get_contents("php://input"));

// Put Data To Attributes
$store->IdTool = $data->IdTool;

//DELETED
$store->delete();