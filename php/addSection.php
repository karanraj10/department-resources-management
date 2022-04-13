<?php
$sectionName = $_POST["sectionName"];
$sectionCapacity = $_POST["sectionCapacity"];
$sectionDesc = $_POST["sectionDesc"];
$sectionAllocated = 0;

$con = mysqli_connect("localhost", "root", "", "department");
$check = "SELECT sectionName FROM section WHERE sectionName='$sectionName'";
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    echo json_encode(array("status"=>false,"msg"=>"Section alreday exist!"));
}
else{
    $addSec = "INSERT INTO section VALUE('','$sectionName','$sectionDesc','$sectionCapacity','$sectionAllocated')";
    $result = mysqli_query($con, $addSec);
    if($result){
        echo json_encode(array("status"=>true,"msg"=>"Section added Successfully"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
    }
}
?>