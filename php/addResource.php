<?php
$con = mysqli_connect("localhost", "root", "", "department");

date_default_timezone_set("Asia/Calcutta");
$now = date_create()->format('Y-m-d H:i:s');

$resourceNum = $_POST["resourceNum"];
$resourceMACAddress = $_POST["resourceMACAddress"];
$resourceCompanyArray = $_POST["resourceCompany"];
$resourceNameArray = $_POST["resourceName"];
$resourceDescArray = $_POST["resourceDesc"];
$resourceCategory = $_POST["resourceCategory"];
$resourceSection = $_POST["resourceSection"];

// Comaa Sperated value to array
$MACArray = explode(',', $resourceMACAddress);
$compnayArray = explode(',', $resourceCompanyArray);
$nameArray = explode(',', $resourceNameArray);
$descArray = explode(',', $resourceDescArray);

// String to use for IN operator
$names = implode('\', \'', $MACArray);
$fin = "'" . $names . "'";

$check = 'SELECT resourceMAC FROM resources WHERE resourceMAC IN ('.$fin.')';
$query = mysqli_query($con,$check);
if(mysqli_num_rows($query)>0){
    $row = mysqli_fetch_assoc($query);
    $mac= $row["resourceMAC"];
    echo json_encode(array("status"=>false,"msg"=>"Resource with MAC Address: ".$mac." alreday exist!","foundMACAdd"=>$mac));
}
else{
    for ($x = 0; $x < count($MACArray); $x++) {
        $query_parts[] = "('','".$nameArray[$x]."','".$descArray[$x]."','".$MACArray[$x]."','".$compnayArray[$x]."','$resourceCategory','$resourceSection','$now')";
    }
    $query1 = "INSERT INTO resources VALUES ";
    $query1 .= implode(',', $query_parts);
    $result = mysqli_query($con, $query1);
    if($result){

        $updateSection = "UPDATE section SET sectionAllocated = sectionAllocated+'$resourceNum' WHERE sectionID = '$resourceSection'";
        $query = mysqli_query($con,$updateSection);
        
        echo json_encode(array("status"=>true,"msg"=>"Resource added Successfully"));
    }
    else{
        echo json_encode(array("status"=>false,"msg"=>"Something went wrong"));
    }
}
?>