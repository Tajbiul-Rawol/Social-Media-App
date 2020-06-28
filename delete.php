<?php  include_once "Library_Functions/db.php"; ?>


<?php 

     
     if (isset($_GET['id'])) {
     	$id_url = $_GET['id'];
     }
    
     $sql = "DELETE FROM  users WHERE id='$id_url' ";
     $connection -> query($sql);

     header('location:allpeople.php');

 ?>