<?php
session_start();

include '../config.php';



function Email($email_to, $name, $link)
{

    $html_content = '<div style="width:90%;border: solid 2px #f39c12;font-family: \'Roboto\', sans-serif;padding: 10px;">
            			<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0">
            				<tr>
            					<td>
            						<table width="100%" bgcolor="#ffffff" cellpadding="10" cellspacing="0" border="0">
            							<tr style="background-color: #333333;border: solid 2px #333333;">
            								<td style="width:50%;">
            									<img src="" style="height:80px;">
            								</td>
            							</tr>
            						</table>
            					</td>
            				</tr>
            				<tr>
            					<td style="background-color: #eee;padding: 10px 20px;">
            						Dear, ' . ucfirst($name) . '<br>
            					</td>
            				</tr>
            				<tr>
            					<td>
            						<center>
            						<br>
            						<strong>Prescription is uploaded:</strong><br><br>
            						<strong>Download link:</strong> ' . $link . '<br>
            						</center>
            					</td>
            				</tr>
            				<tr>
            					<td style="background-color: #eee;padding: 10px 20px;">
            						Thank You.<br>
            					</td>
            				</tr>
            			</table>
            		</div>';
    $subject = "Prescription Upload";
    $msg_url = "../mail/email.php";
    $message = "Email=" . $email_to . "&Subject=" . $subject . "&Name=" . $name . "&Content=" . $html_content;
    $ch = curl_init();    //Email Script
    curl_setopt($ch, CURLOPT_URL, $msg_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    // echo $server_output;
    curl_close($ch);
    return $server_output;

}

function SMS($sms_to, $name, $link){

    $msg_url = "http://164.52.195.161/API/SendMsg.aspx?";
    $msg_username = "20191018";
    $msg_password = "n4AiMa9u";
    $msg_sender = "INFSMS";
    $msg_message = "Dear ".$name.",\r\nYour Prescription is uploaded\r\n and your download link is".$link;
    $msg_link_txt = "uname=".$msg_username."&pass=".$msg_password."&send=".$msg_sender."&dest=".$sms_to."&msg=".urlencode($msg_message);



    $cSession = curl_init();
    //step2
    curl_setopt($cSession,CURLOPT_URL, $msg_url. ($msg_link_txt));
    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cSession,CURLOPT_HEADER, false);
    //step3
    $result=curl_exec($cSession);
    curl_close($cSession);
    if(isset($result)){
        $ss = explode("-", $result);
        $track = $ss[0];
    }

    if($track == $sms_to){
        $sms_Status = "Success";
        echo '</br><span style="float:left;font-size:12px;background-color:#009624;color:white;padding:3px;border-radius: .20em;">Conformation SMS Send To Patients Phone Number </span></br>'  ;
    }
    else{
        $sms_Status = "Fail";
        echo '</br><span style="float:left;font-size:12px;background-color:#c41c00;color:white;padding:3px;border-radius: .20em;">Something Went Worng !! </span></br>'  ;
    }

}

function savePrecription(){

    global $conn;

    $response = array();
    $response["response"] = true;


    try {

        foreach ($_POST as $key => $value) {
            $CleanKey = $key;
            $CleanValue = $value;
            if (!empty($CleanValue) && !empty($CleanKey)) {
                //getting all post key and value clean dynamically
                $$CleanKey = $CleanValue;
            } else {
                $$CleanKey = null;
            }
        }

        //TODO download link to be dynamic


        $opd = $_POST['opd'];

        $pt_obj = (object) [];
        $pt_obj->info = (object)[];

        $patient_uid_query = $conn->query("SELECT * FROM opd_records WHERE OPD_No = '$opd' LIMIT 1")->fetch_assoc()['Registration_Number'];
        $patient_info = $conn->query("SELECT * FROM patient_registration WHERE Registration_Number = '$patient_uid_query'");

        if ($patient_info->num_rows>0){

            $row = $patient_info->fetch_assoc();

            $pt_obj->info->name = $row['Patient_Name'];
            $pt_obj->info->email = $row['Email'];
            $pt_obj->info->phone = $row['Phone'];

            //Email('masum@geekworkx.com', 'Doctor', 'download_link');

            if (filter_var($pt_obj->info->email, FILTER_VALIDATE_EMAIL)) {
//                echo json_encode($pt_obj);
                Email($pt_obj->info->email, $pt_obj->info->email, 'download_link');
                $response['message'] = "email is  succesfully sent the patient";
            }else{
                $response['failure'] = "Invalid email ";

            }


             SMS($pt_obj->info->phone, $pt_obj->info->name, 'download_link');


        }







    } catch (Exception $err) {
        $response["response"] = false;
        $response["message"] = $err->getMessage();

    } finally {
        echo json_encode($response);
    }


}

function illegalRequest()
{
    $response = array("response" => false, "message" => "Illegal Request", "POST" => $_POST);
    echo json_encode($response);
}

if (isset($_POST['action'])) {

    $action = mysqli_real_escape_string($conn, $_POST['action']);

    switch ($action) {

        case 'savePrecription' :
            savePrecription();
            break;
        default :
            illegalRequest();
            break;

    }

} else {
    illegalRequest();
}


?>



