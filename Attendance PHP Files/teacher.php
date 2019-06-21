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
  <title>Teacher Dashboard</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/teacher.js"></script>
  <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">
 </head>
 
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
          <a class="navbar-brand" href="index.php">Online Attendance</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="teacher.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
           
			<li><a href="statistics.php">Statistics</a></li>
			<li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
			<li><a href="logout.php">Logout</a></li>
          
          </ul>
        </div><!--/.nav-collapse -->
     <!-- </div> 
    </nav></br></br></br></br> -->

    <body style="background-color:#B993D6;">
 
  <div class="container">
    <?php
      $name = $_SESSION['name'];
      $classes = $_SESSION['classes'];
      $teacher_id = $_SESSION['teacher_id'];
      echo '<h2>Welcome , '.$name.'.</h2>';
      echo '<div class="wrapper">';
      // FOR EACH CLASS , GET IT'S INFO AND PREPARE A LINK
      $n = new Node;
       
      if(!$classes) {
        echo '<h3 class="no-classes">You haven\'t taken any class yet!</h3>';
      } else { 
        echo '<h3 class="no-classes">Click on a class to take attendance.</h3>';
        foreach($classes as $class_id) {
          $node = $n->retrieveObjecti($class_id,$teacher_id) or die("No such record");
          $code = $node->getCode();
          $section = $node->getSection();
          $year = $node->getYear();
          $numClasses = $node->getDays();
          $link = 'take.php?cN='.$class_id;
          echo '<div class="class"> 
            <button class="btn btn-danger delete-class-warning" data-toggle="modal" data-target=".delete-warning">&times;</button>
            <a class="no-decoration" href="'.$link.'">
            <div><strong>Code</strong> : <span class="code">'.$code.'</span></div> 
            <div><strong>Section</strong> : <span class="section">'.$section.'</span></div> 
            <div><strong>Year</strong> : <span class="year">'.$year.'</span></div> 
            <div><strong>Classes</strong> : '.$numClasses.'</div> 
          </div></a>';
        }
      }
      echo '<div class="class" data-toggle="modal" data-target=".bs-example-modal-lg" id="addClass">
          <span class="glyphicon glyphicon-plus"></span>
        </div>
      </div>';   
    ?>
    
  </div>
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="addClass" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <h2 class="text-center"> Add Class </h2>
          <hr>
            <div id="add_class_form">
              <select class="form-control" name="year">
              <?php foreach(range(date('Y',time()),1983) as $r) echo '<option>'.$r.'</option>'; ?>
              </select>
              <input class="form-control" name="code" placeholder="Code , Eg : ITE-101">
			  
              <select class="form-control" name="section">
              <option value="-1">Choose Section</option>
              <?php foreach(range(1,3) as $r) echo '<option>'.$r.'</option>'; ?>
              </select>
              <select class="form-control" name="semester">
              <option value="-1">Choose Semester</option>
              <?php foreach(range(1,8) as $r) echo '<option>'.$r.'</option>'; ?>
              </select>
              <input class="form-control" name="start" placeholder="Starting Roll Number (Eg. 100/CO/19)">
              <input class="form-control" name="end" placeholder="Ending Roll Number (Eg. 150/CO/19)">
              <button class="btn btn-primary" id="add">Add Class</button>
              <button class="btn" id="cancel">Cancel</button>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade delete-warning" tabindex="-1" role="dialog" aria-labelledby="delete-warning" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <h2 class="text-center"> Do you really want to delete <br> <span class="warning-class"></span> ?</h2>
        <hr>
        <div class="text-center">
          <p>
            Are you sure you want to delete <span class="warning-class"></span> ? <br>
            You can't undo this action.
          </p>
          <button class="btn btn-danger delete-class-code">Delete</button> <button class="btn btn-primary" onclick="$('.delete-warning').modal('hide');">Cancel</button>
        </div>
      </div>
    </div>
  </div>
 </body>
</html>
