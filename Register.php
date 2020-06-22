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

            if (isset($_POST['register'])) {
              
                  $fname = $_POST['fname'];
                  $lname = $_POST['lname'];
                  $email = $_POST['email'];
                  $uname = $_POST['uname'];
                  $age = $_POST['age'];
                  $gender = $_POST['gender'];
                  
                  //password confirm
                  $pass = $_POST['pass'];
                  $cpass = $_POST['cpass'];

                  if ($pass == $cpass) {

                      $confirm_pass = true;
                  }else{
                        
                      $confirm_pass = false;
                  }

                  //hash password
                  $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

                   //check username
                  $check_user = dataCheck($connection, 'username', $uname, 'users');  
                   
                   //check email
                  $check_email = dataCheck($connection, 'email', $email, 'users');

                   
                   // photo file
                  $photo = $_FILES['photo'];
            }

            
            $msg = '';

            if (empty($fname)|| empty($lname) || empty($email) || empty($uname) || empty($pass) || empty($cpass) || empty($age) || empty($gender) || empty($photo)) {
              
                 $mess = '<p class="alert alert-danger"> All fields required! <button data-dismiss="alert" class="close"> &times; </button></p>';


            }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                 
                 $mess = '<p class="alert alert-danger"> Invalid Email! <button data-dismiss="alert" class="close"> &times; </button></p>'; 
            }elseif ($confirm_pass == false) {
                 
                 $mess = '<p class="alert alert-danger"> password doesnt match! <button data-dismiss="alert" class="close"> &times; </button></p>'; 

            }elseif ($check_user == false) {
                 
                 $mess = '<p class="alert alert-danger"> Username already taken! <button data-dismiss="alert" class="close"> &times; </button></p>'; 

            }elseif ($check_email == false) {
                 
                 $mess = '<p class="alert alert-danger"> Email already taken! <button data-dismiss="alert" class="close"> &times; </button></p>'; 

            }else{

                        $data = File_upload($_FILES['photo'], 'photos/',['jpg','jpeg'], [
                                  'type' => 'image'       
                                ]);
                        $file_name = $data['file_name'];
                        

                        if (!empty($data['mess'])) {
                              
                               $mess = $data['mess'];
                        }else{
                           
                           $sql = "INSERT INTO users (first_name, last_name, email,username,password,age,gender,photo) VALUES ('$fname','$lname','$email','$uname','$hash_pass','$age','$gender','$file_name') "; 
                        
                            $user_data = $connection -> query($sql);

                            setMsg("Registration Successful!");
                            
                            header("location:register.php");

                        }
                        
                        


            }

     ?>

   <div class="container">
   	   
   	   <div class="log w-50 mx-auto mt-5">

   	   
   	   	
           <a  class="btn btn-success btn-sm" href="index.php">Log in</a>
   	   	  <div class="card shadow">
   	      	
   	      	<div class="card-header">
   	      		<h2>Register Now</h2>
   	      	</div>
   	      	<div class="card-body">
   	      		    <?php 
                         if (isset($mess)) {
                             echo $mess;
                         }

                         getMsg();
                   ?>


                 <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="POST"  enctype="multipart/form-data">
                 	 
                      <div class="form-group">
                      	<label for=""> First Name</label>
                      	<input class="form-control" type="text" value="<?php old('fname'); ?>" name="fname">
                      	
                      </div>

                      <div class="form-group">
                      	<label for=""> Last Name</label>
                      	<input class="form-control" type="text" value="<?php old('lname'); ?>" name="lname">
                      	
                      </div>

                      <div class="form-group">
                      	<label for=""> Email</label>
                      	<input class="form-control" type="text" value="<?php old('email'); ?>" name="email">
                      	
                      </div>

                      <div class="form-group">
                      	<label for=""> Username</label>
                      	<input class="form-control" type="text" value="<?php old('uname'); ?>" name="uname">
                      	
                      </div>

                      <div class="form-group">
                      	<label for="">Password</label>
                      	<input class="form-control" type="password"  name="pass">
                      	
                      </div>

                      <div class="form-group">
                      	<label for="">Confirm password</label>
                      	<input class="form-control" type="password"  name="cpass">
                      	
                      </div>

                      <div class="form-group">
                        <label for="">Age</label>
                        <input class="form-control" type="text" value="<?php old('age'); ?>" name="age">
                        
                      </div>


                      <div class="form-group">
                        <label for="">Gender</label>
                        <br>
                        <input name="gender" class="" type="radio" value="Male" id="male"><label for="male">Male</label>
                        <input name="gender" class="" type="radio" value="Female" id="female"><label for="female">Female</label>
                      </div>

                      <div class="form-group">
                      	
                      	<input type="file" name="photo">
                      	
                      </div>



                      <div class="form-group">
                      	
                      	<input class="btn btn-info" type="submit" name="register">
                      	
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