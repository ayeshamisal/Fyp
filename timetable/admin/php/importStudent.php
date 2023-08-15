
<?php
    require('../../conn.php');
    require_once '../vendor/autoload.php'; 
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 

if(isset($_POST['import'])){
	// Allowed mime types 
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
     if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)){ 

    if(is_uploaded_file($_FILES['file']['tmp_name'])){ 
                $reader = new Xlsx(); 
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']); 
                $worksheet = $spreadsheet->getActiveSheet();  
                $worksheet_arr = $worksheet->toArray(); 
    
                // Remove header row 
                unset($worksheet_arr[0]); 
                foreach($worksheet_arr as $row){ 
                $s_id =$row[0];
                $name = $row[1];
                $Subjects = explode(', ',$row[2]);
    
                $Subject_endcode = json_encode($Subjects);
               $insertQuery = "INSERT INTO students (s_id,name, subject, status) VALUES ('$s_id','$name', '$Subject_endcode', 'available')";
                if ($dbConnection->query($insertQuery) === TRUE) {
                    $_SESSION['message'] = "Data inserted successfully";
                   
                } else {
                    $_SESSION['message'] = "Error inserting values";
                    header("Location: ../student_details.php");
                }

              }

               $_SESSION['message'] = "Data inserted successfully";
                header("Location: ../student_details.php");
              }

     }
     else{
      echo "file not found";
     }

}
		?>