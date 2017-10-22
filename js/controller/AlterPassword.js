hotlibrary.controller('AlterPassword',function ($scope,$location,user,UserAPI) {

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
        var options;

        if (response)
          options = {type:'success',msg:'Sua senha foi alterada com sucesso',callback: function () {
            $location.path('/');
          }};
        else
          options = {type:'success', msg:'Não foi possível alterar sua senha, tente novamente!'};

        $scope.$emit('alert',options);
        $scope.btnSubmit.disabled = false;
      });
    }
  }

  init();

});
