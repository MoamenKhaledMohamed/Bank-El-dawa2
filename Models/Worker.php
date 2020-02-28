<?php
include_once 'Model.php';

class Worker extends Model {
private $conn;
public $ID;
public $Name;
public $Phone;
public $Job;
public $Qualification;
public $Age;
public $Salary;
public $ID_Dep;
public $Image_profile;
public $Name_dep;
public $manager_id;

public function __construct($db){
  $this->conn=$db;
  parent::__construct($db);
}

    public function read_single()
    {
     $query='SELECT persons.Name as employ_name,ID,Phone,Job,Qualification,Age,Salary,Image_profile,
departement.ID_Dep as Department_id , departement.Name as name_of_department ,departement.ID_Employee as department_manager_id
 FROM persons LEFT JOIN employees ON persons.ID= employees.ID_Employee
LEFT JOIN departement ON employees.ID_Dep= departement.ID_Dep where ID = ? LIMIT 0,1';



     $stmt=$this->conn->prepare($query);
     $stmt->bindparam(1,$this->ID);
     $stmt->execute();

     $row=$stmt->fetch(PDO::FETCH_ASSOC);
     $this->ID=$row['ID'];
     $this->Name=$row['employ_name'];
     $this->Phone= $row['Phone'];
     $this->Job=$row['Job'];
     $this->Qualification=$row['Qualification'];
     $this->Age=$row['Age'];
     $this->Salary=$row['Salary'];
     $this->ID_Dep=$row['Department_id'];
     $this->Image_profile=$row['Image_profile'];
     $this->Name_dep=$row['name_of_department'];
     $this->manager_id=$row['department_manager_id'];

    }
    public function read()
    {

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