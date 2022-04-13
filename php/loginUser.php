<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$email = $_POST["custEmail"];
$password = $_POST["custPassword"];
if($email=="dept@gmail.com"&&$password=="dept@gmail.com"){
    $_SESSION['logged_in'] = true;
    echo json_encode(array("status"=>true,"msg"=>"Login Successful"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Invalid username and password!"));
}