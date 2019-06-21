<?php
  require_once('defines.php');

  class Node {
    /************* 
      PROPERTIES 
    **************/
    const rollNumberRegex = '/([0-9]+)(\/[a-zA-Z]+\/[0-9]{2})/';
    private $teacher;      // teacher_id
    private $subjectCode; 
    private $section;    
    private $year;       
    private $semester;    
    private $numberOfDays; 
    private $records = array(); // array of key value paired array for each student
   
    /********** 
      METHODS 
    ***********/
    
    # CONSTRUCTORS
     
    function __construct() {  
      // constructor to allow multiple constructors with different number of arguments
      $a = func_get_args();
      $i = func_num_args();
      if (method_exists($this,$f='__construct'.$i)) {
        call_user_func_array(array($this,$f),$a); 
      }
    }
    function __construct7($code,$teacher_uid,$year,$semester,$section,$start,$end) {
      $this->setCode($code);
      $this->setTeacher($teacher_uid);
      $this->setYear($year);
      $this->setSemester($semester);
      $this->setSection($section);
      $this->setDays(0);
      $this->initRecords($start,$end);
      if($this->saveNode() === false) {
        echo false;
      }
    }
    # HELPER FUNCTIONS
    
    public function retrieveObject($code,$section,$year) {
    /*
      Takes -> SubjectCode , Section , Year
      Returns -> A new Object of Node class based on code , section and year of a class
      Errors -> false for any kind of error
    */
      $con = connectTo();
      
      $code = sqlReady($code);
      $section = sqlReady($section);
      $year = sqlReady($year);
      
      if($con->connect_errno) {
      	return false;
      } else {
        $obj = $con->query('select object from objects where code = "'.$code.'" and section = "'.$section.'" and year = "'.$year.'"');
        if($con->errno) {
          return false;
        } else {
            if($obj->num_rows == 1) {
              $obj = $obj->fetch_assoc()['object'];
              return unserialize($obj);							
            } else { 
              return false;
            }
        }
      }
    }
    public function retrieveObjecti($class_id,$teacher_uid) {
    /*
      Takes -> Class Unique ID from objects table , Teacher Unique ID from teacher table
      Returns -> A new Object of Node class based on code , section and year of a class
      Errors -> false for any kind of error
    */
      $con = connectTo();
      
      $class_id = sqlReady($class_id);
      $teacher_uid = sqlReady($teacher_uid);
      
      if($con->connect_errno) {
      	return false;
      } else {
        $obj = $con->query('select object from objects where uid = "'.$class_id.'" and teacher_uid = "'.$teacher_uid.'"');
        if($con->errno) {
          return false;
        } else {
            if($obj->num_rows == 1) {
              $obj = $obj->fetch_array()['object'];
              return unserialize($obj);							
            } else { 
              return false;
            }
        }
      }
    }
    public function initRecords($start,$end) { 
    /*
      Takes -> Starting and ending roll number
      Does -> Initializes the records. It will update the records property based on starting and ending roll number
      Errors -> false for any kind of error
    */
      if(verify(ROLL,$start) === false) return false;
      if(verify(ROLL,$end) === false) return false;
      
      $s = preg_replace(self::rollNumberRegex,"$1",$start);
      $e = preg_replace(self::rollNumberRegex,"$1",$end);
      $type = preg_replace(self::rollNumberRegex,"$2",$start);
      
      # UPDATING THE RECORDS ARRAY
      foreach(range($s,$e) as $d) {
        $this->records[$d.$type] = array('present'=>0,'timeline'=>array()); 
      }
    }
    public function deleteNode() {
    /*
      Does -> Deletes the node from data base
      Returns -> true if deleted , false in case of any error
    */
      $con = connectTo();
      if($con->connect_errno) {
      	return false;
      } else {
        $teacher_uid = $this->getTeacherID();
        $code = $this->getCode();
        $section = $this->getSection();
        $year = $this->getYear();
        $obj = $con->query('delete from objects where teacher_uid = "'.$teacher_uid.'" and code = "'.$code.'" and section = "'.$section.'" and year = "'.$year.'"');
        if($obj && $con->affected_rows) {
          return true;
        } else {
          return false;
        }
      }
    }
    public function saveNode() {
    /*
      Does -> Saves the node into data base , it also inserts if the object isn't present in database.
      Warning -> Don't use it if you have edited section , code or year
      Returns -> true if saved , false in case of any error
    */
      $con = connectTo();
      if($con->connect_errno) {
      	return false;
      } else {
      $teacher_uid = $this->getTeacherID();
      $code = $this->getCode();
      $section = $this->getSection();
      $year = $this->getYear();
      $obj = $con->query('select object from objects where teacher_uid = "'.$teacher_uid.'" and code = "'.$code.'" and section = "'.$section.'" and year = "'.$year.'"');
      if($obj->num_rows)
        $obj = $con->query('update objects set object = "'.$con->real_escape_string(serialize($this)).'" where teacher_uid = "'.$teacher_uid.'" and code = "'.$code.'" and section = "'.$section.'" and year = "'.$year.'"');
      else 
        $obj = $con->query($q= 'insert into `objects`(`teacher_uid`, `code`, `year`, `section`, `object`) VALUES ("'.$teacher_uid.'","'.$code.'","'.$year.'","'.$section.'","'.$con->real_escape_string(serialize($this)).'")');
        if($con->errno) {
          return false;
        } else {
          return true;							
        }
      }
      return false;
    }
    public function saveNodei($class_id) {
    /*
      Does -> Saves the node into data base on basis of class_id , this is used in case of editing the unique parameters like section , year and code
      Returns -> true if saved , false in case of any error
    */
      $con = connectTo();
      if($con->connect_errno) {
      	return false;
      } else {
        $teacher_uid = $this->getTeacherID();
        $code = $this->getCode();
        $section = $this->getSection();
        $year = $this->getYear();
        $selectedNode = $con->query('select object from objects where uid = '.$class_id.' and  teacher_uid = '.$teacher_uid);
        if($selectedNode && $con->affected_rows) {
          $obj = $con->query('update objects set code = "'.$code.'", year = "'.$year.'", section = "'.$section.'", object = "'.$con->real_escape_string(serialize($this)).'" where teacher_uid = "'.$teacher_uid.'" and uid = "'.$class_id.'"');
          if($obj && $con->affected_rows) {
            return true;
          }        
          return false;
        }
        return false;
      }
    }
    public function isPresent($rollNumber,$newPresents) {
    /*
     Takes -> Roll number and new number of present days
     Does -> Tells if that student was present or not
     Returns -> 1 if present , 0 if absent , false if not found
    */
      if(isset($this->records[$rollNumber]))
        return ( $this->records[$rollNumber]['present'] < $newPresents )? 1 : 0;
      return false;
    }
    public function deleteRoll($rollNumber) {
    /*
     Takes -> Roll number 
     Does -> Deletes a roll number
     Returns -> true if deleted , false if not found
    */
      if(isset($this->records[$rollNumber])) {
        unset($this->records[$rollNumber]);
        return true;
      }
      return false;
    }
    
    /**********
      GETTERS
    **********/
    
    public function getTeacherID() {
    /*
     Returns -> Teacher unique ID
    */
      return $this->teacher;
    }
    public function getTeacherName() {
    /*
     Returns -> Teacher name by searching in data base
    */
      $con = connectTo();
      $s = $con->query("select name from teacher where uid = ".$this->getTeacherID());
      $name = $s->fetch_assoc();
      $name = $name['name'];
      return $name;
    }
    public function getCode() {
    /*
     Returns -> Class code
    */
      return $this->subjectCode;
    }
    public function getYear() {
    /*
     Returns -> Year of class
    */
      return $this->year;
    }
    public function getSemester() {
    /*
     Returns -> Semester of class
    */
      return $this->semester;
    }
    public function getSection() {
    /*
     Returns -> Section of class
    */
      return $this->section;
    }
    public function getDays() {
    /*
     Returns -> Days conducted by teacher for the class
    */
      return $this->numberOfDays;
    }
    public function getPercent($rollNumber) {
    /*
     Takes -> Roll number
     Returns -> Computers the percentage and returns it
     Errors -> False if not found
    */
      return isset($this->records[$rollNumber])?(100*($this->records[$rollNumber]['present']/$this->getDays())):false;
    }
    public function getTimeline($rollNumber) {
    /*
     Takes -> Roll number
     Returns -> Returns the timeline for that roll number
     Errors -> False if not found
    */
      return isset($this->records[$rollNumber])?$this->records[$rollNumber]['timeline']:false;
    }
    public function getRecords() {
    /*
     Returns -> Returns the records for entire object
    */
      return $this->records;
    }
    /**************
        SETTERS 
    **************/
    public function setTeacher($val) {
    /*
     Takes -> Value
    */
      $this->teacher = $val;
    }
    public function setCode($val) {
    /*
     Takes -> Value
    */
      $this->subjectCode = $val;
    }
    public function setYear($val) {
    /*
     Takes -> Value
    */
      $this->year = $val;
    }
    public function setSemester($val) {
    /*
     Takes -> Value
    */
      $this->semester = $val;
    }
    public function setSection($val) {
    /*
     Takes -> Value
    */
      $this->section = $val;
    }
    public function setDays($val) {
    /*
     Takes -> Value
    */
      $this->numberOfDays = $val;
    }
    public function setPresence($rollNumber,$newPresents,$timestamp) {
    /*
     Takes -> Roll Number, New Presents , Timestamp
     Returns -> False if error
    */
      if(isset($this->records[$rollNumber])) {
        $this->records[$rollNumber]['timeline'][$timestamp] =  $this->isPresent($rollNumber,$newPresents);
        $this->records[$rollNumber]['present'] = $newPresents;
      } else
        return false;
    }
  }
?>