<?php
include_once 'Model.php';
class Store extends Model {
//    public $TableName = "";
    public $IdTool;
    public $NameTool;
    public $TypeTool;
    public $Quantity;
    public $DateIn;
    public $NameOfDonner;
    public $IdDonner;

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
        try {
            // Start Transaction
            $this->Conn->beginTransaction();

            //Update Tools Table
            $stmt = $this->Conn->prepare("UPDATE tools SET Name_Tool = ?,TypeTool = ?,Quantatiy = ? WHERE ID_Tool = ?");
            $stmt->execute([
                $this->NameTool,
                $this->TypeTool,
                $this->Quantity,
                $this->IdTool
            ]);

            // update DataIn in Tools_Given Table
            $stmt = $this->Conn->prepare("UPDATE  tools_given SET DateIN = ? WHERE ID_Tool_Given = ?");
            $stmt->execute([$this->DateIn, $this->IdTool]);

            //UPDATE Name Of Donner
            $stmt = $this->Conn->prepare("UPDATE persons SET Name = ? WHERE ID = ?");
            $stmt->execute([$this->NameOfDonner, $this->IdDonner]);

            // Commit
            $this->Conn->commit();

            // print updated
            echo json_encode(["Message" => "UPDATED"]);
        }
        catch (PDOException $e) {

            // check if one of Transaction Not Exec Will Rollback
            $this->Conn->rollback();
            echo $e->getMessage();

        }

    }
    public function delete()
    {
        // TODO: Implement delete() method.
    }

}