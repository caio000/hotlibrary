hotlibrary.controller('User', function ($scope, UserAPI, $timeout, userLevel, viaCep) {

  var init = function () {
    $scope.Page = {title:'Hotlibrary - Cadastrar Usuário'};
    $scope.btnNewUser = {};
    $scope.levels = userLevel.data;
    $scope.User = _userFactory();
    $scope.submit = false;
  }

  $scope.sendUser = function (User, valid) {
    if (valid) {
      $scope.submit = true;

      UserAPI.saveUser(User).then(function success (response) {
        $scope.$emit('alert',{type:'success',title:'',msg:'Usuário cadastrado com sucesso!'});
        $scope.submit = false;
        $scope.User = _userFactory();
        $scope.newUser.$setPristine();
      }, function error (response) {
        $scope.$emit('alert',{type:'danger',title:'Ops!',msg:'Não foi possivel cadastrar o usuário, tente novamente mais tarde.'});
        $scope.submit = false;
      });

    }
  }

  var _userFactory = function () {
    return {Address:{City:{}, Zipcode:{}, Neighborhood:{}, State:{}}};
  }

  init();
});
