hotlibrary.controller('UserList',function ($scope, $document, $timeout, users, UserAPI) {

  var init = function () {
    $scope.users = checkUserStatus(users.data);
    $scope.Alert = {};
    $scope.blockUser = blockUser;
  }

  /**
   * Bloquea o acesso do usuário ao sistema.
   * @author Caio de Freitas
   * @since 2017/10/02
   * @param INT id do usuário
   */
  var blockUser = function (id) {
    UserAPI.block(id).then(function (response) {
      // TODO: criar comportamento após o usuáriro ter sido bloqueado.
    },function (response) {

      $scope.Alert.type = 'danger';
      $scope.Alert.title = 'Ops!';
      $scope.Alert.message = 'Não foi possivel bloquear esse usuário, tente novamente mais tarde.';

      $document.find("#alert").show('slow', function () {
        $timeout(function () {
          $document.find("#alert").hide('slow');
        },5000);
      });
    });
  }

  var checkUserStatus = function(users) {
    users.forEach(function (user) {
      user.status = (user.isActive) ? 'Ativo' : 'Bloqueado';
    });

    return users;
  }

  init ();

});
