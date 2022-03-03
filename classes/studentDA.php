<?php 
require_once('student.php');
/**
 * Programmer: ME Themba
 * This class will StudentDA  will be capable of adding,editing,finding 
 * and deleting students 
 */
class StudentDA{
    
    /**
     * add new student and write student object in a json file
     */
    public function addStudent($student){
      // the two start digits on the subfolder
      $sub_folder = substr($student->getStudentId(),0,2);
      // file extension
      $extension = "json";

      $student_array = array(
        'student_id' => $student->getStudentId(),
        'name'       => $student->getName(),
        'surname'    => $student->getSurname(),
        'age'        => $student->getAge(),
        'curriculum' => $student->getCurriculum());
     // echo json_encode($student_array);
     
     // check if file exist
      if(!file_exists("students"."/".$sub_folder."/".$student->getStudentId().".".$extension)){
          mkdir("students"."/".$sub_folder."/");
      }else{
         echo "The student already exists";
         exit;
      }
      $handle = fopen("students"."/".$sub_folder."/".$student->getStudentId().".".$extension, "a");
      fwrite($handle,json_encode($student_array));
      fclose($handle);
      echo "Student was successfully added \n";
    }
    /**
     * Edit an existing student if the student id is valid else if student id
     * is invalid an error message will appear
     * @param student_id
     * @return student
     */
    public function editStudentDetails($student_id){
      // file extension
       $extension = "json";
       // the two start digits on the subfolder
       $sub_folder = substr($student_id,0,2);
       // if file does not exist means that student id does not exist
       if(!file_exists("students"."/".$sub_folder."/".$student_id.".".$extension)){
         print("The student id you entered is invalid");
         exit;
       }else{
         $handle = fopen("students"."/".$sub_folder."/".$student_id.".".$extension,"r+");
         $count = 1;
         while ( $line = fgets( $handle ) ) {
          $student_object = $line;
          $count++;
         }
         $student_array = json_decode($student_object,true);
         $stud_id = $student_array['student_id'];
         $name = $student_array['name'];
         $surname = $student_array['surname'];
         $age = $student_array['age'];
         $curriculum = $student_array['curriculum'];
         fclose( $handle );

         $student = new Student($stud_id,$name,$surname,$age,$curriculum);
         return $student;
       }
       
    }
    /**
     * This update student  doing the actual update
     * @param student
     */
    public function updateStudent($student){
         // file extension
       $extension = "json";
       // the two start digits on the subfolder
       $sub_folder = substr($student->getStudentId(),0,2);
        $student_array = array(
          'student_id' => $student->getStudentId(),
          'name'       => $student->getName(),
          'surname'    => $student->getSurname(),
          'age'        => $student->getAge(),
          'curriculum' => $student->getCurriculum());
      
        $handle = fopen("students"."/".$sub_folder."/".$student->getStudentId().".".$extension, "w");
        fwrite($handle,json_encode($student_array));
        fclose($handle);
        echo "student details successfully updated \n";
    }
    /**
     * This search for student by name otherwise if name is blank or
     * does not match it returns all the students
     * @param name
     */
    public function searchStudent($name){
       // student array that will be return if names are not matches
       $student = array();
       // directory paths
       $directory_path = "students/*/*.json";
       // store the directories as an array
       $directory_list = glob($directory_path);
       $counter = 0;
       $file_array = array();
       //loop the directory list and add elements to file array
       foreach($directory_list as $directory){
            $file_array[$counter] = $directory_list;
             $counter = $counter + 1;
       }
       foreach($file_array as $key => $file){
         // readings files one by one
         $handle = fopen($file[$key],"r+");
         $count = 1;
         while ( $line = fgets( $handle ) ) {
          $student_object = $line;
          $count++;
         }
         // decode the student object
          $student_array = json_decode($student_object,true);
          $stud_id = $student_array['student_id'];
          $_name = $student_array['name'];
          $surname = $student_array['surname'];
          $age = $student_array['age'];
          $curriculum = $student_array['curriculum'];
          fclose( $handle );
          // found variable will check where if student with same name is found
          $found = false;
          // create an instance of student
          $student[$key] = new Student($stud_id,$_name,$surname,$age,$curriculum);
          // new name will be compared with be given name
          $new_name = $student[$key]->getName();
          // if names are the same it will mean that the student is found
          if(strtolower($name) == strtolower($new_name)){
            $found = true;
            return $student[$key];
            exit;
          }
       }
       // returns all the students if name does match
       return $student;
    }
    /**
     * Delete the student that matches with the student id number
     * @param student_id
     */
    public function deleteStudent($student_id){
      // file extension
      $extension = "json";
      // the two start digits on the subfolder
      $sub_folder = substr($student_id,0,2);
      // if file does not exist means that the  student  does not exist
      if(!file_exists("students"."/".$sub_folder."/".$student_id.".".$extension)){
        print("The student id you entered is invalid");
        exit;
      }else{
         $folder = glob("students/".$sub_folder."/".$student_id."."."json");
       // $folder = glob("students/".$sub_folder."/*.json");
        $dir = $sub_folder;
        $paths = glob('students/'.$sub_folder);
        unlink($folder[0]);
        rmdir($paths[0]);
        echo "Student deleted successfully";
      }
    }
}