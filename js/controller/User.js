hotlibrary.controller('User', function ($scope, UserAPI, $timeout, userLevel, viaCep) {

  var init = function () {
    $scope.Page = {title:'Hotlibrary - Cadastrar Usuário'};
    $scope.btnNewUser = {};
    $scope.levels = userLevel.data;
    $scope.User = {
      Address:{
        City:{
          Neighborhood: {},State: {}
        }
      }
    };
  }

  $scope.sendUser = function (User, valid) {
    if (valid) {
      $scope.btnNewUser.disabled = true;

      UserAPI.saveUser(User).then(function success (response) {
        $scope.$emit('alert',{type:'success',title:'',msg:'Usuário cadastrado com sucesso!'});
        $scope.btnNewUser.disabled = false;
      }, function error (response) {
        $scope.$emit('alert',{type:'danger',title:'Ops!',msg:'Não foi possivel cadastrar o usuário, tente novamente mais tarde.'});
      });

    }
  }

  init();
});
