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

  /**
   * Verifica o endereço do cep informado pelo usuário.
   * @author Caio de Freitas
   * @since 2017/09/26
   * @param Cep que será consultado.
   */
  $scope.checkZipcode = function (zipcode) {
    $scope.zipcodeError = false;
    $scope.search = true;
    viaCep.get(zipcode).then(function (response) {
      $scope.User.Address.City.name = response.localidade;
      $scope.User.Address.City.Neighborhood.name = response.bairro;
      $scope.User.Address.City.State.initials = response.uf;
      $scope.User.Address.publicPlace = response.logradouro;

      $scope.search = false;
    }, function () {
      $scope.zipcodeError = true;
      $scope.search = false;
    });
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
