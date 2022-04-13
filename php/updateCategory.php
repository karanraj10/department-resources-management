<?php
$con = mysqli_connect("localhost", "root", "", "department");

$categoryID = $_POST["categoryID"];
$categoryName = $_POST["categoryName"];
$categoryDesc = $_POST["categoryDesc"];

$updatecategory = "UPDATE categories SET categoryName='$categoryName',categoryDesc='$categoryDesc' WHERE categoryID = '$categoryID'";
$query = mysqli_query($con,$updatecategory);
if($query){
    echo json_encode(array("status"=>true,"msg"=>"Category Updated Successfully"));
}
else{
     echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
?>