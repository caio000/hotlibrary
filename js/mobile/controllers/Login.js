hotlibrary.controller('mLogin',function ($scope,UserAPI){

  var init = function () {
    $scope.currentTab = 'formLogin';
    $scope.btnCreateUser = {icon:'fa fa-paper-plane',disabled:false};
    $scope.User = {
      Level:{
        id: 3
      },
      Address:{
        City:{},
        Neighborhood: {},
        State:{},
      }
    };
    $scope.save = _save;
    $scope.login = _login;
  }

  var _login = function (user) {
    console.log('função login');
    if ($scope.formLogin.$valid) {
      console.log(user);
    }
  }

  var _save = function (user) {

    if ($scope.registration.$valid) {
      $scope.btnCreateUser.disabled = true;
      $scope.btnCreateUser.icon = 'fa fa-spinner fa-pulse';

      UserAPI.saveCommon(user).then(function success () {
        Materialize.toast('Usuário cadastrado',3000);
        $scope.btnCreateUser.disabled = false;
        $scope.btnCreateUser.icon = 'fa fa-paper-plane';
      },function error () {
        Materialize.toast('Problemas para se conectar ao servidor, tente novamente mais tarde!',3000);
        $scope.btnCreateUser.disabled = false;
        $scope.btnCreateUser.icon = 'fa fa-paper-plane';
      });
    }


  }

  init();

});
