<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');


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

    //get single Needy
    $stmt = $needy->read();
    $count = $stmt->rowCount();
    echo $count;

    if ($count > 0){

            // array holds data
            $Json  = [];

            // loop to print data
            $row = $stmt->fetch();
            $data = [] ;
            foreach($row as $key => $val) {
                $data[$key] = $val;
            }

            array_push($Json, $data);

            // convert array to json
            echo json_encode($Json);
    }

    else{
        // if not find data
        echo json_encode(
            array('data' => 'No data Found')
        );
    }
