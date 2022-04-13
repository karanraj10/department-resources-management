<?php
$con = mysqli_connect("localhost", "root", "", "department");

$destResource = $_POST["destResource"];
$sourceResource = $_POST["sourceResource"];
$destSection = $_POST["destSection"];
$sourceSection = $_POST["sourceSection"];

// Comaa Sperated value to array
$dest = explode(',', $destResource);
$source = explode(',', $sourceResource);

$length = count($dest);

// String to use for IN operator
$names = implode('\', \'', $dest);
$fin = "'" . $names . "'";

$names1 = implode('\', \'', $source);
$fin1 = "'" . $names1 . "'";

$check = "UPDATE resources SET resourceSection='$destSection' WHERE resourceMAC IN ($fin1)";
$check1 = "UPDATE resources SET resourceSection='$sourceSection' WHERE resourceMAC IN ($fin)";
$query = mysqli_query($con,$check);
$query1 = mysqli_query($con,$check1);

if($query && $query1){
    echo json_encode(array("status"=>true,"msg"=>"Resource Replaced Successfully"));
}
else{
    echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
}
?>