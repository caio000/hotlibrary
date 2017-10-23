hotlibrary.controller("UserEdit", function ($scope, user, level, UserAPI) {

  var init = function () {
    $scope.User = user.data;
    $scope.User.Address.number = parseInt(user.data.Address.number);
    $scope.edit = edit;
    $scope.levels = level.data;
    $scope.isEdit = true;
    $scope.submit = false;
    $scope.Page = {title:'Hotlibrary - Editar usuário'};
  }

  var edit = function (user) {
    if ($scope.newUser.$valid) {
      $scope.submit = true;

      UserAPI.edit(user).then(function success (response) {
        var option;

        if (response.data.result)
          option = {type:'success',title:'',msg:'Dados editados com sucesso'};
        else
          option = {type:'warning',title:'Ops!',msg:'Ocorreu algum problema ao editar os dados do usuário, tente novamente.'};

        $scope.$emit('alert',option);

        $scope.submit = false;
      }, function fail (response) {
        $scope.$emit('alert',{type:'danger', title:'Ops!', msg: 'Ocorreu algum problema ao conectar no servidor, tente novamente.'});
        $scope.submit = false;
      });
    }
  }

  init();

});
