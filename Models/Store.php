<?php
class Store extends Model {
    private $TableName = "";
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
        $sql = "SELECT * FROM tools LEFT JOIN tools_given ON tools.ID_Tool = tools_given.ID_Tool_Given";

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