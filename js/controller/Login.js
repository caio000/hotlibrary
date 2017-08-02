hotlibrary.controller('Login', function ($scope, $document, Application, Auth, $location) {
  $scope.Application = Application;
  $scope.alert = {show:false};
  $scope.btnLogin = false;

  $scope.makeLogin = function (User, formValid) {
    $scope.btnLogin = true;

    if (formValid) {
      Auth.login(User, function (data) {
        // verifica se retornou um usuário na requisição
        if ( data != null ) {
          // TODO: Gerar as credenciais do usuário
          $location.path('/usuario/cadastrar');
        } else {
          $scope.alert.show = true;
        }

      });
    }

    $scope.btnLogin = false;
  };
});
