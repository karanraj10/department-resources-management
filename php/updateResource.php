<?php
$con = mysqli_connect("localhost", "root", "", "department");

date_default_timezone_set("Asia/Calcutta");
$now = date_create()->format('Y-m-d H:i:s');

$resourceID = $_POST["resourceID"];
$resourceMAC = $_POST["resourceMAC"];
$resourceCompany = $_POST["resourceCompany"];
$resourceName = $_POST["resourceName"];
$resourceDesc = $_POST["resourceDesc"];


$updateSection = "UPDATE resources SET resourceMAC='$resourceMAC', resourceName='$resourceName', resourceCompany='$resourceCompany', resourceDesc='$resourceDesc', lastUpdated='$now' WHERE resourceID = '$resourceID'";
$query = mysqli_query($con,$updateSection);
if($query){
    echo json_encode(array("status"=>true,"msg"=>"Resource Updated Successfully"));
}
else{
     echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
?>