var Library = angular.module('library', ['ui.bootstrap']);
Library.run(function($rootScope){
    $rootScope.page = {'main':1};
    $rootScope.list = {};
    $rootScope.editbook = {};
    $rootScope._frozen = false;
    $rootScope.sortField = 'id';
});