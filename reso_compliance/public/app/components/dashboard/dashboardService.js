app.service('dashboardService', ['$http', function ($http,$scope) {

    var urlBase = '/rets/mls';

    this.getTestDetails = function () {
        return $http.post(urlBase + '/testlist');
    };

}]);