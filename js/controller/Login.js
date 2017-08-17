hotlibrary.controller('Login', function ($scope, $document, Application, Auth, $location, UserAPI) {
  $scope.Application = Application;
  $scope.alert = {show:false};
  $scope.btnLogin = false;

  $scope.forgot = function (User, formValid) {

    if (formValid) {
      console.log('controller');
      UserAPI.forgotPassword(User);
    }
  }

  $scope.makeLogin = function (User, formValid) {
    $scope.btnLogin = true;

    if (formValid) {
      Auth.login(User, function (response) {
        // verifica se retornou um usuário na requisição
        if ( response.result != null ) {
          Auth.setCredentials(response.result);
          $location.path('/usuario/cadastrar');
        } else {
          $scope.alert.show = true;
        }

      });
    }

    $scope.btnLogin = false;
  };
});
