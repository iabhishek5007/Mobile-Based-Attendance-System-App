<?php session_start(); ?>
<?php include 'defines.php'; ?>
<?php
/*********** VALIDATE ALL VARIABLES ************/
foreach($_POST as $p) 
  if(empty($p) || !isset($p))
    respond("error","empty");

$pass = $_POST['password'];
$email = strtolower(sqlReady($_POST['email']));

if(verify(EMAIL,$email) === false) respond("error","email");

/*********** SEARCH **********/
$con = connectTo();
$exists = $con->query("select * from `attendance`.`teacher` where email = '$email'");
if(!($exists && $con->affected_rows)) {
  $con->close();
  respond("error","not_found");
} 
$exists = $exists->fetch_assoc();
if(verifyPass($pass,$exists['password'])) {
  // START SESSION
  $_SESSION['name'] = $exists['name'];
  $_SESSION['email'] = $exists['email'];
  $_SESSION['phone'] = $exists['phone'];
  $_SESSION['teacher_id'] = $exists['uid'];
  $_SESSION['classes'] = 0;
  $classes = $con->query('select uid from `objects` where teacher_uid = '.$_SESSION['teacher_id']);
  if($classes && $con->affected_rows) {
    $cls = array();
    while($a = $classes->fetch_array()) {
      $cls[] = $a[0];
    } 
    $_SESSION['classes'] = $cls;
  }
  $con->close();
  session_write_close();
  die(json_encode(array("error"=>"none","session"=>$_SESSION)));
} else {
  $con->close();
  respond("error","incorrect");
}
?>