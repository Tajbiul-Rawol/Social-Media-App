<?php include_once "Library_Functions/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	
    <a class="btn btn-success btn-sm" href="index.php">Add students</a>
	<div class="wrap-table shadow">
		<div class="card">
			<div class="card-body">
				<h2>All Data</h2>
				<hr>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method= "POST">
					<input type="text" name="search" placeholder="name/email/location/gender">
					<input type="submit" class="btn btn-sm btn-primary" name="search-btn" value="search">
				</form>
				<hr>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Age</th>
							<th>Location</th>
							<th>Gender</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

                            <?php 

                                 $search ='';
                                 if ( isset($_POST['search-btn']) ) {
                                     $search = $_POST['search'];
                                 }

                                $sql = "SELECT * FROM students WHERE location='$search' OR gender='$search' OR email='$search' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%' ";
                                $student_data = $connection -> query($sql);
                                
                                $i = 1; 
                                while($single_data = $student_data -> fetch_assoc()):


                             ?>

						<tr>
							<td><?php echo $i; $i++; ?></td>
							<td><?php echo $single_data['firstname'] ?></td>
							<td><?php echo $single_data['lastname'] ?></td>
							<td><?php echo $single_data['email'] ?></td>
							<td><?php echo $single_data['age'] ?></td>
							<td><?php echo $single_data['location'] ?></td>
							<td><?php echo $single_data['gender'] ?></td>
							<td><img  style="width: 150px;"src="photos/<?php echo $single_data['files'] ?>" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info" href="single-student.php?id=<?php echo $single_data['id'] ?>">View</a>
								<a class="btn btn-sm btn-warning" href="edit.php?id=<?php echo $single_data['id'] ?>">Edit</a>
								<a id="delete" class="btn btn-sm btn-danger" href="delete.php?id=<?php echo $single_data['id'] ?>">Delete</a>
							</td>
						</tr>
						 
						 <?php endwhile; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		
      $('a#delete').click(function(){
             let con = confirm('you will not be able to retrieve the data, are you sure?');

             if (con == true) {
             	return true;
             }else{
             	return false;
             }
      });

	</script>
</body>
</html>