app.controller('dashboardController',['$scope','$http', '$rootScope','loginService', '$location','dashboardService',function($scope, $http, $rootScope, loginService, $location, dashboardService) {

    /**
     * Request to view test list
     * @author Naheeda<incubator189@hotmail.com>
     */
    var request = dashboardService.getTestDetails()
    .success(function (response) { 
            $scope.testdetails =response;
    }).error(function (response, status, headers, config) {
            $scope.response = "error in fetching data";
    });
    
    /**
     * For sort and search
     * @author Naheeda<incubator189@hotmail.com>
     */
    $scope.predicate = 'application_uid';
    $scope.reverse = true;
    $scope.searchMls   = '';     // set the default search/filter term
}]);