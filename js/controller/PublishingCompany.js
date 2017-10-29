hotlibrary.controller('PublishingCompany',function($scope,publishingCompanies,publishingCompanyAPI) {

  var init  = function () {
    $scope.Page = {title:'Hotlibrary - Editoras'};
    $scope.publishingCompanies = publishingCompanies.data;
    $scope.register = _register;
    $scope.setOrder = _setOrder;
    $scope.delete = _delete;
  }

  var _setOrder = function () {
    $scope.order = !$scope.order;
  }

  var _delete = function (publishingCompany, event) {

    var element = event.currentTarget;
    element.firstChild.className = 'fa fa-spinner fa-pulse';

    publishingCompanyAPI.delete(publishingCompany.id).then(
      function success (response) {

        if (response.data.result) {
          config = {type:'success',msg:'Editora deletada'};

          // atualiza a lista de editoras
          publishingCompanyAPI.getAll().then(function (response) {
            $scope.publishingCompanies = response.data;
          });
        } else {
          config = {type:'danger',title:'Ops!',msg:'Ocorreu um problema ao deletar a editora'};
        }

        $scope.$emit('alert',config);
        element.firstChild.className = 'fa fa-trash';
      }, function error () {
        config = {type:'warning',title:'Ops!',msg:'Problemas de conexão com o servidor'};
        $scope.$emit('alert',config);
        element.firstChild.className = 'fa fa-trash';
      }
    );

  }

  var _register = function (publishingCompany) {

    if ($scope.form.$valid) {
      $scope.registration = true;

      // faz a requisição para cadastrar uma nova editora
      publishingCompanyAPI.save(publishingCompany).then(
        function success (response) {

          if (response.data.result) {
            config = {type:'success',msg:'Editora cadastrada'};

            // atualiza a lista de Editoras
            publishingCompanyAPI.getAll().then(function (response) {
              $scope.publishingCompanies = response.data;
            });
          } else {
            config = {type:'danger',title:'Ops!',msg:'Ocorreu um erro ao cadastrar a editora'};
          }

          $scope.$emit('alert',config);
          delete $scope.publishingCompany;
          $scope.form.$setPristine();
          $scope.registration = false;
        },function error () {
          $scope.$emit('alert',{title:'Ops!',type:'warning',msg:'Problemas de conexão com o servidor'});
          $scope.registration = false;
        }
      );
    }
  }

  init();
});
