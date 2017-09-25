hotlibrary.controller("Menu", function ($scope,Auth,$location) {

  $scope.logout = function () {
    Auth.logout();
    $location.path('/');
  }

});
