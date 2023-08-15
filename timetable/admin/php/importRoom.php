
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
                $room_name = $row[0];
                $capacity = $row[1];
                $lab = $row[2];
                $status = "available";
                     if (empty($room_name) || empty($capacity) || empty($lab) ) {
                    $_SESSION['message'] = "Missing values in the uploaded file";
                header("Location: ../room_detail.php");


                    exit();
                }
               $insertQuery = "INSERT INTO room (room_name, capacity,lab, status)
               VALUES ('$room_name', $capacity,'$lab', '$status')";

                if ($dbConnection->query($insertQuery) === TRUE) {
                    $_SESSION['message'] = "Data inserted successfully";
                   
                } else {
                    $_SESSION['message'] = "Error inserting data";
                    
                }
              }
                $_SESSION['message'] = "Data inserted successfully";
                header("Location: ../room_detail.php");
              }

     }
     else{
      echo "file not found";
     }

}
		?>