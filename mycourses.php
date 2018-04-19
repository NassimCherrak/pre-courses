<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "angusql");

$user = 1;

$sql = "SELECT course_taken.id, course_taken.id_user, course_taken.id_course, course_taken.month, courses.title, courses.duration FROM course_taken INNER JOIN courses ON courses.id = course_taken.id_course WHERE course_taken.id_user = " . $user . " ORDER BY course_taken.month";

$result = $conn->query($sql);

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"user":"'. $rs["id_user"] . '",';
    $outp .= '"course":"'. $rs["id_course"] . '",';
    $outp .= '"month":"'. $rs["month"] . '",';
    $outp .= '"time":"'. $rs["duration"] . '",';
    $outp .= '"title":"'. $rs["title"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>