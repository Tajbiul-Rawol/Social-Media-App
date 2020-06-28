<?php include_once "library_Functions/db.php"; ?>
<?php include_once "library_Functions/Functionlib.php"; ?>
<?php session_start(); ?>

<?php 
    
    /**
    logout system
     * check if the logout key is set and it is set to success in the url 
        then destroy the session and send the user back to login page
     */
    if ( isset($_GET['logout']) AND $_GET['logout'] == 'success' ) {
    	
    	session_destroy();
    	/**
         * destroy cookie value s
         */

        setcookie('user_login_id', '', time() - (60*60*24*365*2) );

    	header('location:index.php');
    }


    /**
     * if session is not set Profile page cannot be accessed when user is not logged in
     */
    if (!isset($_SESSION['id']) AND !isset($_SESSION['first_name']) AND !isset($_SESSION['email']) ) {
    	
    	header('location:index.php');
    }



 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sin Up to get Started!!!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

 

   <div class="container">
   	   
   	   <div class="log w-50 mx-auto mt-5">

   	   	
           <a  class="btn btn-primary btn-sm" href="allpeople.php">View all</a>
   	   	  <div class="card shadow">
   	      	
   	      	<div class="card-header">
   	      		<h2>Profile of - <?php echo $_SESSION['first_name']." ". $_SESSION['last_name'];?></h2>
   	      	</div>
   	      	<div class="card-body">
   	      		<table class="table table-striped">
                <img style="width: 200px; height: 200px; display: block; border-radius: 50%; border: 10px solid #fff; margin: 30px auto;" class="shadow" src="photos/<?php echo $_SESSION['photo']; ?>">
              <tr>
                <td>Name</td>
                <td><?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?></td>
              </tr>

              <tr>
                <td>Email</td>
                <td><?php echo $_SESSION['email'];?></td>
              </tr>

              <tr>
                <td>Age</td>
                <td><?php echo $_SESSION['age'];?></td>
              </tr> 

              </table>
   	      	</div>
            
            <div class="card-footer">
                                               <!--set a logout key value to success-->            	
              <a class="btn btn-primary" href="?logout=success">Logout</a>
            </div>
 
          
   	      </div>

   	   </div>
   	     
   </div>


   



<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>   