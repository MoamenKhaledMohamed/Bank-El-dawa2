<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


    include_once '../../Config/Database.php';
    include_once '../../Models/Needy.php';

    // connect to data base
    $Conn = new DataBase();
    $db = $Conn->dbconnect();

    //create Needy
    $needy = new Needy($db);

    //get id of needy
    $data =  json_decode(file_get_contents("php://input"));

    //set Attributes
    $needy->IdNeedy = $data->IdNeedy;
    $needy->Subvention_Type = $data->Subvention_Type;
    //$needy->Image_Profile = $data->Image_Profile;
    $needy->Name = $data->Name;
    $needy->Phone = $data->Phone;
    $needy->Qualification = $data->Qualification;
    $needy->Age = $data->Age;

    //UPDATE
    $needy->update();