var app = angular.module('AApp', []);
      app.controller('ACtrl', function($scope, $http) {
        $scope.courses = [];
        $scope.taken = [];
        $scope.filtered = [];
        $scope.now = new Date();
        $scope.month = new Date(($scope.now.getFullYear())+"-"+($scope.now.getMonth()+1));
        $scope.monthSent = "";

        const monthNames = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"];

        $scope.monthSent = monthNames[$scope.month.getMonth()];

        //load courses available
        $http.get("php/courses_list.php")
          .then(function (response) {
            $scope.courses = response.data.records;
            $scope.filtered = $scope.courses.slice();
          });

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

        // select the courses to take
        $scope.pick = function(index) {
          if($scope.taken.length <= 3) {
            $scope.taken.push($scope.filtered[index]);
            $scope.filtered.splice(index, 1);
          }
        };

        $scope.updateMonth = function() {
          $scope.monthSent = monthNames[$scope.month.getMonth()];
        }

        $scope.registerCourse = function() {
          $scope.toSend = [];
          for(i=0;i<$scope.taken.length;i++) {
            $scope.toSend.push($scope.taken[i]['id']);
          }
        };
      });