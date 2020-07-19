<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Mail\SendVideoLink;
use Illuminate\Support\Facades\Mail;


class ConferenceController extends Controller
{
    public function index(Request $request){
        $data['room'] = $request->room;
        $data['username'] = $request->username;
        $data['password'] = $request->password;

        return view('conference', compact('data'));

    }

    public function indexWithToken(Request $request){

        //list($room, $username, $password) = explode('|', $this->decrypt($request->token, 'Geekpass@123456!23'));

        list($room, $username, $password) = array_pad(explode('|', $this->decrypt($request->token, 'Geekpass@123456!23'), 3), 3, null);

        if(is_null($room) || is_null($username) || is_null($password))
            return abort(404);

        $isDoctor = base64_decode($request->doctor);

        $data['room'] = $room;
        $data['username'] = $username;
        $data['password'] = $password;
        $data['isDoctor'] = $isDoctor;


        // $data['room'] = $request->room;
        // $data['username'] = $request->username;
        // $data['password'] = $request->password;

        return view('conference', compact('data'));

    }

    public function create(Request $request){
        list($room, $password) = explode('|', $this->decrypt($request->roompass, 'Geekpass@123456!23'));
        list($doctor_name, $doctor_email, $doctor_phone, $is_doctor) = explode('|', $this->decrypt($request->doctor, 'Geekpass@123456!23'));
        list($patient_name, $patient_email, $patient_phone, $is_doctor) = explode('|', $this->decrypt($request->patient, 'Geekpass@123456!23'));

        $data['room'] = $room;
        $data['password'] = $password;

        $data['doctor_name'] = $doctor_name;
        $data['doctor_email'] = $doctor_email;
        $data['doctor_phone'] = $doctor_phone;

        $data['patient_name'] = $patient_name;
        $data['patient_email'] = $patient_email;
        $data['patient_phone'] = $patient_phone;

        return view('conference.create', compact('data'));
    }



    public function store(Request $request){
        $room = $request->room . ' - ' . $request->patient_name;
        $password = $request->password;

        $doctor_name = $request->doctor_name;
        $doctor_email = $request->doctor_email;
        $doctor_phone = $request->doctor_phone;

        $patient_name = $request->patient_name;
        $patient_email = $request->patient_email;
        $patient_phone = $request->patient_phone;

        $doctor_token = $this->encrypt($room . '|' . $doctor_name . '|' . $password, 'Geekpass@123456!23');

        $patient_token = $this->encrypt($room . '|' . $patient_name . '|' . $password, 'Geekpass@123456!23');

        //dd($doctor_token);
        $patient_details = array();
        $doctor_details = array();

        $patient_details["name"] = $patient_name;
        $patient_details["email"] = $patient_email;
        $patient_details["phone"] = $patient_phone;

        $doctor_details["name"] = $doctor_name;
        $doctor_details["email"] = $doctor_email;
        $doctor_details["phone"] = $doctor_phone;



        Mail::to($doctor_email)
            ->queue(new SendVideoLink($doctor_token, $patient_name, 1, $doctor_name, $patient_details, $room, $password));

        Mail::to($patient_email)
            ->queue(new SendVideoLink($patient_token, $doctor_name, 0, $patient_name, $doctor_details, $room, $password));

        return redirect('/thankyou')->with('message', 'Email sent successfully...');

    }

    public function thankyou(){
        return view('conference.create');
    }

    public function encrypt($string, $key){
        $result = "";
        for($i=0; $i<strlen($string); $i++){
            $char=substr($string, $i, 1); $keychar=substr($key, ($i % strlen($key))-1, 1);
            $char=chr(ord($char)+ord($keychar)); $result.=$char;
        }
        $salt_string="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxys0123456789~!@#$^&*()_+`-={}|:<>?[]\;',./" ;
        $length=rand(1, 15); $salt="" ;
        for($i=0; $i<=$length; $i++){
            $salt .=substr($salt_string, rand(0, strlen($salt_string)), 1);
        }

        $salt_length=strlen($salt);
        $end_length=strlen(strval($salt_length));

        return base64_encode($result.$salt.$salt_length.$end_length);
    }

    public function decrypt($string, $key){
        $result="" ;
        $string=base64_decode($string);
        $end_length=intval(substr($string, -1, 1));
        $string=substr($string, 0, -1);
        $salt_length=intval(substr($string, $end_length*-1, $end_length));
        $string=substr($string, 0, $end_length*-1+$salt_length*-1);

        for($i=0; $i<strlen($string); $i++){
            $char=substr($string, $i, 1);
            $keychar=substr($key, ($i % strlen($key))-1, 1);
            $char=chr(ord($char)-ord($keychar)); $result.=$char;
        }
        return $result;
    }



}
