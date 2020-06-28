<?php  include_once "Library_Functions/Functionlib.php"; ?>
<?php  include_once "Library_Functions/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Students</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

    <?php

            //get student id from $_GET 
           if (isset($_GET['id'])) {
             $id_url = $_GET['id'];
           }
          
    


       if (isset($_POST['update'])) {


       	    /**
       	     * data received from the form
       	     */
       	    
       	     $fname = $_POST['fname'];
       	     $lname = $_POST['lname'];
       	     $email = $_POST['email'];
       	     //$pass = $_POST['pass'];
             $uname = $_POST['uname'];
             $age = $_POST['age'];
             $gender = $_POST['gender'];

       	     //retrieving photo name 
       	    
       	     $file_name = $_FILES['photo']['name'];
             $file_tmp_name = $_FILES['photo']['tmp_name'];
             $file_size = $_FILES['photo']['size'] ;
            
            
             //file size
              $size=(($file_size/1024)/1024);
              

             


       	     //email explode
             /**
              *the string has been exploded to an array and stored in the exploded_email variable
              the end function is used to pickup the last element of the array and store in the valid_email variable
              */
       	     $exploded_email = explode('@', $email); 
       	     $valid_email = end($exploded_email);

       	    


       	     if (empty($fname) || empty($lname) || empty($email) ||  empty($uname)||empty($age)|| empty($gender) ) 
       	     {

       	     	     $mess = '<p class="alert alert-danger"> All fields required! <button data-dismiss="alert" class="close"> &times; </button></p>';

       	     }
       	     elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
       	     {

       	     	  $mess = '<p class="alert alert-danger"> invalid email format! <button data-dismiss="alert" class="close"> &times; </button></p>';

       	     }
             elseif ($age < 18 || $age > 70) {
               
               $mess = '<p class="alert alert-warning">Age is not within the range!!<button data-dismiss="alert" class="close"> &times; </button></p>';
             }
       	     
       	     else
       	     {
       	     	      
                    if (isset($file_name)) {

                        $data = File_upload($_FILES['photo'], 'photos/',['jpg','jpeg'],[
                                  'type' => 'image'       
                                  ]);
                        
                        $photo_name = $data['file_name'];
                        

                    }else{

                          $photo_name = $_POST['old_photo'];                        
                    }
                  

                    //query to Update data into the table........

                    $sql = "UPDATE users SET
                            first_tname = '$fname',
                            last_name = '$lname',
                            email = '$email',
                            username = '$uname',
                            age = '$age'
                            gender = '$gender',
                            files = '$photo_name'
                            WHERE  id = '$id_url' ";
                    
                    $connection -> query($sql);


       	     	      $mess = '<p class="alert alert-success"> Update Successful! <button data-dismiss="alert" class="close"> &times; </button></p>';


       	     }



       }

       // retrieve all data of the student from the id
           $sql = "SELECT * FROM users WHERE id='$id_url' ";
           $data = $connection -> query($sql);
           $single_data = $data -> fetch_assoc();


    ?>

   <div class="container">
   	   
   	   <div class="log w-50 mx-auto mt-5">

   	   	<?php 
            
            if (isset($mess)) {
            	echo $mess;
            }

   	   	?>
   	   	
           <a  class="btn btn-success btn-sm" href="allpeople.php">View All Users</a>
   	   	  <div class="card shadow">
   	      	
   	      	<div class="card-header">
   	      		<h2>Update your Info</h2>
   	      	</div>
   	      	<div class="card-body">
   	      		
                <!---the id is passed to the url when the update btn is pressed, so that the id stays in the url to load the data in the form-->

                 <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo"$id_url"; ?>" method="POST"  enctype="multipart/form-data">
                 	 
                      <div class="form-group">
                      	<label for="">First Name</label>
                      	<input class="form-control" type="text" value="<?php echo $single_data['first_name'] ?>" name="fname">
                      	
                      </div>

                      <div class="form-group">
                      	<label for="">Last Name</label>
                      	<input class="form-control" type="text"  value="<?php echo $single_data['last_name'] ?>" name="lname">
                      	
                      </div>

                      <div class="form-group">
                      	<label for="">Email</label>
                      	<input class="form-control" type="text" value="<?php echo $single_data['email'] ?>" name="email">
                      	
                      </div>
                        <div class="form-group">
                        <label for="">Username</label>
                        <input class="form-control" type="text" value="<?php echo $single_data['username'] ?>" name="uname">
                        
                      </div>


                      <div class="form-group">
                        <label for="">Age</label>
                        <input class="form-control" type="text" value="<?php echo $single_data['age'] ?>" name="age">
                        
                      </div>

                      <div class="form-group">
                        <label for="">Gender</label>
                        <br>
                        <input name="gender" class="" <?php if($single_data['gender']=='Male'): echo "checked"; endif; ?> type="radio" value="Male" id="male"><label for="male">Male</label>
                        <input name="gender" class="" <?php if($single_data['gender']=='Female'): echo "checked"; endif; ?> type="radio" value="Female" id="female"><label for="female">Female</label>
                      </div>


                                              
                       <div class="form-group">
                           <img  style="width: 150px;"src="photos/<?php echo $single_data['photo'] ?>">
                           <input type="hidden" value="<?php echo $single_data['photo'] ?>" name="old_photo">
                       </div>
                      <div class="form-group">
                      	
                      	<input type="file" name="photo">
                      	
                      </div>



                      <div class="form-group">
                      	
                      	<input class="btn btn-info" type="submit" value="update" name="update">
                      	
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