hotlibrary.controller('Login', function ($scope, $document, Application, Auth, $location, UserAPI) {
  $scope.Application = Application;
  $scope.alert = {show:false,'class':'alert alert-success'};
  $scope.btnLogin = false;

  $scope.forgot = function (User, formValid) {

    if (formValid) {
      $scope.btnLogin = true;
      UserAPI.forgotPassword(User).then(function (response) {
        $scope.btnLogin = false;
        console.log("enviado email");
        $scope.$emit('alert',{type:'success',msg:'Foi enviado um email para recuperação da sua senha'});
      });
    }
  }

  $scope.makeLogin = function (User, formValid) {
    $scope.btnLogin = true;

    if (formValid) {
      Auth.login(User, function (response) {
        // verifica se retornou um usuário na requisição
        User = response.result;
        if ( User != null ) {
          Auth.setCredentials(User);

          if (User.level == 1)
            $location.path('/usuario');
        } else {
          $scope.$emit('alert',{type:'danger',msg:'Email ou senha incorretos'});
        }

      });
    }

    $scope.btnLogin = false;
  };
});
