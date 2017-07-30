hotlibrary.controller('User', function ($scope, UserAPI) {
  $scope.Page = {title:'Hotlibrary - Cadastrar Usuário'};
  $scope.btnNewUser = {};
  $scope.alert = {
    type: '',
    text: 'Essa é uma mensagem de teste',
    disabled: true,
    title: 'Test',
    show: false
  };

  $scope.sendUser = function (User, valid) {
    if (valid) {
      $scope.btnNewUser.disabled = true;
      // Espera de 2 segundos
      setTimeout(function () {
        UserAPI.saveUser(User).then(function success (response) {
          $scope.alert.type = 'alert alert-success';
          $scope.alert.show = true;
          $scope.alert.title = '';
          $scope.alert.text = 'Usuário cadastrado com sucesso!';
        }, function error (response) {
          $scope.alert.type = 'alert alert-danger';
          $scope.alert.title = 'Ops....';
          $scope.alert.text = response.statusText;
          $scope.alert.show = true;
        });

        $scope.btnNewUser.disabled = false;
      }, 2000);
    }
  }
});
