app.controller('loginController',['$scope','$http', '$location', 'loginService', function($scope, $http, $location, loginService) {
     $scope.errorMsg = '';
     $scope.loginSubmit = function (user) {
         loginService.Login($scope.user, function (response) {
            if (response.status == 'success') {
                $scope.errorMsg = '';
                loginService.SetCredentials(response.userData);
                $location.path('/dashboard');
            } else {
                $scope.errorMsg = response.message;
                $location.path('/login');
            }
        });
    };
           
}]);