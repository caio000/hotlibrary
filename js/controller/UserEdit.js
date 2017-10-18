hotlibrary.controller("UserEdit", function ($scope, user, level) {

  var init = function () {
    $scope.User = user.data;
    $scope.User.Address.number = parseInt(user.data.Address.number);
    $scope.levels = level.data;
    $scope.isEdit = true;
  }

  init();

});
