<?php
$secID = $_REQUEST["sectionID"];

$con = mysqli_connect("localhost", "root", "", "department");

$check = "DELETE FROM section WHERE sectionID='$secID'";

$query = mysqli_query($con,$check);
if($query){
    echo json_encode(array("status"=>true,"msg"=>"Section Deleted Successfully"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
?>