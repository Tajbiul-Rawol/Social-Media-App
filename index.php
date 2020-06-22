<?php include_once "library_Functions/db.php"; ?>
<?php include_once "library_Functions/Functionlib.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sin Up to get Started!!!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

 <?php 

      if (isset($_POST['login'])) {
          
           $ue =  $_POST['ue'];
           $pass = $_POST['pass'];

           if (empty($ue) || empty($pass)) {
               
               $mess = '<p class="alert alert-danger">All fields are required to login!!<button data-dismiss="alert" class="close"> &times; </button></p>';    

           }else{

               $sql = "SELECT * FROM users WHERE username = '$ue' OR email = '$ue' ";
               $data = $connection -> query($sql);
               $user_data = $data -> fetch_assoc();
               
               //print_r($data); //prints out the mysqli object
               //print_r($user_data); //prints out the fetched data from the object
               
               $count = $data -> num_rows;

               if ($count == 1) {
                     
                     $hash = $user_data['password'];
                      
                    //check if the password hash match with the password
                     if ( password_verify($pass, $hash) == true) {
                          
                          echo "condition e dhuktese"; 
                          
                          header('location:Profile.php');
                      }else{
                          
                          echo "condition e dhuktese na";

                          //print_r( $user_data['password']);

                          $mess = '<p class="alert alert-danger"> Password incorrect!<button data-dismiss="alert" class="close"> &times; </button></p>';  
                      } 

               }else{
                     
                     $mess = '<p class="alert alert-danger"> Username or email incorrect!!<button data-dismiss="alert" class="close"> &times; </button></p>';  
                      
               }



           }

      }






  ?>

   <div class="container">
   	   
   	   <div class="log w-50 mx-auto mt-5">

   	   	
           <a  class="btn btn-success btn-sm" href="Register.php">Create new Account</a>
   	   	  <div class="card shadow">
   	      	
   	      	<div class="card-header">
   	      		<h2>Sign In </h2>
   	      	</div>
   	      	<div class="card-body">
   	      		   
                 <?php 
                         if (isset($mess)) {
                             echo $mess;
                         }

                         
                   ?>


                 <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="POST"  enctype="multipart/form-data">
                 	 

                      <div class="form-group">
                      	<label for=""> Username</label>
                      	<input class="form-control" type="text" name="ue" placeholder="Username/Email">
                      	
                      </div>

                      <div class="form-group">
                      	<label for="">Password</label>
                      	<input class="form-control" type="password" name="pass">
                      	
                      </div>

             


                      <div class="form-group">
                      	
                      	<input class="btn btn-info" type="submit" name="login" value="Log in" >
                      	
                      </div>

                 </form>

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