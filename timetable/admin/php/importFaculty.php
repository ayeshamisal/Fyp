
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
                $name =$row[0];
                $Subjects = explode(', ',$row[1]);
                $email = $row[2];
                $Monday = explode(', ',$row[3]);
                $Tuesday = explode(', ',$row[4]);
                $Wednesday = explode(', ',$row[5]);
                $Thursday = explode(', ',$row[6]);
                $Friday = explode(', ',$row[7]);
                $availability =
                    [
                        'Monday' => $Monday,
                        'Tuesday' => $Tuesday,
                        'Wednesday' => $Wednesday,
                        'Thursday' => $Thursday,
                        'Friday' => $Friday,
                    ];
                $data = json_encode($availability);
                $Subject_endcode = json_encode($Subjects);
                  if (empty($name) || empty($Subjects) || empty($email) ) {
                    $_SESSION['message'] = "Missing values in the uploaded file";
                header("Location: ../faculty_details.php");

                    exit();
                }
                $insertQuery = "INSERT INTO teachers (name,email, subject, availability, status) VALUES ('$name','$email', '$Subject_endcode', '$data', 'available')";
                 if ($dbConnection->query($insertQuery) === TRUE) {
                    $_SESSION['message'] = "Data inserted successfully";
                   
                } else {
                    $_SESSION['message'] = "Error inserting data";
                    
                }
              }

               $_SESSION['message'] = "Data inserted successfully";
                header("Location: ../faculty_details.php");
              }

     }
     else{
      echo "file not found";
     }

}
		?>