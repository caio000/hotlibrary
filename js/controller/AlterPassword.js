hotlibrary.controller('AlterPassword',function ($scope, user, UserAPI) {

  init = function () {
    $scope.User = user.data;
    $scope.Alert = {};
    $scope.btnSubmit = {disabled: false};
  }

  $scope.alterPassword = function(password) {
    if ($scope.changePassword.$valid) {
      $scope.btnSubmit.disabled = true;
      $scope.User.password = password;

      UserAPI.alterPassword($scope.User).then(function (response) {
        if (response) {
          $scope.Alert.visible = true;
          $scope.Alert.class = "alert alert-success";
          $scope.Alert.message = "Sua senha foi alterada com sucesso";
        } else {
          $scope.Alert.visible = true;
          $scope.Alert.class = "alert alert-danger";
          $scope.Alert.message = "Não foi possível alterar sua senha. Tente novamente!";
        }

        $scope.btnSubmit.disabled = false;
      });
    }
  }

  init();

});
