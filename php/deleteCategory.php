<?php
$catID = $_REQUEST["categoryID"];

$con = mysqli_connect("localhost", "root", "", "department");

$check = "DELETE FROM categories WHERE categoryID='$catID'";

$query = mysqli_query($con,$check);
if($query){
    echo json_encode(array("status"=>true,"msg"=>"Category Deleted Successfully"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
?>