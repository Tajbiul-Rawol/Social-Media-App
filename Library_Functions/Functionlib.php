<?php 

    //updated upload function...........
    function File_upload($file, $location = '',  $file_format = ['jpg','png'] , $file_type = null ){
        
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];


        //file extension name...
        
        $file_array = explode('.',$file_name);
        $file_extension = strtolower(end($file_array));

        

        //file type default...

        if (!isset($file_type['type'])) {
        	 $file_type['type'] = 'image';
        }

        if (!isset($file_type['file_name'])) {
        	$file_type['file_name'] = '';
        }

        if (!isset($file_type['fname'])) {
        	$file_type['fname'] = '';
        }

        if (!isset($file_type['lname'])) {
        	$file_type['lname'] = '';
        }



        if ($file_type['type'] == 'image') {
        	
        	$file_name = md5(time().rand()).'.'.$file_extension;
        }
        elseif ($file_type['type'] == 'file') {
        	
        	$file_name =  date('d_m_Y_g_h_s').'_'.$file_type['file_name'].'_'.$file_type['fname'].'_'.$file_type['lname'].'.'.$file_extension;
        }



        $mess = '';

        if (in_array($file_extension, $file_format) == false) {
        	
             $mess =  '<p class="alert alert-danger"> incorrect data format! <button data-dismiss="alert" class="close"> &times; </button></p>';

             //echo "not uploaded";
        }
        else{
        	move_uploaded_file($file_tmp_name, $location.$file_name);

          //echo "uploaded";	
         // echo $file_name;
        }


      return [
         
         'mess' => $mess,
         'file_name' => $file_name
      ];


    }



  function dataCheck($conn, $col_name , $data, $table){
          
          $sql = "SELECT $col_name FROM $table WHERE $col_name= '$data' ";
          $data = $conn -> query($sql);
          
          //returns the number of rows for the same data
          $row_cnt = $data -> num_rows;

          //checks if the number of row is greater than 0 then returns false
          if ($row_cnt > 0) {
          	  return false;
          }else{
          	  return true;
          }


 
  }



  function old($field_name){
    
      if (isset($field_name)) {
      	  
      	  if (isset($_POST[$field_name])) {
      	  	  echo $_POST[$field_name];
      	  }
      }

  }


///fash message 
 function setMsg($msg){

 	  setcookie('msg',$msg,time() + 10);
 }

 function getMsg(){

     if (isset($_COOKIE['msg'])) {
     		
     	echo '<p class="alert alert-success">'.$_COOKIE['msg'].'<button data-dismiss="alert" class="close"> &times; </button></p>';
     }
 	 
 }





///previous function..........
function Upload_file($first_name, $last_name, $f_name,$f_tmp_name,$folder,$file_ex,$naming_format){

                       $fil_name = $f_name;
                       $fil_tmp_name = $f_tmp_name;

                       //filename extension
                       $file_array = explode('.',$fil_name);
                       $file_extensiion = strtolower(end($file_array));


                       switch ($naming_format) {
                       	case 'dt':
                       		  if ($file_extensiion == 'docx' && $folder == 'cv/') {
                       		  	$student_cv = date('d_m_Y_g_h_s').'_'.$first_name.'_'.$last_name.'.'.$file_extensiion;
                       		  	move_uploaded_file( $fil_tmp_name, $folder. $student_cv);
                       		  }
                       		break;

                       	case 'enc':
                       		  if ($file_extensiion == 'pdf' && $folder == 'cv/') {
                       		  	 $unique_file_name = md5(time().rand(0 , 1000000)).'.'.$file_extensiion;
                       		  	 move_uploaded_file( $fil_tmp_name, $folder. $student_cv);
                       		  }
                       	
                       		break;

                       	default:

                              $mess = '<p class="alert alert-danger"> incorrect file format <button data-dismiss="alert" class="close"> &times; </button></p>';
                       		
                       		break;
                       }


                   }










 ?>