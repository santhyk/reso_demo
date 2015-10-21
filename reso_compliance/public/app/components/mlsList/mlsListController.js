app.controller('mlsListController',['$scope','$http', '$location','$rootScope','loginService','mlsListService',function($scope, $http, $location, $rootScope, loginService, mlsListService) {
    
    /**
     * Request to view mls list
     * @author Naheeda<incubator189@hotmail.com>
     */
    var request = mlsListService.getMlsDetails()
    .success(function (response) { 
            $scope.mlsdetails =response;
            $location.path( "/mlsList" );
    }).error(function (response, status, headers, config) {
            $scope.response = "error in fetching data";
            $location.path( "/dashboard" );
    }); 
    
    /**
     * Request to edit and delete the mls
     * @author Rushda<incubator241@hotmail.com>
     */
    $scope.edit = function(id) {
        $location.path( "/mls/"+id );
    };
    $scope.delete = function(id) {
        var request = mlsListService.deleteMls(id)
        .success(function (data, status, headers, config) {
            var request = mlsListService.getMlsDetails()
            .success(function (response) { 
                $scope.mlsdetails =response;
            }).error(function (response, status, headers, config) {
                $scope.response = "error in fetching data";
                $location.path( "/dashboard" );
            }); 
        }).error(function (data, status, headers, config) {
            alert(status);
        });
    };
    
    /**
     * For sort and search
     * @author Naheeda<incubator189@hotmail.com>
     */
    $scope.predicate = 'id';
    $scope.reverse = true;
    $scope.searchMls   = '';// set the default search/filter term
}]);


