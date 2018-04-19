<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "premergency352");

$sql = "SELECT id, title, contentbody, duration, image FROM courses";

$result = $conn->query($sql);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"title":"'. $rs["title"] . '",';
    $outp .= '"body":"'. $rs["contentbody"] . '",';
    $outp .= '"time":"'. $rs["duration"] . '",';
    $outp .= '"image":"'. $rs["image"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>