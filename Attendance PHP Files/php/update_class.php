<?php session_start(); ?>
<?php include 'node_class.php'; ?>
<?php
  $class_id = $_POST['class_id'];
  $teacher_id = $_SESSION['teacher_id'];
  
  $section = $_POST['section'];
  $semester = $_POST['semester'];
  $year = $_POST['year'];
  $code = strtoupper($_POST['code']);
  
  if(!in_array($class_id,$_SESSION['classes'])) respond("error","not_found");
  
  $n = new Node;
  $n = $n->retrieveObjecti($class_id,$teacher_id) or respond("error","not_found");
 
  if($section == $n->getSection() && $year == $n->getYear() && $semester == $n->getSemester() && $code == $n->getCode())
    respond("error","none");
        
  if(verify(CODE,$code) === false) respond("error","code");
  if(verify(NUMBER,$year) === false) respond("error","year");
  if(verify(NUMBER,$semester) === false) respond("error","semester");
  if(verify(NUMBER,$section) === false) respond("error","section");

  if($section != $n->getSection()) $n->setSection($section);
  if($year != $n->getYear()) $n->setYear($year);
  if($code != $n->getCode()) $n->setCode($code);
  if($semester != $n->getSemester()) $n->setSemester($semester);
    
  if($n->saveNodei($class_id)) { respond("error","none"); }
  respond("error","failure");
?>