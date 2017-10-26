hotlibrary.controller('Category',function($scope,categoryAPI,categories){
  var init = function () {
    $scope.Page = {title: 'Hotlibrary - Categoria'};
    $scope.register = _register;
    $scope.categories = categories.data;
    $scope.setOrder = _setOrder;
  }

  var _setOrder = function () {
    $scope.order = !$scope.order;
  }

  var _register  = function (category) {
    if ($scope.form.$valid) {
      $scope.registration = true;

      categoryAPI.save(category).then(
        function success (response) {
          if (response.data.result)
            options = {type:'success',msg:'Categoria cadastrada!'};
          else
            options = {type:'danger',msg:'Problemas ao cadastrar a categoria'};

          $scope.$emit('alert',options);
          delete $scope.category;
          $scope.form.$setPristine();

          // Adiciona ao array de categorias a nova categoria cadastrada.
          $scope.categories.push(category);
          $scope.registration = false;
        },function error () {
          $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas de conexão com o servidor'});
          $scope.registration = false;
        }
      );

    }
  }

  init();
});
