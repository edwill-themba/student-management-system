<?php
// includes the student class in the run file
require_once('classes/student.php');
// includes the student direct access class
require_once('classes/studentDA.php');

// Initialize instance of student da so the class can be accessed on all actions
$studentDA = new StudentDA();
// action name needed to be taken actions can be a add,edit,search or delete
$action_name = getopt(null,["action:"]);

// if statement of actions to be taken 
// use str to lower for case insensetivity
if(strtolower($action_name["action"]) == "add") {
  // get inputs from the user
  $student_id = readline("Enter id:");
  $name = readline("Enter name:");
  $surname = readline("Enter surname:");
  $age = readline("Enter age:");
  $curriculum = readline("Enter curriculum:");
  // Initialize instance of student
  $student = new Student($student_id,$name,$surname,$age,$curriculum);
  // add the student
  $studentDA->addStudent($student);
}else if(strtolower($action_name['action']) == "edit"){
   $student_number = getopt(null,["id:"]);
   // call the edit student details function 
   $studentTobeEdited = $studentDA->editStudentDetails($student_number["id"]);
   $student_array = array(
    'student_id' => $studentTobeEdited->getStudentId(),
    'name'       => $studentTobeEdited->getName(),
    'surname'    => $studentTobeEdited->getSurname(),
    'age'        => $studentTobeEdited->getAge(),
    'curriculum' => $studentTobeEdited->getCurriculum());
  
   if($studentTobeEdited){
    echo "Leave fields blank to kee previous value \n";
     $name = readline("Enter name"."[".$student_array['name']."]:");
     $surname = readline("Enter surname"."[".$student_array['surname']."]:");
     $age = readline("Enter age"."[".$student_array['age']."]:");
     $curriculum = readline("Enter curriculum"."[".$student_array['curriculum']."]:");

     if($name == ''){
       $name =  $studentTobeEdited->getName();
     }
     if($surname == ''){
       $surname =  $studentTobeEdited->getSurname();
     }
     if($age == ''){
      $age =  $studentTobeEdited->getAge();
     }
     if(!is_numeric($age)){
       print("The age must be numeric,please re-run the program again");
       exit;
     }
     if($curriculum == ''){
      $curriculum =  $studentTobeEdited->getCurriculum();
    }
     $updated_student = new Student($student_number["id"],$name,$surname,$age,$curriculum);
     $studentDA->updateStudent($updated_student);
   }
}else if(strtolower($action_name['action']) == "search"){
     $name = readline("Enter search criteria name:");
     $students = $studentDA->searchStudent($name);
    //  print_r($students);
       // display the search results in a table format
      echo "----------------------------------------\n";
      echo "| id | name| surname | age| carriculum |\n";
      echo "----------------------------------------\n";
      //check if students is an array
      if(!is_array($students)){
        $student_array = array(
          'student_id' => $students->getStudentId(),
          'name'       => $students->getName(),
          'surname'    => $students->getSurname(),
          'age'        => $students->getAge(),
          'curriculum' => $students->getCurriculum());
         
           echo "|". $student_array["student_id"] ."|".  $student_array["name"] ."|". 
           $student_array["surname"] ."|". $student_array["age"]. "|". $student_array["curriculum"] ."|\n";
           echo "----------------------------------------\n";
           exit;
      }
      // loop for the students to display
     foreach($students as $student){
      $student_array = array(
        'student_id' => $student->getStudentId(),
        'name'       => $student->getName(),
        'surname'    => $student->getSurname(),
        'age'        => $student->getAge(),
        'curriculum' => $student->getCurriculum());
       
         echo "|". $student_array["student_id"] ."|".  $student_array["name"] ."|". 
         $student_array["surname"] ."|". $student_array["age"]. "|". $student_array["curriculum"] ."|\n";
         echo "----------------------------------------\n";
      }      
}else if(strtolower($action_name['action']) == "delete"){
      $student_number = getopt(null,["id:"]);
      // call student delete method
      $studentDA->deleteStudent($student_number["id"]);
}else{
   echo "Invalid action options are add,edit,delete and search \n";
   echo "Please re-enter a valid option \n";
   exit;
}





