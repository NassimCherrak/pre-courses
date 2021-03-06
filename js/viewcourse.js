var app = angular.module('AApp', []);
      app.controller('ACtrl', function($scope, $http) {
        $scope.mycourses = [];
        $scope.coursegroups = [];
        $scope.toDelete = [];

        //load user information
        $http.get("php/user.php")
          .then(function (response) {
            $scope.user = response.data.records[0];
            $scope.userdata = [];
            $scope.userdata.name = $scope.user.name;
            $scope.userdata.email = $scope.user.email;
            $scope.userdata.date = $scope.user.date;
            $scope.userdata.gender = $scope.user.gender;
            $scope.userdata.status = $scope.user.status;
            $scope.userdata.bio = $scope.user.bio;
          });

        //get the user's courses and organize them in groups of the same month
        $http.get("php/mycourses.php")
          .then(function (response) {
            $scope.mycourses = response.data.records;
            let current_m;
            if($scope.mycourses.length > 0) {
              current_m = $scope.mycourses[0]['month'];
            }
            let current_group = [];
            for(i=0;i<$scope.mycourses.length;i++) {
              if($scope.mycourses[i]['month'] == current_m) {
                current_group.push($scope.mycourses[i]);
              } else {
                $scope.coursegroups.push(current_group.slice());
                current_group = [];
                current_m = $scope.mycourses[i]['month'];
                current_group.push($scope.mycourses[i]);
              }
            }
            $scope.coursegroups.push(current_group.slice());
          }, function (response) {
            console.log("couldn't load");
          });

          //remove particular courses
          $scope.remove = function(id) {
            for(i=0;i<$scope.coursegroups.length;i++) {
              for(j=0;j<$scope.coursegroups[i].length;j++) {
                if($scope.coursegroups[i][j]['id'] == id && $scope.coursegroups[i].length > 1) {
                  $scope.toDelete.push($scope.coursegroups[i][j]['id']);
                  $scope.coursegroups[i].splice(j,1);
                }
              }
            }
          }

          //revome group of courses
          $scope.delete = function(month) {
            $scope.toDelete = [];
            for(i=0;i<$scope.coursegroups.length;i++) {
              console.log(month);
              if($scope.coursegroups[i][0]['month'] == month) {
                for(j=0;j<$scope.coursegroups[i].length;j++) {
                  $scope.toDelete.push($scope.coursegroups[i][j]['id']);
                }
              }
            }
            console.log($scope.toDelete);
          }
      });