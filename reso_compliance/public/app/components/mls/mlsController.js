app.controller('mlsController',['$scope','$http', '$location','$stateParams','mlsService',function($scope, $http, $location, $stateParams,mlsService) {
    $scope.action = "Add";
    $scope.date = new Date().toJSON().slice(0,10);
    /**
     * Request to list the mls
     * @author Rushda<incubator241@hotmail.com>
     */
    if ($stateParams.mlsId != "add") {
        var id = $stateParams.mlsId;
        var request = mlsService.getMls(id)
        .success(function (data, status, headers, config) {
        $scope.user = data;
        $scope.user.zipcode = parseInt($scope.user.zipcode);
        $scope.user.phone = parseInt($scope.user.phone);
        $scope.user.action = "update";
        $scope.action = "Update";
        }).error(function (data, status, headers, config) {
        });
    }
        
    /**
     * Request to save and edit the mls
     * @author Rushda<incubator241@hotmail.com>
     */
    $scope.submit = function() {
        var user = $scope.user;
        var request = mlsService.insertMls(user)
        .success(function (data, status, headers, config) {
            $location.path( "/mlsList" );
        }).error(function (data, status, headers, config) {
        });
    };
}]);