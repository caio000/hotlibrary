hotlibrary.controller('User', function ($scope, Application) {
  $scope.Page = {title:'Hotlibrary - Cadastrar Usuário', application: Application};
  $scope.btnNewUser = {};

  $scope.sendUser = function (User, valid) {
    if (valid) {
      $scope.btnNewUser.disabled = true;
      console.log(User);
      // TODO: criar lógica para enviar os dados para o back-end
    }
  }
});
