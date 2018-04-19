var app = angular.module('AApp', []);
      app.controller('ACtrl', function($scope, $http) {
        $scope.user = [];

        // load user information
        $http.get("php/user.php")
          .then(function (response) {
            $scope.user = response.data.records[0];
            $scope.userdata = [];
            $scope.userdata['name'] = $scope.user.name;
            $scope.userdata['email'] = $scope.user.email;
            $scope.userdata['date'] = $scope.user.date;
            $scope.userdata['gender'] = $scope.user.gender;
            $scope.userdata['status'] = $scope.user.status;
            $scope.userdata['bio'] = $scope.user.bio;
          });

        $scope.updateUser = function() {
          console.log($scope.userdata);
        };

      });