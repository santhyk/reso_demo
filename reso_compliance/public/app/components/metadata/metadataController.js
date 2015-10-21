app.controller('metadataController',['$scope','$http','$rootScope','loginService',function($scope, $http, $rootScope, loginService) {
     $scope.user = {serverName: "co_mtomls", serverUrl: "http://matrixrets.recolorado.com/rets/login.ashx",
                    userName:"031763RET",password:"Ujh528G",retsversion:"RETS/1.7.2",resource:"Property",class:"RESI"}; 
    
    $scope.submit = function() {
        var request = $http({
            method: "post",
            url: "/rets/index",
            data: {
                serverName: $scope.user.serverName,
                serverUrl: $scope.user.serverUrl,
                userName: $scope.user.userName,
                password: $scope.user.password,
                userAgent: $scope.user.userAgent,
                userAgentPassword: $scope.user.userAgentPassword,
                retsversion: $scope.user.retsversion,
                resource: $scope.user.resource,
                class: $scope.user.class,
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).success(function (data, status, headers, config) {
            //alert(data);
        alert(JSON.stringify(data));
        }).error(function (data, status, headers, config) {
        alert(status);
        });
      };      
    }]);