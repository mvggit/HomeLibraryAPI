Library.directive('goToPage', function(){
    return {
        restrict: 'AE',
        transclude: true,
        link: function($scope, element, attr) {
            element.bind('click', function(){
                $scope.$apply(function(){
                    $scope.$root.page = {};
                    $scope.$root.page[attr.page] = 1;
                    if (attr.items && attr.ids)
                    {
                        $scope.$root[attr.items] = $scope.$root.list[attr.ids];
                    }
                });
            });
        }
    }
});

Library.directive('edit', function(){
    return {
        restrict: 'AE',
        transclude: true,
        link: function($scope, element, attr) {
            element.bind('click', function(){
                $scope.$apply(function(){
                    $scope.$root.page = {};
                    $scope.$root.page[attr.page] = 1;
                    $scope.$root.editbook = $scope._book;
                    $scope.$root.editbook.img = $scope.$root.editbook.cover
                                                    ? 'images/cover/' + $scope.$root.editbook.cover
                                                    : '';
                });
            });
        }
    }
});

Library.directive('delete', function(httpApp){
    return {
        restrict: 'AE',
        transclude: true,
        link: function($scope, element, attr) {
            element.bind('click', function(){
                
            var promise = httpApp.delete('book', {'page':attr.page, 'id':attr.ids});
                $scope.$apply(function(){
                    promise.then(
                        function(get){
                                $scope.$root.list = {};
                                if (get.data.status)
                                {
                                    $scope.$root.list = get.data.data.get; 
                                    
                                    if ($scope.pagination  instanceof Function)
                                    {
                                        $scope.currentPage = get.data.data.page;
                                        $scope.pagination(get.data.data.count);
                                    }
                                }
                                $scope.$root.page = {};
                                $scope.$root.page['main'] = 1;
                            });
                        });
            });
        }
    }
});

Library.directive('upload', function($rootScope){
    return {
        restrict: 'AE',
        transclude: true,
        link: function($scope, element, attr) {
            element.bind('change', function() {
            var f = document.getElementById('cover').files[0];
                r = new FileReader();
            var aborted = false;
            
                if (/[а-яА-Я]/.test(f.name))
                {
                    $scope.$apply(function(){
                        $scope.$uploaderror = true;
                    });
                    f = '';
                }
            
                r.onprogress = function(e) {
                    if (e.total > 512000)
                    {
                        r.abort();
                        aborted = true;
                        $scope.$uploaderror = true;
                    }
                };
                r.onloadend = function (e) {
                    $scope.$apply(function(){
                        if (!aborted)
                        {
                            $scope.$uploaderror = false;
                            $scope.$root.editbook.img = e.target.result;
                            $scope.$root.editbook.cover = f.name;
                            $rootScope._frozen = false;                        
                        }
                    })
                }
                if (f)
                {
                    r.readAsDataURL(f);
                }
            }
        )}
    }
});