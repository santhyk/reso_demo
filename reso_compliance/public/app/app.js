if(typeof(Storage) === "undefined") {//checking local storage support
    alert("Sorry! No Web Storage support..");
}
var app = angular.module('myApp', ['ngCookies', 'ui.router', '720kb.datepicker']);
app.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/login');
    $stateProvider
    .state("login", {
        url: '/login',
        views: {
            "mainView": {
               controller: 'loginController',
               templateUrl: '/app/components/login/loginView.phtml'
            }
        }
    })
    .state('dashboard', {
        url: '/dashboard', 
        views: {
            "mainView": {
               controller: 'dashboardController',
               templateUrl: '/app/components/dashboard/dashboardView.phtml'
            },
            "sideView": {
               template: '<div side-bar></div>'
            }
        }
        
    })
    .state('metadata', {
        url: '/metadata',
        views: {
            "mainView": {
                controller: 'metadataController',
                templateUrl: '/app/components/metadata/metadataView.phtml'
         },
            "sideView": {
               template : '<div side-bar></div>'
            }
        }
    })
    .state('mls', {
        url: '/mls/:mlsId',
        views: {
            "mainView": {
                controller: 'mlsController',
                templateUrl: '/app/components/mls/mlsView.phtml'
            },
           "sideView": {
                template: '<div side-bar></div>'
            }
        }
    })
    .state('mlsList', {
        url: '/mlsList',
        views: {
            "mainView": {
                controller: 'mlsListController',
                templateUrl: '/app/components/mlsList/mlsListView.html'
            },
            "sideView": {
                template: '<div side-bar></div>'
            }
        }
    });
}).run(['$rootScope', '$location', '$cookies', '$http', function ($rootScope, $location, $cookies, $http) {
    // keep user logged in after page refresh  
    $rootScope.globals = JSON.parse(localStorage.getItem('globals')) || {};
    if ($rootScope.globals.currentUser) {//setting common header for all request
        $http.defaults.headers.common['Authorization'] = 'Basic ' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
    }
    $rootScope.$on('$locationChangeStart', function (event, next, current) {
        // redirect to login page if not logged in and trying to access a restricted page
        var restrictedPage = $.inArray($location.path(), ['/login', '/register']) === -1;
        var loggedIn = $rootScope.globals.currentUser;
        if (restrictedPage && !loggedIn) {//redirect to login if logged in person data is unavailable
            $location.path('/login');
        } else if (loggedIn && $location.path() == '/login') {//show dashboard if logged in person is accessing login page
            $location.path('/dashboard');
        }
    });
}]);