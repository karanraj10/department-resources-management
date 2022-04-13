<?php
$con = mysqli_connect("localhost", "root", "", "department");
$records = array();
$selectSec = "SELECT categoryID,categoryName,categoryDesc FROM categories";
$result = mysqli_query($con, $selectSec);
while ($row = mysqli_fetch_assoc($result)) {
    $records[] = array("categoryName"=>$row["categoryName"],"categoryDesc"=>$row["categoryDesc"],"categoryID"=>$row["categoryID"]);
}
echo json_encode($records);