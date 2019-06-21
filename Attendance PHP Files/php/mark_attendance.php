<?php session_start(); ?>
<?php include 'node_class.php'; ?>
<?php
  $content = $_POST['content'];
  $class_id = $_POST['class_id'];
  $teacher_id = $_POST['teacher_id'];
  
  
  if(!in_array($class_id,$_SESSION['classes'])) respond("error","not_found");
  
  // Create node
  $classNode = new Node;
  // Retrieve object
  $node = $classNode->retrieveObjecti($class_id,$teacher_id) or die("No such record");
  // Set presence
  foreach($content as $c) {
    $node->setPresence($c['roll'],$c['newpresent'],$c['timestamp']);
  }
  $node->setDays($node->getDays()+1);
  // Save object
  $node->saveNode();
  respond("error","none");
?>