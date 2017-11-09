hotlibrary.controller('mLogin',function ($scope,UserAPI){

  var init = function () {
    $scope.currentTab = 'formLogin';
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
  }

  var _save = function (user) {

    if ($scope.registration.$valid) {
      console.log('formulario valido');
      UserAPI.saveCommon(user).then(function success () {
        Materialize.toast('Usuário cadastrado',3000);
      },function error () {
        Materialize.toast('Problemas para se conectar ao servidor, tente novamente mais tarde!',3000);
      });
    }


  }

  init();

});
