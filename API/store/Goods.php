<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../Config/Database.php';
    include_once '../../Models/Store.php';

    // connect to data base
    $Conn = new DataBase();
    $db = $Conn->dbconnect();

    // create Store
    $store = new Store($db);
    $stmt = $store->read();

    // check data get
    $count = $stmt->rowCount();
        if ($count > 0){

                // array hold data
                $Json  = [];

                // loop to print data
                while ($row = $stmt->fetch()){

                    $data = [] ;

                    foreach($row as $key => $val) {
                        $data[$key] = $val;
                         }

                    array_push($Json, $data);

                }

                    // convert array to json
                echo json_encode($Json);
        }

        else{
                // if not find data
                echo json_encode(
                    array('data' => 'No data Found')
                );
        }

