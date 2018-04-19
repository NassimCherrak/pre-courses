<?php

$conn = new mysqli("localhost", "root", "", "angusql");

$display = "";

$user = 1;

$month = $_POST['monthsent'];

$to_add = json_decode($_POST['tosend']);

$sql = "";

$sql_check = 'SELECT * FROM course_taken WHERE month="'.$month.'"';

$check_month = $conn->query($sql_check);

//check if there's no group for the same month 
if(mysqli_num_rows($check_month) == 0) {

	foreach ($to_add as $element) {
		$sql = 'INSERT INTO course_taken (id_user, id_course, month) VALUES ('. $user . ',' . $element . ',"' . $month .'")';
		$res = $conn->query($sql);
	}

	$display = "Course(s) added.";

} else {
	$display = "You already have courses for that month, please select a different time or delete that month from your current courses.";
}

$conn->close();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Edit my Courses</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="album.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
  </head>

  <body ng-app="AApp" ng-controller="ACtrl">

    <header>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading" ng-if="userdata.status == 'Public'" ng-cloak>Welcome {{ user.name }}</h1>
          <h1 class="jumbotron-heading" ng-if="userdata.status == 'Private'" ng-cloak>Welcome Anonymous</h1>
          <p class="lead text-muted"><?=$display ?></p>
          <p>
            <a href="selectcourse.html" class="btn btn-secondary my-2">Get New Course</a>
            <a href="view_courses.html" class="btn btn-secondary my-2">My Courses</a>
            <a href="editprofile.html" class="btn btn-secondary my-2">Edit Profile</a>
          </p>
        </div>
      </section>
    </main>
    <script>
      var app = angular.module('AApp', []);
      app.controller('ACtrl', function($scope, $http) {
        $scope.user = [];

        $http.get("user.php")
          .then(function (response) {
            $scope.user = response.data.records[0];
          });

      });
    </script>
 </body>
</html>