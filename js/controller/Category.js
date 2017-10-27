hotlibrary.controller('Category',function($scope,categoryAPI,categories){
  var init = function () {
    $scope.Page = {title: 'Hotlibrary - Categoria'};
    $scope.register = _register;
    $scope.categories = categories.data;
    $scope.setOrder = _setOrder;
    $scope.delete = _delete;
  }

  var _delete = function (category, event) {
    var element = event.currentTarget;
    element.firstChild.className = 'fa fa-spinner fa-pulse';

    categoryAPI.delete(category.id).then(
      function success (response) {
        if (response.data.result) {
          config = {
            type: 'success',
            msg: 'Categoria deletada com sucesso'
          };

          // recarrega as categorias
          categoryAPI.getAll().then(function (response) {
            $scope.categories = response.data;
          });
        } else {
          config = {
            type: 'danger',
            title: 'Ops!',
            msg: 'Ocorreu um erro ao deletar a categoria'
          };

          element.firstChild.className = 'fa fa-trash';
        }

        $scope.$emit('alert',config);
        // TODO: comportamento para caso a requisição sejá executada
      }, function error () {
        element.firstChild.className = 'fa fa-trash';
        $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
      });
  }

  var _setOrder = function () {
    $scope.order = !$scope.order;
  }

  var _register  = function (category) {
    if ($scope.form.$valid) {
      $scope.registration = true;

      categoryAPI.save(category).then(
        function success (response) {
          if (response.data.result) {
            options = {type:'success',msg:'Categoria cadastrada!'};

            // recarrega a lista de categorias
            categoryAPI.getAll().then(function (response) {
              $scope.categories = response.data;
            });
          } else {
            options = {type:'danger',msg:'Problemas ao cadastrar a categoria'};
          }

          $scope.$emit('alert',options);
          delete $scope.category;
          $scope.form.$setPristine();
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
