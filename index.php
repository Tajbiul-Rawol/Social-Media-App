
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

   	   	
           <a  class="btn btn-success btn-sm" href="Register.php">Create new Account</a>
   	   	  <div class="card shadow">
   	      	
   	      	<div class="card-header">
   	      		<h2>Sign In </h2>
   	      	</div>
   	      	<div class="card-body">
   	      		
                 <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="POST"  enctype="multipart/form-data">
                 	 
                    

                      <div class="form-group">
                      	<label for=""> Username</label>
                      	<input class="form-control" type="text" name="uname" placeholder="Username/Email">
                      	
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