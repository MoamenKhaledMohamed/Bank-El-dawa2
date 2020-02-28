<?php
include_once 'Model.php';

class Worker extends Model {
//    essintial variables for db connection

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

//establisshing connection
public function __construct($db){
  $this->conn=$db;
  parent::__construct($db);
}
//read single worker data
    public function read_single()
    {
//query sql
     $query='SELECT persons.Name as employ_name,ID,Phone,Job,Qualification,Age,Salary,Image_profile,
departement.ID_Dep as Department_id , departement.Name as name_of_department ,departement.ID_Employee as department_manager_id
 FROM persons LEFT JOIN employees ON persons.ID= employees.ID_Employee
LEFT JOIN departement ON employees.ID_Dep= departement.ID_Dep where ID = ? LIMIT 0,1';


//prepare stmt

     $stmt=$this->conn->prepare($query);

//binding param by ID and executing stmt

     $stmt->bindparam(1,$this->ID);
     $stmt->execute();

//fetch worker data

     $row=$stmt->fetch(PDO::FETCH_ASSOC);


//    store worker data
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

//update function

    public function update()
    {
//query stmt

        $query='UPDATE persons 
INNER JOIN employees ON employees.ID_Employee = persons.ID
INNER JOIN departement ON employees.ID_Employee = departement.ID_Employee
SET persons.Name =:NAME,
    persons.Age=:AGE,
    persons.Job=:JOB,
    persons.Qualification=:Qualification,
    employees.Salary=:Salary,
    employees.ID_Dep=:ID_Dep
WHERE persons.ID =:ID';
//prepare stmt

        $stmt=$this->conn->prepare($query);
// cleaning data
        $this->Name=htmlspecialchars(strip_tags($this->Name));
            $this->Age=htmlspecialchars(strip_tags($this->Age));
                $this->Job=htmlspecialchars(strip_tags($this->Job));
                    $this->ID_Dep=htmlspecialchars(strip_tags($this->ID_Dep));
                        $this->Qualification=htmlspecialchars(strip_tags($this->Qualification));
                            $this->Salary=htmlspecialchars(strip_tags($this->Salary));
                                $this->ID=htmlspecialchars(strip_tags($this->ID));

//binding param and executing stmt

        $stmt->bindparam(':NAME',$this->Name);
         $stmt->bindparam(':AGE',$this->Age);
          $stmt->bindparam(':JOB',$this->Job);
           $stmt->bindparam(':Qualification',$this->Qualification);
            $stmt->bindparam(':Salary',$this->Salary);
             $stmt->bindparam(':ID_Dep',$this->ID_Dep);
              $stmt->bindparam('ID',$this->ID);

              if($stmt->execute()){
                  return true;

              }
              else{


                  printf("ERROR: %s.\n",$stmt->error());
                  return false;
              }
    }

//    deleting worker method

    public function delete()
    {

//query stmt

        $query='DELETE p.*, em.*
FROM persons p
LEFT JOIN employees em ON p.ID = em.ID_Employee
WHERE p.ID =:D';

//   perpare stmt
        $stmt=$this->conn->prepare($query);

        $this->ID=htmlspecialchars(strip_tags($this->ID));

        $stmt->bindparam('ID',$this->ID);

        if($stmt->execute()){
            return true;

        }
        else{


            printf("ERROR: %s.\n",$stmt->error());
            return false;
        }


    }

    public function read()
    {
        // TODO: Implement read() method.
    }
}