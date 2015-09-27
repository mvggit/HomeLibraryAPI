// Main page
Library.controller('main', function ($rootScope, $scope, httpApp) {
    $scope.pages = $rootScope.page;
    
    $scope.pageLimit = [];
    $scope.currentPage = 1;
    
    $scope.pagination = function(countPage)
    {
        $scope.pageLimit = [];
        for (i=1; i<=countPage; i++)
        {
            $scope.pageLimit.push(i);
        }
    }
            
    $scope.paginated = function($page)
    {
        $rootScope._frozen = true;
    var promise = httpApp.get('book', {'page':$page ? $page : $scope.currentPage, 'order':$rootScope.sortField});
        promise.then(
            function(get){
                $rootScope._frozen = false;
                $rootScope.list = get.data.data.get ? get.data.data.get : [];
                $scope.currentPage = get.data.data.page ? get.data.data.page : 1;
                $scope.pagination(get.data.data.count);
            });        
    }
    
    $scope.paginated(1);
    
    $scope.sort = function(field)
    {
        $rootScope.sortField = field;
        $scope.paginated();
    }
    
    $scope.find = function(value, field)
    {
        $rootScope._frozen = true;
    var search = httpApp.post('book', {'field':field, 'value':value});
        search.then(
            function(get){
                $rootScope._frozen = false;
                if(get.data.status)
                {
                    $rootScope.list = get.data.data.get ? get.data.data.get : [];
                    $scope.currentPage = get.data.data.page;
                    $scope.pagination(get.data.data.count);
                }
                else
                {
                    alert(get.data.msg);
                }
            });
    }
});

// Catalog
Library.controller('catalog', function ($rootScope, $scope) {
    $scope.pages = $rootScope.page;
    
});

// New & Edit
Library.controller('edit', function ($rootScope, $scope, httpApp) {
    $scope.pages = $rootScope.page;
    $scope.$error = true;
    $scope.$uploaderror = false;
    $scope.submit = function() {
        $rootScope._frozen = true;
    var search = httpApp.put('book', $rootScope.editbook);
        search.then(
            function(get){
                $rootScope._frozen = false;
                if(get.data.status)
                {   
                    alert('Информация успешно обновленна');
                }
                else
                {
                    $scope.$error = get.data.status;
                    $scope.$errormsg = get.data.msg;
                }
            });

    }
    
    $scope.reset = function()
    {
        $rootScope.editbook = {};
    }
});

// More info
Library.controller('book', function ($rootScope, $scope) {
    $scope.pages = $rootScope.page;
    
});