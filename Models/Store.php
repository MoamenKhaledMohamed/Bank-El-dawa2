<?php
include_once 'Model.php';
class Store extends Model {
//    public $TableName = "";
    public $IdTool;
    public $NameTool;
    public $TypeTool;
    public $Quantity;
    public $DateIn;

    public function __construct ($db){
        parent::__construct($db);
     }

    public function read()
    {
        $sql = "SELECT * FROM tools LEFT JOIN tools_given ON tools.ID_Tool = tools_given.ID_Tool_Given 
                LEFT JOIN donners ON tools_given.ID_Donner = donners.ID_Donner
                LEFT JOIN persons ON persons.ID = donners.ID_Donner";

         // execute the query
         $stmt = $this->Conn->query($sql);

         return $stmt;




    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

}