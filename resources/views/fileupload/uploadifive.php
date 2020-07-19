<?php
session_start();
require_once "config.php";

 //////////////////////////////

$IP = $_SERVER['REMOTE_ADDR'];
$Date = date("Y:m:d");
$Time = date("H:i:m");
$Doctor_ID = 'DoctorID';
$Patient_ID = 'PID';


///////////////////

$fileID = $_POST['ID'];

$target = "files/";

$filetype = $_FILES["Filedata"]["tmp_name"][0];
$target_file = $target . basename($_FILES["Filedata"]["name"][0]);
$uploadOk = 0;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// if($imageFileType != "") {			// Allow certain file formats
//     $uploadOk = 1;
// }

if ($imageFileType != "") {			// Check if $uploadOk is set to 0 by an error

	$new_name = mt_rand();
	$final_name = $Doctor_ID.'-'.$fileID.'-'.md5($new_name).'.'.pathinfo($target_file,PATHINFO_EXTENSION);
	$new_filename = $target.$final_name;

	if (move_uploaded_file($filetype, $new_filename)){

	    $check = "SELECT Doc_Name FROM uploaded_documents_tmp WHERE Doctor_ID='$Doctor_ID' AND Doc_ID ='$fileID' AND Patient_ID = '$Patient_ID' ";
	    $res = $conn->query($check);

	    if ($res->num_rows>0){
	        $uploaded = "UPDATE uploaded_documents_tmp SET Doc_Name = '$final_name' WHERE Doctor_ID='$Doctor_ID' AND Doc_ID='$fileID' AND Patient_ID = '$Patient_ID'";
	        mysqli_query($conn,$uploaded);
        }else{
            $uploaded = "INSERT INTO uploaded_documents_tmp (Doctor_ID, Doc_ID,Doc_Name,Patient_ID, Date, Time, IP) VALUES ('$Doctor_ID','$fileID','$final_name','$Patient_ID','$Date','$Time','$IP')";
            mysqli_query($conn,$uploaded);
        }

    }
}
echo $new_filename;

?>