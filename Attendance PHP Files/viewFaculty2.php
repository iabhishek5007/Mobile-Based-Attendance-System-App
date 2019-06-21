
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
 <title>Table with database</title>
 <style>
  table {
   border-collapse: collapse;
   table-layout: fixed;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 11px;
   text-align: left;
     } 
  th {
   background-color: #588c7e;
   color: white;
    }
    td { 
    overflow: hidden; 
    text-overflow: ellipsis; 
    word-wrap: break-word;
}
@media only screen and (max-width: 480px) {
    /* horizontal scrollbar for tables if mobile screen */
    .tablemobile {
        overflow-x: auto;
        display: block;
    }
}
  tr:nth-child(even) {background-color: #f2f2f2}
 </style>
</head>
<body>
 <table>
 <tr>
  <th>Id</th> 
  <th>Name</th> 
  <th>Email</th>
  <th>Phone No</th>
 </tr>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT `uid`, `name`, `email`, `phone` FROM `teacher`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["uid"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>" . $row["phone"]. "</td></tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

</table>
</body>
</html>