<?php
  session_start();
  $isIndex = 0;
  if(!(array_key_exists('teacher_id',$_SESSION) && isset($_SESSION['teacher_id']))) {
    session_destroy();
    if(!$isIndex) header('Location: index.php');
  }
?>
<?php include 'php/node_class.php'; ?>
<html>
 <head>
  <link rel="stylesheet" href="css/style.css"/>
  <title>Profile</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/profile.js"></script>
  <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">
 </head>
 <body style="background-color:#B993D6;">
   <!-- Fixed navbar -->
   <!-- <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Attendance Tracker System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="teacher.php">Dashboard</a></li>
			<li  class="active"><a href="profile.php">Profile</a></li>
            
			<li><a href="statistics.php">Statistics</a></li>
			<li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
			<li><a href="logout.php">Logout</a></li>
          
          </ul>
        </div><!--/.nav-collapse -->
     <!-- </div>
    </nav></br></br>--></br></br> 
  
  <div class="container">
    <?php
      $name = $_SESSION['name'];
      $phone = $_SESSION['phone'];
      $email = $_SESSION['email'];
      $classes = $_SESSION['classes'];
      $teacher_id = $_SESSION['teacher_id'];
      echo '<h2>Welcome , '.$name.'. Edit your profile here.</h2><br>';
    ?>
    <div class="wrapper">
      <dl class="dl-horizontal">
        <dt>Name : </dt>
        <dd>
          <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
          <input class="form-control" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
          </div>
        </dd>
        <dt>Phone : </dt>
        <dd>
          <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
          <input class="form-control" name="phone" placeholder="Enter your phone" value="<?php echo $phone; ?>">
          </div>
        </dd>
        <dt>Email : </dt>
        <dd>
          <div class="input-group">
          <span class="input-group-addon">@</span>
          <input class="form-control" name="email" placeholder="Enter your email"  value="<?php echo $email; ?>">
          </div>
        </dd>
        <dt>Classes : </dt>
        <dd><?php echo $classes == 0? 0 : count($classes); ?></dd>
     </dl>
     <button class="btn btn-success update-profile">Save</button>
    </div>
  </div>
 </body>
</html>
