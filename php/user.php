<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "premergency352");

$user = 1;

$sql = "SELECT id, name, email, date, gender, status, bio FROM user WHERE id=". $user;

$result = $conn->query($sql);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"name":"'. $rs["name"] . '",';
    $outp .= '"email":"'. $rs["email"] . '",';
    $outp .= '"date":"'. $rs["date"] . '",';
    $outp .= '"gender":"'. $rs["gender"] . '",';
    $outp .= '"status":"'. $rs["status"] . '",';
    $outp .= '"bio":"'. $rs["bio"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>