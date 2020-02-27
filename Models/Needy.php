<?php
    include_once 'Model.php';
    class Needy extends Model {
        public $IdNeedy;
        public $Subvention_Type;
        public $Image_Profile;
        public $Name;
        public $Phone;
        public $Job;
        public $Age;
        public $Qualification;
        public function __construct ($db){
            parent::__construct($db);
        }

        public function read()
        {
            $sql = "SELECT * FROM needy LEFT JOIN persons ON needy.ID_Needy = persons.ID 
                    LEFT JOIN tools_taken ON needy.ID_Needy = tools_taken.ID_Needy
                    LEFT JOIN tools ON tools_taken.ID_Tool_Taken = tools.ID_Tool
                    WHERE needy.ID_Needy = ?";

            // execute the query
            $stmt = $this->Conn->prepare($sql);
            $stmt->execute([$this->IdNeedy]);
            return $stmt;
        }

        public function update()
        {
            try {
                // Start Transaction
                $this->Conn->beginTransaction();

                //Update Tools Table
                $stmt = $this->Conn->prepare("UPDATE needy SET Subvention_Type = ? WHERE ID_Needy = ?");
                $stmt->execute([
                    $this->Subvention_Type,
                    $this->IdNeedy
                ]);
                // NOTE HHHHHHHHHHHHHHHHHHHHHHANDLE ImageProfile
                // update DataIn in Tools_Given Table
                $stmt = $this->Conn->prepare("UPDATE  persons SET Name = ?,  
                Phone = ?,
                Job = ?,
                Qualification = ?,
                Age = ?
                WHERE ID = ?");
                $stmt->execute([
                    $this->Name,
                    $this->Phone,
                    $this->Job,
                    $this->Qualification,
                    $this->Age,
                    $this->IdNeedy
                ]);

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