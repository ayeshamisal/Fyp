
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
                $semester = $row[0];
                $courseCode = $row[1];
                $courseName = $row[2];
                $credit = $row[3];
                $lab = $row[4];
                $enrolledStudents = $row[5];
                $status = "available";
                 if (empty($semester) || empty($courseCode) || empty($courseName) || empty($credit) || empty($lab) || empty($enrolledStudents)) {
                    $_SESSION['message'] = "Missing values in the uploaded file";
                    header("Location: ../course_details.php"); // Replace with your actual page
                    exit();
                }

                $insertQuery = "INSERT INTO course (semester,course_code,course_name, enrolled_students,lab, credit, status)
                              VALUES ('$semester','$courseCode','$courseName', $enrolledStudents,'$lab', $credit, '$status')";

                if ($dbConnection->query($insertQuery) === TRUE) {
                    $_SESSION['message'] = "Data inserted successfully";
                   
                } else {
                    $_SESSION['message'] = "Error inserting data";
                    
                }
              }
               $_SESSION['message'] = "Data inserted successfully";
                header("Location: ../course_details.php");
              }

     }
     else{
      echo "file not found";
     }

}
		?>