<?php
$con = mysqli_connect("localhost", "root", "", "department");

$sectionID = $_POST["sectionID"];
$sectionName = $_POST["sectionName"];
$sectionCapacity = $_POST["sectionCapacity"];
$sectionDesc = $_POST["sectionDesc"];

$updateSection = "UPDATE section SET sectionName='$sectionName', sectionCapacity='$sectionCapacity', sectionDesc='$sectionDesc' WHERE sectionID = '$sectionID'";
$query = mysqli_query($con,$updateSection);
if($query){
    echo json_encode(array("status"=>true,"msg"=>"Section Updated Successfully"));
}
else{
     echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
?>