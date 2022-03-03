<?php
/**
 *  Programmer: ME Themba
 *  The purpose of this class (Student) is to manage students information
 *  and do all the validations and error handling
 */
 class Student{
     // instance variables
    private $student_id;
    private $name;
    private $surname;
    private $age;
    private $curriculum;
    // overloaded constructor
    public function __construct($student_id,$name,$surname,$age,$curriculum){
         $this->setStudentId($student_id);
         $this->setName($name);
         $this->setSurname($surname);
         $this->setAge($age);
         $this->setCurriculum($curriculum);
    }
    /**
     *  function set student id set the student id if the user enter an
     *  invalid data the application an error message will appear
     *  @param $student_id
     */
    public function setStudentId($student_id){
        if(strlen($student_id) == 7 && $student_id > 0 && $student_id != "" ){
            $this->student_id = $student_id;
        }else{
            print("| The student id  entered is invalid, it must be  7 numbers |");
            exit;
        }
    }
    /**
     *  function set name set the student name if the user enter an
     *  invalid data the application an error message will appear
     *  @param $name
     */
    public function setName($name){
        if(!empty($name)){
            $this->name = $name;
        }else{
            print("| The name must not be empty |");
            exit;
        }
    }
    /**
     *  function set student surname set the student surname if the user enter an
     *  invalid data the application an error message will appear
     *  @param $surname
     */
    public function setSurname($surname){
         if(!empty($surname)){
            $this->surname = $surname;
         }else{
            print("| The surname must not be empty |");
            exit;
        }
    }
    /**
     *  function set student age set the student age if the user enter an
     *  invalid data the application an error message will appear
     *  @param $age
     */
    public function setAge($age){
        if($age > 0 && $age != ""){
          $this->age = $age;
        }else{
          print("| The age is required and it must be numeric |");
          exit;
        }
    }
    /**
     *  function set curriculum set the student curriculum if the user enter an
     *  invalid data the application an error message will appear
     *  @param $curriculum
     */
    public function setCurriculum($curriculum){
        if(!empty($curriculum)){
          $this->curriculum = $curriculum;
        }else{
          print("| The curriculum must not be empty |");
          exit;
        }
    }
    // get the student id
    public function getStudentId(){
        return $this->student_id;
    }
    // get the student name
    public function getName(){
        return $this->name;
    }
    // get the student surname
    public function getSurname(){
        return $this->surname;
    }
    // get the student surname
    public function getAge(){
        return $this->age;
    }
    // get the student curriculum
    public function getCurriculum(){
        return $this->curriculum;
    }
}