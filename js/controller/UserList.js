hotlibrary.controller('UserList',function ($scope, users) {

  var init = function () {
    $scope.users = checkUserStatus(users.data);
  }

  var checkUserStatus = function(users) {
    users.forEach(function (user) {
      user.status = (user.isActive) ? 'Ativo' : 'Bloqueado';
    });

    return users;
  }

  init ();

});
