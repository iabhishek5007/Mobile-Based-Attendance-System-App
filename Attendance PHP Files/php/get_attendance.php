<?php
  include 'node_class.php';
  $roll = isset($_POST['roll'])?$_POST['roll']:die();
  $section = isset($_POST['section'])?$_POST['section']:die();
  $code = isset($_POST['code'])?$_POST['code']:die();
  $year = isset($_POST['year'])?$_POST['year']:die();
  $con = connectTo();
  $o = new Node;
  if($o = $o->retrieveObject($code,$section,$year)) {
    if($o->getTimeline($roll)) {
      die(json_encode(array("timeline"=>$o->getTimeline($roll),"percent"=>$o->getPercent($roll),"teacher"=>$o->getTeacherName(),"count"=>$o->getDays())));
    }
    die(json_encode(array("error"=>"NOT_IN_RECORDS")));
  }
  die(json_encode(array("error"=>"NO_RECORD")));	
?>
