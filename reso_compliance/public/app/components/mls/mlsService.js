app.service('mlsService', ['$http', function ($http,$scope) {

    var urlBase = '/rets/mls';

    this.getMls = function (id) {
        return $http.post(urlBase + '/edit',id);
    };

    this.insertMls = function (user) {
        return $http.post(urlBase + '/save' , user);
    };

}]);