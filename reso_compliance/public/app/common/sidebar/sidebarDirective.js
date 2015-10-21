/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.directive('sideBar' , function () {
    return {
        templateUrl: 'app/common/sidebar/sidebarView.phtml',
        controller : sideBarDirective
    };
});

sideBarDirective.$inject = ['$rootScope', '$scope', 'loginService'];
function sideBarDirective($rootScope, $scope, loginService) {
    //get current user details
    $scope.currentUser = $rootScope.globals.currentUser;
    
    //logout
    $scope.ClearCredentials = function() {
        loginService.ClearCredentials();
    };
    
    
}
