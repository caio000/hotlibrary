hotlibrary.controller('User', function ($scope, UserAPI) {
  $scope.Page = {title:'Hotlibrary - Cadastrar Usuário'};
  $scope.btnNewUser = {};
  $scope.alert = {type: 'hide',text: 'Essa é uma mensagem de teste',disabled: true, title: 'Test'};

  $scope.sendUser = function (User, valid) {
    if (valid) {
      $scope.btnNewUser.disabled = true;
      // Espera de 2 segundos 
      setTimeout(function () {
        UserAPI.saveUser(User).then(function success (response) {
          if (response.data == true) {
            $scope.alert.type = 'alert alert-success';
          } else {
            $scope.alert.type = 'alert alert-danger';
          }
        }, function error (response) {
          // TODO: Criar lógica caso tenha problema com a conexão.
          console.log(response);
        });

        $scope.btnNewUser.disabled = false;
      }, 2000);
    }
  }
});
