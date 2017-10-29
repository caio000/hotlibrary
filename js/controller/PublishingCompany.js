hotlibrary.controller('PublishingCompany',function($scope,publishingCompanies,publishingCompanyAPI) {

  var init  = function () {
    console.log('carregdo controller');
    $scope.Page = {title:'Hotlibrary - Editoras'};
    $scope.register = _register;
    $scope.order = _order;
    $scope.delete = _delete;
  }

  var _order = function () {
    $scope.order = !$scope.order;
  }

  var _delete = function (publishingCompany) {

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
