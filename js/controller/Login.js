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
      Auth.login(User, 'Login/administration', function (response) {
        // verifica se retornou um usuário na requisição
        User = response.result;
        if ( User != null ) {

          switch (parseInt(User.level)) {
            case 1:
              url = '/usuario';
              break;
            case 2:
              url = '/biblioteca/' + User.id;
              break;
          }

          User.homePage = url;
          Auth.setCredentials(User);
          $location.path(url);
        } else {
          $scope.$emit('alert',{type:'danger',msg:'Email ou senha incorretos'});
        }

      });
    }

    $scope.btnLogin = false;
  };
});
