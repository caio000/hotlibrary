hotlibrary.controller('Login', function ($scope, $document, Application, Auth, $location, UserAPI) {
  $scope.Application = Application;
  $scope.alert = {show:false,'class':'alert alert-success'};
  $scope.btnLogin = false;

  $scope.forgot = function (User, formValid) {

    if (formValid) {
      $scope.btnLogin = true;
      UserAPI.forgotPassword(User).then(function (response) {
        $scope.btnLogin = false;
        $scope.alert.show = true;
        $scope.alert.message = 'Foi enviado um email para recuperação da sua senha';
        $scope.alert.class = "alert alert-success";
      });
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
          $scope.alert.message = "Email ou senha incorretos";
          $scope.alert.class = 'alert alert-danger';
        }

      });
    }

    $scope.btnLogin = false;
  };
});
