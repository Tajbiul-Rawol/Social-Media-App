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

      if (isset($_POST['sigin'])) {
          
          //value get
            $ue =  $_POST['ue'];
            $pass = $_POST['pass'];

            if (empty($ue) || empty($pass)) {
              
                 $mess = '<p class="alert alert-danger"> All fields required! <button data-dismiss="alert" class="close"> &times; </button></p>';
            }else{

                 $sql = "SELECT * FROM users WHERE username='$ue' OR email='$ue' ";
                 $data = $connection -> query($sql);
                 $login_user_data = $data -> fetch_assoc();
                 $count = $data -> num_rows;


                  //print_r($login_user_data );
                   
                 if ($count == 1 ) {
                      
                     
                     $pass_verify = password_verify($pass , $login_user_data['password'] ); 
                      
                     if ($pass_verify == true) {
                       
                         header('location:Profile.php');
                     }else{

                         $mess = '<p class="alert alert-danger"> Wrong password! <button data-dismiss="alert" class="close"> &times; </button></p>';
                     }

                 }else{

                     $mess = '<p class="alert alert-danger"> Wrong username or email! <button data-dismiss="alert" class="close"> &times; </button></p>';
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


                 <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="POST" >
                 	 

                      <div class="form-group">
                      	<label for=""> Username</label>
                      	<input class="form-control" type="text" name="ue" placeholder="Username/Email">
                      	
                      </div>

                      <div class="form-group">
                      	<label for="">Password</label>
                      	<input class="form-control" type="password" name="pass">
                      	
                      </div>



                      <div class="form-group">
                      	
                      	<input class="btn btn-info" type="submit" name="sigin" value="Sign in" >
                      	
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