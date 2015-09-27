Library.factory('httpApp', ['$http', function($http, $scope) {
    
var factory = {};

    factory.get = function(url, data) {
        return $http.get('http://localhost/laravel/public/' + url + '?page=' + data.page + '&order=' + data.order);
    };
    factory.post = function(url, data) {
        return $http.post('http://localhost/laravel/public/' + url, data);
    };
    factory.put = function(url, data) {
        return $http.put('http://localhost/laravel/public/' + url, data);
    };
    factory.delete = function(url, data) {
        return $http.delete('http://localhost/laravel/public/' + url + '?page=' + data.page + '&id=' + data.id);
    };

    return factory;
}]);