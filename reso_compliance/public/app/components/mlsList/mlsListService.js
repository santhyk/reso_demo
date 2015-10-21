app.service('mlsListService', ['$http', function ($http,$scope) {

    var urlBase = '/rets/mls';

    this.getMlsDetails = function () {
        return $http.post(urlBase + '/list');
    };

    this.deleteMls = function (id) {
        return $http.post(urlBase + '/delete' , id);
    };

}]);