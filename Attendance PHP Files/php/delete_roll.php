<?php
  session_start();
  include 'node_class.php';
  $teacher_id = $_SESSION['teacher_id'];
  $class_id = $_POST['class_id'];
  $roll = $_POST['roll'];
  
  if(!in_array($class_id,$_SESSION['classes'])) respond("error","not_found");
  
  $classNode = new Node;
  $node = $classNode->retrieveObjecti($class_id,$teacher_id) or respond("error","not_found");
  
  if($node->deleteRoll($roll)) {
   $node->saveNode();
   respond("error","none");
  }
  respond("error","roll_not_found");
?>