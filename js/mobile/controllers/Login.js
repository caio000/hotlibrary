hotlibrary.controller('mLogin',function ($scope,$location,UserAPI,Auth){

  var init = function () {
    $scope.currentTab = 'formLogin';
    $scope.btnCreateUser = {icon:'fa fa-paper-plane',disabled:false};
    $scope.btnLogin = {disabled:false};
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
    if ($scope.formLogin.$valid) {
      $scope.btnLogin.disabled = true;
      $scope.btnLogin.icon = 'fa fa-spinner fa-pulse';
      Auth.login(user,'Login/client',function (response) {
        user = response.result;
        if (user != null) {
          user.homePage = 'mobile/livros'; // FIXME: alterar para rota do usuário
          Auth.setCredentials(user);
          $location.path(user.homePage);
        } else {
          Materialize.toast('Email ou senha incorretos',3000);
        }
      });
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
