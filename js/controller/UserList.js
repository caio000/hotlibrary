hotlibrary.controller('UserList',function ($rootScope, $scope, $document, $location, $timeout, users, UserAPI) {

  var init = function () {
    $scope.users = checkUserStatus(users.data);
    $scope.blockUser = blockUser;
    $scope.unlockUser = unlockUser;
  }

  /**
   * Bloquea o acesso do usuário ao sistema.
   * @author Caio de Freitas
   * @since 2017/10/02
   * @param INT id do usuário
   */
  var blockUser = function (id, event) {

    if ($rootScope.globals.currentUser.id == id) {
      $scope.$emit('alert',{type:'danger',title:'Ops!',msg:'Você não pode bloquear o seu usuário'});
    } else {
      element = event.target;
      element.firstChild.className = 'fa fa-spinner fa-pulse';

      UserAPI.block(id).then(function (response) {

        // busca os dados atualizados dos usuários
        UserAPI.getAll().then(function (response) {
          $scope.users = checkUserStatus(response.data);
        });

        $scope.$emit('alert',{type:'success',title:'',msg:'Usuário bloqueado com sucesso!'});
      },function (response) {
        $scope.$emit('alert',{type:'danger',title:'Ops!',msg:'Ocorreu um erro ao bloquear o usuário, tente novamente mais tarde'});
      });
    }

  }

  /**
   * Ativa um usuário no sistema
   * @author Caio de Freitas
   * @since 2017/10/09
   * @param int identificador do usuário
   */
  var unlockUser = function (id, event) {
    element = event.target;
    element.firstChild.className = 'fa fa-spinner fa-pulse';

    UserAPI.unlock(id).then(function (response) {

      // busca os dados atualizados dos usuários
      UserAPI.getAll().then(function (response) {
        $scope.users = checkUserStatus(response.data);
      });

      $scope.$emit('alert',{type:'success',title:'',msg:'Usuário desbloqueado'});
    }, function (response) {
      $scope.$emit('alert',{type:'danger',title:'Ops!',msg:'Não foi possivel desbloquear o usuário, tente novamente mais tarde'});
    });
  }

  var checkUserStatus = function(users) {
    users.forEach(function (user) {
      user.status = (user.isActive == true) ? 'Ativo' : 'Bloqueado';
    });

    return users;
  }

  init ();

});
