<?php
$categoryName = $_POST["categoryName"];
$categoryDesc = $_POST["categoryDesc"];

$con = mysqli_connect("localhost", "root", "", "department");
$check = "SELECT categoryName FROM categories WHERE categoryName='$categoryName'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    echo json_encode(array("status"=>false,"msg"=>"Category alreday exist!"));
}
else{
    $addSec = "INSERT INTO categories VALUE('','$categoryName','$categoryDesc')";
    $result = mysqli_query($con, $addSec);
    if($result){
        echo json_encode(array("status"=>true,"msg"=>"Category added Successfully"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
    }
}
?>