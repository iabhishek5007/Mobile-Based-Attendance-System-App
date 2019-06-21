<?php session_start(); ?>
<?php include 'node_class.php'; ?>
<?php
  $teacher_id = $_SESSION['teacher_id'];
  $code = strtoupper($_POST['code']);
  $year = $_POST['year'];
  $semester = $_POST['semester'];
  $section = $_POST['section'];
  $startRoll = strtoupper($_POST['start']);
  $endRoll = strtoupper($_POST['end']);
  $classes = $_SESSION['classes'] == 0?array():$_SESSION['classes'];
  
  if(verify(CODE,$code) === false) respond("error","code");
  if(verify(ROLL,$startRoll) === false) respond("error","roll");
  if(verify(ROLL,$endRoll) === false) respond("error","roll");
  if(verify(NUMBER,$semester) === false) respond("error","semester");
  if(verify(NUMBER,$section) === false) respond("error","section");
  if(verify(NUMBER,$year) === false) respond("error","year");
  
  $n = new Node($code,$teacher_id,$year,$semester,$section,$startRoll,$endRoll) or respond("error","exists");
  updateSession($_SESSION['email']);
  $classes2 = $_SESSION['classes'];
  $class_id;
  foreach($classes2 as $c) {
    if(!in_array($c,$classes)) $class_id = $c;
  }
  if(!isset($class_id)) respond("error","exists");
  echo json_encode(array("code"=>$code,"section"=>$section,"year"=>$year,"class_id"=>$class_id));

?>